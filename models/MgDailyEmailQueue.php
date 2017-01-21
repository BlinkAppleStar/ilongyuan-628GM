<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 当日邮件队列类（用于定时脚本扫描，减少大表邮件列表表的扫描次数）
 *
 *
 */
 /*
    attributes = {
        "_id" : ObjectId("5829224d7f8b9a6e058b4567"),
        "channel" : "all",
        "server_id" : "5836afac7f8b9a41058b4568",
        "server" : "本地",
        "server_lid" : "区服LID",
        "uid" : {1223,3233,3232,},
        "title" : "标题",
        "content" : "内容",
        "template_id" : 2233,
        "type" : 4,
        "attachs" : [
                {
                        "item_id" : "30103001",
                        "item_count" : "223"
                }
        ],
        "log_id" : "5836afac7f8b9a41058b4568",
        "send_time" : NumberLong("1342444444332")
    }

 */
class MgDailyEmailQueue extends MongoModel
{
    public $tableName = 'daily_email_queue';

    /*
        将指定EmailLog无重复的加入发送就绪队列
        @params $log = array(
            '_id' => Object($_id),
            'field' => value,
            ...
        )
        @return bool
    */
    public function add($log)
    {
        $res = $this->findByAttributes(['log_id' => $log['_id']->__toString()]);
        if (!$res) { // 不重复
            $redis_model = new MgRedisServer();
            $redis = $redis_model->findByAttributes(['lid' => $log['server_lid']]);

            if ($redis) {
                $redis_server = [
                    'host'      => $redis['ip'],
                    'port'      => $redis['port'],
                    'password'  => $redis['password'],
                    'lid'       => $redis['lid'],
                ];
                if (!empty($log['uid']) || !empty($log['uname'])) { // 个人邮件
                    $api = new PbApi();
                    $res = $api->existGamerInServers([$log['server_id'] => $redis_server], (array)$log['uid'], (array)$log['uname']);
                    $to_user_ids = $res['data'][$log['server_id']];
                    if ($to_user_ids) {

                        $this->attributes = $log;
                        $this->attributes['uid'] = array_values($to_user_ids);
                        $this->attributes['log_id'] = $log['_id']->__toString();
                        unset($this->attributes['_id']);
                        unset($this->attributes['uname']);
                        $this->mongo_id = null;
                        $res = $this->save();
                        $ret_msg = ['ok' => true, 'msg' => '添加个人邮件就绪'];
                    } else {
                        $ret_msg = ['ok' => false, 'msg' => '添加失败: 个人邮件用户未找到 不发送'];
                    }
                } else { //区服邮件
                    $this->attributes = $log;
                    $this->attributes['uid'] = [];
                    $this->attributes['log_id'] = $log['_id']->__toString();
                    unset($this->attributes['_id']);
                    unset($this->attributes['uname']);
                    $this->mongo_id = null;
                    $this->save();
                    $ret_msg = ['ok' => true, 'msg' => '添加区服邮件就绪'];
                }
            } else {
                $ret_msg = ['ok' => false, 'msg' => '添加失败: 邮件用户Redis关闭'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '添加失败: 已在队列'];
        }
        return $ret_msg;
    }

    /*
        搜索
    */
    public function searchByAttr($params, $skip = 0, $limit = 0, $sort = [])
    {
        $query = [];

        if ($params['id'] && \MongoId::isValid($params['id'])) {
            $query['_id'] = new \MongoId($params['id']);
        }

        if ($params['channel']) {
            $query['channel'] = $params['channel'];
        }
        if ($params['server_id']) {
            $query['server_id'] = $params['server_id'];
        }
        if ($params['uid']) {
            $query['uid'] = ['$in' => [$params['uid']]];
        }
        if ($params['title']) {
            $query['title'] = $params['title'];
        }
        if ($params['title_like']) {
            $query['title'] = new \MongoRegex("/.*" . $params['title_like'] . ".*/");
        }
        if ($params['content_like']) {
            $query['content'] = new \MongoRegex("/.*" . $params['content_like'] . ".*/");
        }
        if ($params['keyword']) {
            $query['$or'] = [
                ['title' => new \MongoRegex("/.*" . $params['keyword'] . ".*/")],
                ['content' => new \MongoRegex("/.*" . $params['keyword'] . ".*/")],
            ];
        }

        if ($params['send_time_min']) {
            $query['send_time']['$gt'] = strtotime($params['send_time_min']);
        }
        if ($params['send_time_max']) {
            $query['send_time']['$lte'] = strtotime($params['send_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
