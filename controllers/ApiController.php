<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgGameServer;
use app\models\MgRedisServer;
use app\models\MgAnnouncement;
use app\models\MgCdKey;
use app\models\MgManager;
use app\models\MgFeedBack;

class ApiController extends Controller
{
    /*
        获取指定LID区服和redis数据
    */
    public function actionGetServerByLid()
    {
        $lid = strval(Yii::$app->request->get('lid'));
        $server_model = new MgGameServer();
        $server = $server_model->findByAttributes(['lid' => $lid, 'active' => '1']);
        if ($server) {
            $redis_model = new MgRedisServer();
            $redis = $redis_model->findByAttributes(['lid' => $lid, 'active' => '1']);
            if (!$redis) {
                $ret_msg = ['ok' => false, 'msg' => '不存在该Redis'];
            } else {
                $redis_0 = $redis_model->findByAttributes(['lid' => '0', 'active' => '1']);

                unset($server['_id']);
                unset($redis['_id']);
                unset($redis_0['_id']);

                $data = [
                    'server'    => $server,
                    'redis'     => $redis,
                    'redis_0'   => $redis_0,
                ];
                $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $data];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '不存在该区服'];
        }

        return Json::encode($ret_msg);
    }

    
    /*
        只取当前有效公告
    */
    public function actionCurrentValidAnnounceList()
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

    /*
        ajax使用礼包
    */
    public function actionUseCdk()
    {
        $cdkey = Yii::$app->request->get('cdkey');
        $lid = Yii::$app->request->get('server');
        $channel = Yii::$app->request->get('channel');
        $uid = Yii::$app->request->get('gid');

        $cdkey_model = new MgCdKey();
        $ret_msg = $cdkey_model->consume($uid, $cdkey, $lid, $channel);

        return Json::encode($ret_msg);
    }

    /*
        初始化网站配置
    */
    public function actionInit()
    {
        $manager_model = new MgManager();
        $res = $manager_model->findByAttributes();
        if (!$res) {
            $manager_model->attributes = [
                'name'          => 'admin',
                'password'      => md5('admin'),
                'real_name'     => 'GM管理员',
                'status'        => '1',
                'created_time'  => time(),
            ];
            $manager_model->save();
        }
    }

    /*
        意见反馈
    */
    public function actionFeedBack()
    {
        $feedback = new MgFeedBack();
        $ret_msg = $feedback->commit([
            'uid'           => Yii::$app->request->get('uid'),
            'channel'       => Yii::$app->request->get('channel'),
            'channel_uid'   => Yii::$app->request->get('channel_uid'),
            'device_type'   => Yii::$app->request->get('device_type'),
            'question'      => Yii::$app->request->get('question'),
            'server_lid'    => Yii::$app->request->get('server_lid'),
        ]);

        return Json::encode($ret_msg);
    }
}
