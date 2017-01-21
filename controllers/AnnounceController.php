<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgAnnouncement;
use app\models\MgChannel;
use app\models\MgLanguage;
use app\models\MgVersionNum;
use app\models\MgGameServer;
use app\models\MgManagerPermission;

class AnnounceController extends BaseController
{
    
    /*
        列表页
    */
    public function actionViewIndex()
    {
        $server = new MgGameServer();
        $server_list = $server->findAllByAttributes(['active' => '1']);
        return $this->render('index', [
            'server_list'   => $server_list,
        ]);
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $permission = new MgManagerPermission();
        if (!$permission->checkAccess(Yii::$app->user->id, 'access_announce_module')) {
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
        AJAX列表数据
    */
    public function actionList()
    {
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;
        
        $model = new MgAnnouncement();
        $data = $model->searchByAttr([
            'id'                => Yii::$app->request->get('id'),
            'type'              => Yii::$app->request->get('type'),
            'channel'           => Yii::$app->request->get('channel'),
            'server_id'         => Yii::$app->request->get('server_id'),
            'lang'              => Yii::$app->request->get('lang'),
            'title_like'        => Yii::$app->request->get('title_like'),
            'version'           => Yii::$app->request->get('version'),
            'start_time_min'    => Yii::$app->request->get('start_time_min'),
            'start_time_max'    => Yii::$app->request->get('start_time_max'),
            'end_time_min'      => Yii::$app->request->get('end_time_min'),
            'end_time_max'      => Yii::$app->request->get('end_time_max'),
        ], $offset, $page_size);

        foreach ((array) $data['list'] as $key => $val) {
            $data['list'][$key]['start_time'] = date('Y-m-d H:i:s', $val['start']);
            $data['list'][$key]['end_time'] = date('Y-m-d H:i:s', $val['end']);
        }

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
    }

    /*
        只取当前有效公告
    */
    public function actionCurrentValidList()
    {
        $model = new MgAnnouncement();
        $data = $model->searchByAttr([
            'type'              => Yii::$app->request->get('type'),
            'channel'           => Yii::$app->request->get('channel'),
            'server_id'         => Yii::$app->request->get('server_id'),
            'lang'              => Yii::$app->request->get('lang'),
            'title'             => Yii::$app->request->get('title'),
            'version'           => Yii::$app->request->get('version'),
            'start_time_max'    => date('Y-m-d H:i:s'),
            'end_time_min'      => date('Y-m-d H:i:s'),
        ]);

        foreach ((array) $data['list'] as $key => $val) {
            $data['list'][$key]['start_time'] = date('Y-m-d H:i:s', $val['start']);
            $data['list'][$key]['end_time'] = date('Y-m-d H:i:s', $val['end']);
            if ($val['server_id']) {
                $server_model = new MgGameServer();
                $res = $server_model->findByPk($val['server_id']);
                if ($res) {
                    $data['list'][$key]['server_ip'] = $server_model->attributes['ip'];
                }
            }
        }

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
    }

    public function actionTest()
    {
        $dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/AllText.json')));
    }

    /*
        新增/编辑公告
    */
    public function actionEdit()
    {
        $id = Yii::$app->request->get('id') ? Yii::$app->request->get('id') : Yii::$app->request->post('id');

        $model = new MgAnnouncement();
        $res = $model->findByPk($id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {
            $model->attributes = [
                'type'          => (Yii::$app->request->post('type', 'after_login')),
                'channel'       => Yii::$app->request->post('channel', ''),
                'server_id'     => Yii::$app->request->post('server_id', ''),
                'version'       => Yii::$app->request->post('version', ''),
                'lang'          => Yii::$app->request->post('lang', ''),
                'title'         => Yii::$app->request->post('title', ''),
                'content'       => Yii::$app->request->post('content', ''),
                'inscribe'      => Yii::$app->request->post('inscribe', ''),
                'url'           => Yii::$app->request->post('url', ''),
                'start'         => strtotime(Yii::$app->request->post('start_time')),
                'end'           => strtotime(Yii::$app->request->post('end_time')),
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
            $channel = new MgChannel();
            $channel_list = $channel->findAllByAttributes(['active' => '1']);

            $version = new MgVersionNum();
            $version_list = $version->findAllByAttributes(['active' => '1']);

            $language = new MgLanguage();
            $language_list = $language->findAllByAttributes(['active' => '1']);

            $server = new MgGameServer();
            $server_list = $server->findAllByAttributes(['active' => '1']);

            return $this->render('edit', [
                'channel_list'      => $channel_list,
                'language_list'     => $language_list,
                'version_list'      => $version_list,
                'server_list'       => $server_list,
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        获取指定公告
    */
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgAnnouncement();

        $res = $model->findByPk($id);
        if ($res) {
            $model->attributes['start_time'] = date('Y-m-d H:i:s', $model->attributes['start']);
            $model->attributes['end_time'] = date('Y-m-d H:i:s', $model->attributes['end']);
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $model->attributes]);
        } else {
            return Json::encode(['ok' => false, 'msg' => '获取失败']);
        }
    }

    /*
        删除公告
    */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgAnnouncement();

        $res = $model->deleteByPk($id);
        if ($res) {
            $ret_msg = ['ok' => true, 'msg' => '删除成功'];
        } else {
            $ret_msg = ['ok' => false, 'msg' => '删除失败'];
        }

        return Json::encode($ret_msg);
    }

}
