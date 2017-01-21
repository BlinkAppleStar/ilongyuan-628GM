<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 邮件记录类
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
        "uname" : {张三，李四},
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
        "has_attach" : true,
        "send_success" : '1',
        "send_time" : NumberLong("1342444444332"),
        "created_time" : NumberLong("1342444444332")
    }

 */
class MgEmailLog extends MongoModel
{
    public $tableName = 'email_log';

    /*
        检查附件格式正确性
        @params $attachs = array(
            array(
                'item_id'       => xxxx,
                'item_count'    => xxxx,
            ),
            ...
        )
        @return boolean
    */
    public function checkAttachValid($attachs = [])
    {
        $flag = true;
        if (count($attachs) > 0) {
            foreach ((array) $attachs as $attach) {
                if (is_array($attach)) {
                    if (isset($attach['item_id']) && isset($attach['item_count']) && count($attach) == 2) {
                        continue;
                    } else {
                        $flag = false;
                        break;
                    }
                } else {
                    $flag = false;
                    break;
                }
            }
        }

        return $flag;
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
        if ($params['uname']) {
            $query['uname'] = ['$in' => [$params['uname']]];
        }
        if ($params['title']) {
            $query['title'] = $params['title'];
        }
        if (strval($params['send_success']) != '') {
            $query['send_success'] = strval($params['send_success']);
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
        if (strval($params['has_attach']) != '') {
            $query['has_attach'] = strval($params['has_attach']);
        }

        if ($params['send_time_min']) {
            $query['send_time']['$gt'] = strtotime($params['send_time_min']);
        }
        if ($params['send_time_max']) {
            $query['send_time']['$lte'] = strtotime($params['send_time_max']);
        }
        if ($params['created_time_min']) {
            $query['created_time']['$gt'] = strtotime($params['created_time_min']);
        }
        if ($params['created_time_max']) {
            $query['created_time']['$lte'] = strtotime($params['created_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
