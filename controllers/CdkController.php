<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\PbApi;
use app\models\MgGiftPack;
use app\models\MgCdKey;
use app\models\MgChannel;
use app\models\MgEmailLog;
use app\models\MgManagerPermission;

class CdkController extends BaseController
{
    /*
        礼包列表
    */
    public function actionViewGiftList()
    {
        return $this->render('gift_list', [

        ]);
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $permission = new MgManagerPermission();
        if (!$permission->checkAccess(Yii::$app->user->id, 'access_cdk_module')) {
            if (substr($action->id, 0, 4) == 'view' || !Yii::$app->request->isAjax && !Yii::$app->request->post('ajax') && !Yii::$app->request->get('ajax')) {
                return $this->redirect('/gamer/');
            } else {
                echo Json::encode(['ok' => false, 'msg' => '无权访问该模块']);
                return false;
            }
        }
        return true;
    }

    /*
        ajax获取礼包列表数据
    */
    public function actionGiftList()
    {
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;

        $api = new PbApi();
        $item_list = $api->getItemList();

        $model = new MgGiftPack();
        $data = $model->searchByAttr([
            'channel'           => Yii::$app->request->get('channel'),
            'id'                => Yii::$app->request->get('gift_id'),
            'name_like'         => Yii::$app->request->get('gift_name'),
        ], $offset, $page_size, ['created_time' => -1]);

        foreach ((array) $data['list'] as $key => $val) {
            $data['list'][$key]['start_time'] = date('Y-m-d H:i:s', $val['start_time']);
            $data['list'][$key]['end_time'] = date('Y-m-d H:i:s', $val['end_time']);
            //$data['list'][$key]['content'] = mb_substr($val['content'], 0, 100) . (mb_strlen($val['content']) > 100 ? '...' : '');
            foreach ((array) $data['list'][$key]['attachs'] as $i => $attach) {
                $data['list'][$key]['attachs'][$i]['item_name'] = $item_list[$data['list'][$key]['attachs'][$i]['item_id']];
            }
        }

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
    }

    /*
        ajax删除指定礼包
    */
    public function actionGiftDelete()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgGiftPack();

        $res = $model->findByPk($id);
        if ($res) {
            $model->attributes['status'] = MgGiftPack::STATUS_DELETED;
            $res = $model->save();
            if ($res) {
                return Json::encode(['ok' => true, 'msg' => '删除成功']);
            } else {
                return Json::encode(['ok' => false, 'msg' => '删除失败']);
            }
        } else {
            return Json::encode(['ok' => false, 'msg' => '不存在该礼包']);
        }
    }

    /*
        ajax恢复指定礼包
    */
    public function actionGiftRestore()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgGiftPack();

        $res = $model->findByPk($id);
        if ($res) {
            $model->attributes['status'] = MgGiftPack::STATUS_VALID;
            $res = $model->save();
            if ($res) {
                return Json::encode(['ok' => true, 'msg' => '恢复成功']);
            } else {
                return Json::encode(['ok' => false, 'msg' => '恢复失败']);
            }
        } else {
            return Json::encode(['ok' => false, 'msg' => '不存在该礼包']);
        }
    }

    /*
        创建/编辑礼包
    */
    public function actionGiftEdit()
    {
        $mongo_id = Yii::$app->request->get('mongo_id') ? Yii::$app->request->get('mongo_id') : Yii::$app->request->post('mongo_id');

        $model = new MgGiftPack();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {
            $attachs = (array) Yii::$app->request->post('attachs');
            $channels = (array) Yii::$app->request->post('channels');
            $start_time = strtotime(Yii::$app->request->post('start_time'));
            $end_time = strtotime(Yii::$app->request->post('end_time'));
            $name = Yii::$app->request->post('name', '');
            $desc = Yii::$app->request->post('desc', '');

            $email_model = new MgEmailLog();
            if (!$attachs) {
                $ret_msg = ['ok' => false, 'msg' => '至少需要一个道具'];
            } elseif (!$email_model->checkAttachValid($attachs)) {
                $ret_msg = ['ok' => false, 'msg' => '道具格式错误'];
            } elseif (!$start_time || !$end_time) {
                $ret_msg = ['ok' => false, 'msg' => '需要设置礼包生效时间'];
            } elseif (!$name) {
                $ret_msg = ['ok' => false, 'msg' => '需要填写礼包名'];
            } elseif (!$desc) {
                $ret_msg = ['ok' => false, 'msg' => '需要填写礼包描述'];
            } else {
                if ($action == 'Edit') {
                    $model->attributes = [
                        'start_time'    => $start_time,
                        'end_time'      => $end_time,
                        'name'          => $name,
                        'desc'          => $desc,
                        'attachs'       => $attachs,
                        'channels'      => $channels,

                        'id'            => $model->attributes['id'],
                        'created_time'  => $model->attributes['created_time'],
                        'cdkey_count'   => $model->attributes['cdkey_count'],
                        'cdkey_used'    => $model->attributes['cdkey_used'],
                        'status'        => $model->attributes['status'],
                        'type'          => $model->attributes['type'],
                    ];

                    $res = $model->save();
                    if (!$res) {
                        $ret_msg = ['ok' => false, 'msg' => '保存失败'];
                    } else {
                        $ret_msg = ['ok' => true, 'msg' => '保存成功'];
                    }
                } else {
                    $ret_msg = $model->create([
                        'start_time'        => $start_time,
                        'end_time'          => $end_time,
                        'channels'          => $channels,
                        'name'              => $name,
                        'desc'              => $desc,
                        'cdkey_count'       => Yii::$app->request->post('cdkey_count'),
                        'attachs'           => $attachs,
                        'type'              => MgGiftPack::TYPE_EMAIL,
                    ]);
                }
            
            }
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->post('ajax')) {
            return Json::encode($ret_msg);
        } else {
            return $this->render('gift_edit', [
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        导出指定礼包CDK
    */
    public function actionDownload()
    {
        $id = Yii::$app->request->get('id');

        $gift_model = new MgGiftPack();
        $res = $gift_model->findByPk($id);

        if ($res) {
            $filename = $gift_model->attributes['id'] . '_' . date('Ymd', $gift_model->attributes['created_time']) . '_' . date('His', $gift_model->attributes['created_time']) . '.xls';
            header("Content-Type: application/vnd.ms-execl;charset=UTF-8");
            header("Content-Disposition: attachment;filename = {$filename}");
            header("Pragma: no-cache");
            header("Expires: 0");


            $model = new MgCdKey();

            $cursor = $model->getCursorByAttributes([
                'gift_pack_id'  => $id,
            ]);

            $html = $this->renderPartial('download', ['list' => $cursor], true);
            
            echo $html;
        } else {
            echo '无效的ID';
        }
    }


    /*
        ajax使用礼包
    */
    public function actionUse()
    {
        $cdkey = Yii::$app->request->get('cdkey');
        $lid = Yii::$app->request->get('server');
        $channel = Yii::$app->request->get('channel');
        $uid = Yii::$app->request->get('gid');

        $cdkey_model = new MgCdKey();
        $ret_msg = $cdkey_model->consume($uid, $cdkey, $lid, $channel);

        return Json::encode($ret_msg);
    }

}
