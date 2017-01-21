<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 意见反馈类
 *
 *
 */

/*
    {
            "_id" : ObjectId("585a47bc7f8b9a43058b4567"),
            "uid" : "2003",
            "channel" : "渠道",
            "channel_uid" : "渠道UID",
            "device_type" : "设备类型",
            "question" : "反馈内容",
            "created_time" : NumberLong(1482483372),
            "server_lid" : "1",
            "answer" : "回复内容",
            "answer_by" : "585a47bc7f8b9a43058b4567",
            "answer_time" : NumberLong(1482483372),
    }

*/
class MgFeedBack extends MongoModel
{
    public $tableName = 'feedback';

    /*
        回复指定反馈，先findByPk
        @params $content = string 回复内容
        @return $ret_msg = array(
            'ok'    => bool,
            'msg'   => string,
        )
    */
    public function answer($content)
    {
        $api = new PbApi();
        $redis_model = new MgRedisServer();
        $redis = $redis_model->findByAttributes(['lid' => strval($this->attributes['server_lid'])]);
        
        if (!$this->attributes['uid']) {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID'];
        } elseif (!$content) {
            $ret_msg = ['ok' => false, 'msg' => '回复内容不能留空'];
        } elseif ($this->attributes['answer'] && $this->attributes['answer_by']) {
            $ret_msg = ['ok' => false, 'msg' => '该反馈已回复，不能再次回复'];
        } else {
            $redis_server = [
                'host' => $redis['ip'],
                'port' => $redis['port'],
                'password' => $redis['password'],
                'lid' => $redis['lid'],
            ];

            $ret_msg = $api->sendEmail($redis_server, $this->attributes['uid'], '【意见回复】', $content);
            if ($ret_msg['ok']) {
                $this->attributes['answer'] = $content;
                $this->attributes['answer_by'] = Yii::$app->user->id;
                $this->attributes['answer_time'] = time();
                $res = $this->save();
                if ($res) {
                    $ret_msg = ['ok' => true, 'msg' => '回复成功'];
                } else {
                    $ret_msg = ['ok' => false, 'msg' => '邮件发送成功，回复内容保存失败'];
                }
            }
        }

        return $ret_msg;
    }

    /*
        玩家留言反馈
        @params array(
            'uid'           => UID,
            'channel'       => 渠道
            'channel_uid'   => 渠道UID，
            'device_type'   => 设备类型,
            'question'      => 反馈内容，
            'server_lid'    => 区服LID，
        )
    */
    public function commit($params)
    {
        if (!$params['uid']) {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID'];
        } elseif (!$params['server_lid']) {
            $ret_msg = ['ok' => false, 'msg' => '无效的区服LID'];
        } else {
            $this->mongo_id = null;
            $this->attributes = [
                'uid'           => $params['uid'],
                'channel'       => $params['channel'],
                'channel_uid'   => $params['channel_uid'],
                'device_type'   => $params['device_type'],
                'question'      => $params['question'],
                'created_time'  => time(),
                'server_lid'    => $params['server_lid'],
                'answer'        => '',
                'answer_by'     => '',
                'answer_time'   => '',
            ];
            $res = $this->save();
            if ($res) {
                $profile_model = new MgUserProfile();
                $res = $profile_model->findByAttributes(['uid' => strval($params['uid'])]);
                if ($res) {
                    $profile_model->updateByAttributes(['uid' => strval($params['uid'])], ['$set' => ['feedback_count' => ($res['feedback_count'] + 1)]]);
                } else {
                    $profile_model->attributes = [
                        'uid'               => strval($params['uid']),
                        'feedback_count'    => '1',
                    ];
                    $profile_model->save();
                }
                $ret_msg = ['ok' => true, 'msg' => '保存成功'];
            } else {
                $ret_msg = ['ok' => false, 'msg' => '保存失败'];
            }
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

        if ($params['uid']) {
            $query['uid'] = $params['uid'];
        }
        if ($params['channel']) {
            $query['channel'] = $params['channel'];
        }
        if ($params['channel_uid']) {
            $query['channel_uid'] = $params['channel_uid'];
        }
        if ($params['server_lid']) {
            $query['server_lid'] = $params['server_lid'];
        }
        if ($params['question_like']) {
            $query['question'] = new \MongoRegex("/.*" . $params['question_like'] . ".*/");
        }
        if ($params['uid_in']) {
            $query['uid'] = ['$in' => [$params['uid_in']]];
        }

        if ($params['created_time_min']) {
            $query['created_time']['$gt'] = strtotime($params['created_time_min']);
        }
        if ($params['created_time_max']) {
            $query['created_time']['$lte'] = strtotime($params['created_time_max']);
        }
        if ($params['answer_time_min']) {
            $query['answer_time']['$gt'] = strtotime($params['answer_time_min']);
        }
        if ($params['answer_time_max']) {
            $query['answer_time']['$lte'] = strtotime($params['answer_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
