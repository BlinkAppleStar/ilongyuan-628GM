<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgChannel;
use app\models\MgLanguage;
use app\models\MgVersionNum;
use app\models\MgGameServer;
use app\models\MgRedisServer;
use app\models\PbApi;

class SettingController extends BaseController
{
    /*
        版本、语言、渠道 列表页
    */
    public function actionIndex()
    {
        $table_name = Yii::$app->request->get('table_name');

        switch ($table_name) {
            case 'version':
                $model = new MgVersionNum();
                break;
            case 'language':
                $model = new MgLanguage();
                break;
            default:
                $table_name = 'channel';
                $model = new MgChannel();
                break;
        }

        $list = $model->findAllByAttributes();

        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
        } else {
            return $this->render('index', [
                'list'          => $list,
                'table_name'    => $table_name,
            ]);
        }
    }

    /*
        区服配置列表
    */
    public function actionGameServerList()
    {
        $model = new MgGameServer();
        $list = $model->findAllByAttributes();
        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
        } else {
            return $this->render('game_server_list', [
                'list'          => $list,
            ]);
        }
    }

    /*
        redis配置列表
    */
    public function actionRedisServerList()
    {
        $model = new MgRedisServer();
        $list = $model->findAllByAttributes();
        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
        } else {
            return $this->render('redis_server_list', [
                'list'          => $list,
            ]);
        }
    }

    /*
        ajax获取当前redis服务器
    */
    public function actionGetCurrentRedis()
    {
        return Json::encode([
            'ok'        => true,
            'msg'       => '获取成功',
            'data'      => [
                'host'      => Yii::$app->Rdb->host,
                'port'      => Yii::$app->Rdb->port,
                'password'  => Yii::$app->Rdb->password,
                'lid'       => Yii::$app->Rdb->lid,
            ],
        ]);
    }

    /*
        ajax设置导量服务器
    */
    public function actionSetImportServer()
    {
        $lid = Yii::$app->request->get('lid');

        $server_model = new MgGameServer();
        return Json::encode($server_model->setImport($lid));
    }

    /*
        新增/编辑配置 版本、语言、渠道
    */
    public function actionEdit()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : Yii::$app->request->get('id');
        $table_name = Yii::$app->request->post('table_name') ? Yii::$app->request->post('table_name') : Yii::$app->request->get('table_name');

        switch ($table_name) {
            case 'version':
                $model = new MgVersionNum();
                break;
            case 'language':
                $model = new MgLanguage();
                break;
            default:
                $table_name = 'channel';
                $model = new MgChannel();
                break;
        }

        $res = $model->findByPk($id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {

            $model->attributes = [
                'name'          => Yii::$app->request->post('name', ''),
                'active'        => Yii::$app->request->post('active', '1'),
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
            return $this->render('edit', [
                'table_name'        => $table_name,
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        ajax获取单个配置（渠道、版本、语言、区服）
    */
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $table_name = Yii::$app->request->get('table_name');

        switch ($table_name) {
            case 'version':
                $model = new MgVersionNum();
                break;
            case 'language':
                $model = new MgLanguage();
                break;
            case 'game_server':
                $model = new MgGameServer();
                break;
            case 'redis_server':
                $model = new MgRedisServer();
                break;
            default:
                $table_name = 'channel';
                $model = new MgChannel();
                break;
        }

        $res = $model->findByPk($id);
        if ($res) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $model->attributes]);
        } else {
            return Json::encode(['ok' => false, 'msg' => '获取失败']);
        }
    }

    /*
        新增/编辑 区服配置
    */
    public function actionEditGameServer()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : Yii::$app->request->get('id');

        $model = new MgGameServer();

        $res = $model->findByPk($id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {

            $model->attributes = [
                //'id'            => Yii::$app->request->post('fid'),
                'lid'           => Yii::$app->request->post('lid', ''),
                'name'          => Yii::$app->request->post('name', ''),
                'ip'            => Yii::$app->request->post('ip', ''),
                'port'          => Yii::$app->request->post('port', ''),
                'active'        => Yii::$app->request->post('active', '0'),
                'start_time'    => strtotime(Yii::$app->request->post('start_time')),
                'end_time'      => strtotime(Yii::$app->request->post('end_time')),
                'input'         => Yii::$app->request->post('set_import', '0'),
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
            return $this->render('edit_game_server', [
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        新增/编辑 redis服务器配置
    */
    public function actionEditRedisServer()
    {
        $id = Yii::$app->request->post('id') ? Yii::$app->request->post('id') : Yii::$app->request->get('id');

        $model = new MgRedisServer();

        $res = $model->findByPk($id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {
            $model->attributes = [
                'lid'           => Yii::$app->request->post('lid', ''),
                'ip'            => Yii::$app->request->post('ip', ''),
                'port'          => Yii::$app->request->post('port', ''),
                'password'      => Yii::$app->request->post('password', ''),
                'active'        => Yii::$app->request->post('active', '0'),
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
            return $this->render('edit_redis_server', [
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        删除版本、语言、渠道、区服、redis
    */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $table_name = Yii::$app->request->get('table_name');
        $to_url = Yii::$app->request->get('to_url');

        switch ($table_name) {
            case 'version':
                $model = new MgVersionNum();
                break;
            case 'language':
                $model = new MgLanguage();
                break;
            case 'game_server':
                $model = new MgGameServer();
                break;
            case 'redis_server':
                $model = new MgRedisServer();
                break;
            default:
                $table_name = 'channel';
                $model = new MgChannel();
                break;
        }

        $res = $model->deleteByPk($id);
        if ($res) {
            $ret_msg = ['ok' => true, 'msg' => '删除成功'];
        } else {
            $ret_msg = ['ok' => false, 'msg' => '删除失败'];
        }

        if ($to_url) {
            return $this->redirect([$to_url]);
        } else {
            return Json::encode($ret_msg);
        }
    }

    
    /*
        设置默认redis服务器
    */
    public function actionRedisServer()
    {
        $server_id = strval(Yii::$app->request->get('server_id'));
        $redis_server = [];
        if ($server_id != '') {
            $server_model = new MgGameServer();
            $res = $server_model->findByPk($server_id);
            if ($res) {
                $redis_model = new MgRedisServer();
                $res = $redis_model->findByAttributes(['lid' => $server_model->attributes['lid'], 'active' => '1']);
                if ($res) {
                    $redis_server = [
                        'host'      => $res['ip'],
                        'port'      => $res['port'],
                        'password'  => $res['password'],
                    ];
                }
            }
        } else {
            $redis_server = [
                'host'      => Yii::$app->request->get('host'),
                'port'      => Yii::$app->request->get('port'),
                'password'  => Yii::$app->request->get('password'),
            ];
        }
        if (Yii::$app->Rdb->connect($redis_server)) {
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'      => 'redis_server',
                'value'     => $redis_server,
                'expire'    => time()+3600,
            ]));
            $ret_msg = ['ok' => true, 'msg' => '设置成功'];
        } else {
            $ret_msg = ['ok' => false, 'msg' => '链接Redis失败'];
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode($ret_msg);
        } else {
            return $this->redirect(['gamer/index']);
        }
    }

    /*
        获取道具列表配置
    */
    public function actionGetItemList()
    {
        $api = new PbApi();
        $list = $api->getItemList();

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
    }

    /*
        获取商品列表配置
    */
    public function actionGetGoodsList()
    {
        $api = new PbApi();
        $list = $api->getGoodsList();

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
    }

}
