<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgBlackList;
use app\models\MgRole;
use app\models\MgManager;

class BlackListController extends BaseController
{
    /*
        黑名单列表数据
    */
    public function actionList()
    {
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;

        $model = new MgBlackList();

        $data = $model->searchByAttr([
            'uid'               => Yii::$app->request->get('uid'),
            'type'              => Yii::$app->request->get('type'),
            'name'              => Yii::$app->request->get('name'),
            'channel'           => Yii::$app->request->get('channel'),
            'lid'               => Yii::$app->request->get('lid'),
        ], $offset, $page_size);

        $manager_model = new MgManager();
        foreach ((array) $data['list'] as $key => $val) {
            $res = $manager_model->findByPk($val['updated_by']);
            $data['list'][$key]['created_time'] = date('Y-m-d H:i:s', $val['created_time']);
            $data['list'][$key]['start_time'] = date('Y-m-d H:i:s', $val['start_time']);
            $data['list'][$key]['end_time'] = date('Y-m-d H:i:s', $val['end_time']);
            $data['list'][$key]['updater'] = $manager_model->attributes['real_name'];
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
        } else {
            return $this->render('index', [
                'data'          => $data,
            ]);
        }
    }

    /*
        黑名单/白名单 新增/编辑
    */
    public function actionEdit()
    {
        $mongo_id = Yii::$app->request->post('mongo_id') ? Yii::$app->request->post('mongo_id') : Yii::$app->request->get('mongo_id');

        $model = new MgBlackList();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {
            $uid = Yii::$app->request->post('uid');
            $role_model = new MgRole();
            $ret_msg = $role_model->getDetailByUid($uid);

            if ($ret_msg['ok']) {
                $model->attributes = [
                    'type'          => Yii::$app->request->post('type', MgBlackList::TYPE_BLACK),
                    'start_time'    => strtotime(Yii::$app->request->post('start_time')),
                    'end_time'      => strtotime(Yii::$app->request->post('end_time')),
                    'uid'           => $uid,
                    'name'          => $ret_msg['data']['name'],
                    'channel'       => $ret_msg['data']['channel'],
                    'lid'           => $ret_msg['data']['lid'],
                    'server'        => $ret_msg['data']['server'],

                    'created_time'  => ($action == 'Add' ? time() : $model->attributes['created_time']),
                    'updated_by'    => Yii::$app->user->id,
                ];

                $res = $model->save();
                if (!$res) {
                    $ret_msg = ['ok' => false, 'msg' => '保存失败'];
                } else {
                    $ret_msg = ['ok' => true, 'msg' => '保存成功'];
                }
            }
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->post('ajax')) {
            return Json::encode($ret_msg);
        } else {
            return $this->render('edit', [
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        IP白名单  新增/编辑
    */
    public function actionIpEdit()
    {
        $mongo_id = Yii::$app->request->post('mongo_id') ? Yii::$app->request->post('mongo_id') : Yii::$app->request->get('mongo_id');

        $model = new MgBlackList();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {
            $model->attributes = [
                'type'          => MgBlackList::TYPE_IP_WHITE,
                'ip'            => Yii::$app->request->post('ip'),

                'created_time'  => ($action == 'Add' ? time() : $model->attributes['created_time']),
                'updated_by'    => Yii::$app->user->id,
            ];

            $res = $model->save();
            if (!$res) {
                $ret_msg = ['ok' => false, 'msg' => '保存失败'];
            } else {
                $ret_msg = ['ok' => true, 'msg' => '保存成功'];
            }
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->post('ajax')) {
            return Json::encode($ret_msg);
        } else {
            return $this->render('ip_edit', [
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        名单删除
    */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgBlackList();

        $res = $model->deleteByPk($id);
        if ($res) {
            $ret_msg = ['ok' => true, 'msg' => '删除成功'];
        } else {
            $ret_msg = ['ok' => false, 'msg' => '删除失败'];
        }

        return Json::encode($ret_msg);
    }

    /*
        获取指定名单
    */
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgBlackList();

        $res = $model->findByPk($id);
        if ($res) {
            $model->attributes['start_time'] = date('Y-m-d H:i:s', $model->attributes['start_time']);
            $model->attributes['end_time'] = date('Y-m-d H:i:s', $model->attributes['end_time']);
            $model->attributes['created_time'] = date('Y-m-d H:i:s', $model->attributes['created_time']);
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $model->attributes]);
        } else {
            return Json::encode(['ok' => false, 'msg' => '获取失败']);
        }
    }
}
