<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\PbApi;
use app\models\MgGameServer;
use app\models\MgRedisServer;
use app\models\MgChannel;
use app\models\MgEmailLog;
use app\models\MgDailyEmailQueue;
use app\models\MgManagerPermission;

class EmailController extends BaseController
{
    public function actionViewIndex()
    {
        return $this->redirect('view-queue-list');
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $permission = new MgManagerPermission();
        if (!$permission->checkAccess(Yii::$app->user->id, 'access_email_module')) {
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
        个人邮件发送索引页
    */
    public function actionViewSendIndex()
    {
        $server = new MgGameServer();
        $server_list = $server->findAllByAttributes(['active' => '1']);

        $channel = new MgChannel();
        $channel_list = $channel->findAllByAttributes(['active' => '1']);

        return $this->render('send_index', [
            'server_list'   => $server_list,
            'channel_list'  => $channel_list,
        ]);
    }

    /*
        区服邮件发送索引页
    */
    public function actionViewSendAreaIndex()
    {
        $server = new MgGameServer();
        $server_list = $server->findAllByAttributes(['active' => '1']);

        return $this->render('send_area_index', [
            'server_list'   => $server_list,
        ]);
    }

    /*
        邮件发送接口(加入发送队列)
    */
    public function actionSend()
    {
        $server_id = Yii::$app->request->post('server_id', '');
        $channel = Yii::$app->request->post('channel', '');
        $uids = Yii::$app->request->post('uids', '');
        $user_names = Yii::$app->request->post('user_names', '');
        $title = Yii::$app->request->post('title', '');
        $content = Yii::$app->request->post('content', '');
        $attachs = (array) Yii::$app->request->post('attachs', '');
        $send_time = Yii::$app->request->post('send_time', '');
        $is_area = Yii::$app->request->post('is_area', '');
        if (!$attachs[0]) {
            $attachs = [];
        }

        $email_log = new MgEmailLog();

        if (!$server_id) {
            $ret_msg = ['ok' => false, 'msg' => '请选择区服'];
        } elseif (!$email_log->checkAttachValid($attachs)) {
            $ret_msg = ['ok' => false, 'msg' => '附件格式错误'];
        } else {
            $server_model = new MgGameServer();
            $exsit_server = $server_model->findByPk($server_id);
            if (!$exsit_server) {
                $ret_msg = ['ok' => false, 'msg' => '无效的区服'];
            } else {
                $redis_model = new MgRedisServer();
                $redis = $redis_model->findByAttributes(['lid' => $server_model->attributes['lid']]);

                if (!$redis) {
                    $ret_msg = ['ok' => false, 'msg' => '无效的区服redis'];
                } else {
                    $redis_server = [
                        'host' => $redis['ip'],
                        'port' => $redis['port'],
                        'password' => $redis['password'],
                        'lid' => $redis['lid'],
                    ];
                    
                    $api = new PbApi();
                    $need_log = false;
                    $do_send = false;

                    if (!$is_area) {
                        $uids = trim($uids) ? array_map('intval', explode(',', $uids)) : [];
                        $user_names = trim($user_names) ? array_map('trim', explode(',', $user_names)) : [];
                        $res = $api->existGamerInServers([$server_id => $redis_server], $uids, $user_names);
                        $to_user_ids = $res['data'][$server_id];
                        if (!$to_user_ids) {
                            $ret_msg = ['ok' => false, 'msg' => '用户不存在'];
                        } else {
                            $do_send = true;
                        }
                    } else {
                        $to_user_ids = [];
                        $do_send = true;
                    }

                    if ($do_send) {
                        if (!$send_time) { // 立即发送
                            $ret_msg = $api->sendEmail($redis_server, $to_user_ids, $title, $content, $attachs);
                            if ($ret_msg['ok']) {
                                $send_success = '1';
                                $need_log = true;
                            }
                        } else {
                            $send_success = '0';
                            $need_log = true;
                        }

                        if ($need_log) {
                            // 记录邮件日志
                            $email_log->attributes = [
                                'channel'           => $channel,
                                'server_id'         => $server_id,
                                'server'            => $server_model->attributes['name'],
                                'server_lid'        => $server_model->attributes['lid'],
                                'uid'               => $uids,
                                'uname'             => $user_names,
                                'title'             => $title,
                                'content'           => $content,
                                'template_id'       => 7001,
                                'type'              => 4,
                                'send_success'      => $send_success,
                                'attachs'           => $attachs,
                                'has_attach'        => (count($attachs) ? '1' : '0'),
                                'send_time'         => ($send_time ? strtotime($send_time) : time()),
                                'created_time'      => time(),
                            ];
                            $res = $email_log->save();
                            if ($res) {
                                if ($send_time) {
                                    if (strtotime($send_time) < strtotime(date('Y-m-d', strtotime('+1 day')))) {// 今天需发送的邮件，加入今日邮件队列
                                        $email_queue = new MgDailyEmailQueue();
                                        $email_queue->attributes = [
                                            'channel'           => $channel,
                                            'server_id'         => $server_id,
                                            'server'            => $server_model->attributes['name'],
                                            'server_lid'        => $server_model->attributes['lid'],
                                            'uid'               => $to_user_ids,
                                            'title'             => $title,
                                            'content'           => $content,
                                            'template_id'       => 7001,
                                            'type'              => 4,
                                            'attachs'           => $attachs,
                                            'send_time'         => strtotime($send_time),
                                            'log_id'            => $email_log->mongo_id->__toString(),
                                        ];
                                        $email_queue->save();
                                        
                                        $ret_msg = ['ok' => true, 'msg' => '已保存至今日发送队列'];
                                    } else {
                                        $ret_msg = ['ok' => true, 'msg' => '已保存至发送队列'];
                                    }
                                }
                            } else {
                                $ret_msg = ['ok' => true, 'msg' => '邮件记录失败'];
                            }
                        }
                    }
                }
            }
        }
        return Json::encode($ret_msg);
    }

    /*
        未发送邮件发送时间调整
    */
    public function actionUpdateSendTime()
    {
        $id = Yii::$app->request->get('id');
        $send_time = Yii::$app->request->get('send_time');

        $log_model = new MgEmailLog();
        $log_exists = $log_model->findByPk($id);

        if ($log_exists) {
            if ($log_model->attributes['send_success']) {
                $ret_msg = ['ok' => false, 'msg' => '邮件已发送，不能修改发送时间'];
            } else {
                $queue_model = new MgDailyEmailQueue();
                $queue = $queue_model->findByAttributes(['log_id' => $log_model->mongo_id->__toString()]);
                if ($queue) {
                    $queue_model->updateByAttributes(['log_id' => $log_model->mongo_id->__toString()], ['$set' => ['send_time' => strtotime($send_time)]]);
                } else {
                    if (strtotime($send_time) < strtotime(date('Y-m-d', strtotime('+1 day')))) {
                        $ret_msg = $queue_model->add($log_model->attributes);
                    }
                }

                $log_model->attributes['send_time'] = strtotime($send_time);
                $res = $log_model->save();
                if ($res) {
                    $ret_msg = ['ok' => true, 'msg' => '邮件发送时间已更新'];
                } else {
                    $ret_msg = ['ok' => false, 'msg' => '邮件发送时间更新失败'];
                }
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的ID'];
        }
        return Json::encode($ret_msg);
    }

    /*
        AJAX未发送邮件删除
    */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $log_model = new MgEmailLog();
        $log_exists = $log_model->findByPk($id);
        if ($log_exists) {
            if ($log_model->attributes['send_success']) {
                $ret_msg = ['ok' => false, 'msg' => '邮件已发送，不能删除'];
            } else {
                $queue_model = new MgDailyEmailQueue();
                $queue_model->deleteByAttributes(['log_id' => $log_model->mongo_id->__toString()]);
                $log_model->deleteByPk($id);
                $ret_msg = ['ok' => true, 'msg' => '邮件已取消发送'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的ID'];
        }
        return Json::encode($ret_msg);
    }

    /*
        个人邮件列表
    */
    public function actionViewPersonal()
    {
        return $this->render('email_list_personal', [
            
        ]);
    }

    /*
        获取个人邮件列表数据
    */
    public function actionListPersonal()
    {
        $uid = Yii::$app->request->get('uid');
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;

        $api = new PbApi();
        $ret_msg = $api->getEmailListByUid($uid);
        if ($ret_msg['ok']) {
            $current_page_data = array_slice($ret_msg['data'], $offset, $page_size, true);
        }

        return Json::encode($ret_msg);
    }

    /*
        邮件队列列表
    */
    public function actionViewQueueList()
    {
        $server = new MgGameServer();
        $server_list = $server->findAllByAttributes(['active' => '1']);

        $channel = new MgChannel();
        $channel_list = $channel->findAllByAttributes(['active' => '1']);

        return $this->render('queue_list', [
            'server_list'   => $server_list,
            'channel_list'  => $channel_list,
        ]);
    }

    /*
        获取邮件队列列表数据
    */
    public function actionQueueList()
    {
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;

        $api = new PbApi();
        $item_list = $api->getItemList();

        $model = new MgEmailLog();
        $data = $model->searchByAttr([
            'channel'           => Yii::$app->request->get('channel'),
            'server_id'         => Yii::$app->request->get('server_id'),
            'keyword'           => Yii::$app->request->get('keyword'),
            'send_time_min'     => Yii::$app->request->get('send_time_min'),
            'send_time_max'     => Yii::$app->request->get('send_time_max'),
        ], $offset, $page_size);

        foreach ((array) $data['list'] as $key => $val) {
            $data['list'][$key]['send_time'] = date('Y-m-d H:i:s', $val['send_time']);
            $data['list'][$key]['created_time'] = date('Y-m-d H:i:s', $val['created_time']);
            $data['list'][$key]['content'] = mb_substr($val['content'], 0, 100) . (mb_strlen($val['content']) > 100 ? '...' : '');
            foreach ((array) $data['list'][$key]['attachs'] as $i => $attach) {
                if (is_array($attach)) {
                    $data['list'][$key]['attachs'][$i]['item_name'] = $item_list[$data['list'][$key]['attachs'][$i]['item_id']];
                }
            }
        }

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
    }

    /*
        获取单个邮件队列详情
    */
    public function actionQueueDetail()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgEmailLog();
        $res = $model->findByPk($id);

        if ($res) {
            $api = new PbApi();
            $item_list = $api->getItemList();
            foreach ((array) $model->attributes['attachs'] as $i => $attach) {
                $model->attributes['attachs'][$i]['item_name'] = $item_list[$model->attributes['attachs'][$i]['item_id']];
            }
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $model->attributes]);
        } else {
            return Json::encode(['ok' => false, 'msg' => '获取失败']);
        }
    }

}
