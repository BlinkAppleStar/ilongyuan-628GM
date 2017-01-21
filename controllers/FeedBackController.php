<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgFeedBack;
use app\models\MgManager;
use app\models\MgGameServer;
use app\models\MgRole;
use app\models\MgUserProfile;
use app\models\PbApi;

class FeedBackController extends BaseController
{
    /*
        反馈列表搜索页
    */
    public function actionViewList()
    {
        $server = new MgGameServer();
        $server_list = $server->findAllByAttributes(['active' => '1']);
        return $this->render('index', [
            'server_list'   => $server_list,
        ]);
    }

    /*
        ajax反馈列表数据
    */
    public function actionList()
    {
        $channel_uid            = Yii::$app->request->get('channel_uid');
        $server_lid             = Yii::$app->request->get('server_lid');
        $channel                = Yii::$app->request->get('channel');
        $uid                    = Yii::$app->request->get('uid');
        $user_name              = Yii::$app->request->get('user_name');
        $created_time_min       = Yii::$app->request->get('created_time_min');
        $created_time_max       = Yii::$app->request->get('created_time_max');
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;

        $api = new PbApi();
        $manager_model = new MgManager();
        $user_profile_model = new MgUserProfile();
        $role_model = new MgRole();
        $model = new MgFeedBack();

        if ($user_name) {
            $ret_msg = $api->getUidByName($user_name);
            if ($ret_msg['ok']) {
                $uids = $ret_msg['data'];
                if ($uid) {
                    $uids[] = $uid;
                }
            }
        }

        $data = $model->searchByAttr([
            'channel'           => $channel,
            'channel_uid'       => $channel_uid,
            'server_lid'        => $server_lid,
            'uid_in'            => $uids,
            'created_time_min'  => $created_time_min,
            'created_time_max'  => $created_time_max,
        ], $offset, $page_size);

        foreach ((array) $data['list'] as $key => $val) {
            $manager = $manager_model->findByPk($val['answer_by']);
            if ($manager) {
                $data['list'][$key]['manager'] = $manager_model->attributes['real_name'] ? $manager_model->attributes['real_name'] : $manager_model->attributes['name'];
            }
            $user_profile = $user_profile_model->findByAttributes(['uid' => $val['uid']]);
            $data['list'][$key]['feedback_count'] = $user_profile['feedback_count'];

            $redis_switch_res = $role_model->setRedisByUid($val['uid']);
            if ($redis_switch_res['ok']) {
                $res = $api->getGamerById($val['uid']);
                if ($res) {
                    $data['list'][$key]['user_name'] = $res['data']->getName();
                }
            }

            $data['list'][$key]['created_time'] = date('Y-m-d H:i:s', intval($val['created_time']));
            $data['list'][$key]['answer_time'] = date('Y-m-d H:i:s', intval($val['answer_time']));
        }

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
    }

    /*
        意见反馈新增/编辑
    */
    public function actionEdit()
    {
        $mongo_id = Yii::$app->request->post('mongo_id') ? Yii::$app->request->post('mongo_id') : Yii::$app->request->get('mongo_id');

        $model = new MgFeedBack();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {

            $model->attributes = [
                'uid'           => Yii::$app->request->post('uid', ''),
                'channel'       => Yii::$app->request->post('channel', ''),
                'channel_uid'   => Yii::$app->request->post('channel_uid', ''),
                'device_type'   => Yii::$app->request->post('device_type', ''),
                'question'      => Yii::$app->request->post('question', ''),
                'server_lid'    => Yii::$app->request->post('server_lid', ''),
                'answer'        => Yii::$app->request->post('answer', ''),
                'answer_by'     => Yii::$app->request->post('answer_by', ''),
                'answer_time'   => Yii::$app->request->post('answer_time', ''),

                'created_time'  => ($action == 'Add' ? time() : $model->attributes['created_time']),
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
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        ajax回复指定反馈
    */
    public function actionAnswer()
    {
        $mongo_id = Yii::$app->request->post('mongo_id', '');
        $answer = Yii::$app->request->post('answer', '');

        $model = new MgFeedBack();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $ret_msg = $model->answer($answer);
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的ID'];
        }

        return Json::encode($ret_msg);
    }

}
