<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Json;
use app\models\MgEmailLog;
use app\models\MgDailyEmailQueue;
use app\models\PbApi;
use app\models\MgRedisServer;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class EmailController extends Controller
{
    /*
        负责每日将当日要发送的邮件放入日队列
        每日凌晨5分执行一次
    */
    public function actionUpdateDailyQueue()
    {
        $send_time_max = date('Y-m-d', strtotime('+1 day'));

        $log_model = new MgEmailLog();
        $daily_log = $log_model->searchByAttr(['send_time_max' => $send_time_max, 'send_success' => '0']);

        if ($daily_log['total'] > 0) {
            $queue_model = new MgDailyEmailQueue();
            $queue_model->deleteByAttributes(['send_time_min' => $send_time_max]);
            foreach ($daily_log['list'] as $log_mongo_id => $log) {
                $ret_msg = $queue_model->add($log);
            }
            echo Json::encode(['ok' => true, 'msg' => '今日队列数据已就绪']);
        } else {
            echo Json::encode(['ok' => false, 'msg' => '今日没有要发送的数据']);
        }
    }

    /*
        从当日邮件队列中检查要发送的邮件并发送
        每5分钟执行一次
    */
    public function actionSend()
    {
        $send_time_max = date('Y-m-d H:i:s');

        $queue_model = new MgDailyEmailQueue();
        $email_to_send = $queue_model->searchByAttr(['send_time_max' => $send_time_max]);

        if ($email_to_send['total'] > 0) {
            $api = new PbApi();
            $redis_model = new MgRedisServer();
            $log_model = new MgEmailLog();
            foreach ($email_to_send['list'] as $queue_mongo_id => $item) {
                $redis = $redis_model->findByAttributes(['lid' => $item['server_lid']]);
                if ($redis) {
                    $redis_server = [
                        'host'      => $redis['ip'],
                        'port'      => $redis['port'],
                        'password'  => $redis['password'],
                        'lid'       => $redis['lid'],
                    ];

                    $ret_msg = $api->sendEmail($redis_server, $item['uid'], $item['title'], $item['content'], $item['attachs']);

                    if ($ret_msg['ok']) {
                        $log_exist = $log_model->findByPk($item['log_id']);
                        if ($log_exist) {
                            $log_model->attributes['send_success'] = '1';
                            $log_model->save();
                        }
                        $res = $queue_model->deleteByPk($queue_mongo_id);
                    }

                }
            }
            echo Json::encode(['ok' => true, 'msg' => '已发送']);
        } else {
            echo  Json::encode(['ok' => false, 'msg' => '没有要发送的数据']);
        }
    }
}
