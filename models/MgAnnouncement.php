<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 公告类
 *
 *
 */
 /*
    attributes = {
        "_id" : ObjectId("5829224d7f8b9a6e058b4567"),
        "type" : "before_login", // 登录前before_login, 登录后公告 after_login
        "channel" : "all",
        "server_id" : "5836afac7f8b9a41058b4568",
        "version" : "1.0",
        "lang" : "zh-tw",
        "title" : "标题",
        "content" : "内容",
        "inscribe" : "落款",
        "url" : "wefefei.comfef",
        "start" : NumberLong('1233323232'),
        "end" : NumberLong('1233323232')
    }

 */
class MgAnnouncement extends MongoModel
{
    public $tableName = 'notices';

    /*
        搜索
    */
    public function searchByAttr($params, $skip = 0, $limit = 0, $sort = [])
    {
        $query = [];

        if ($params['id'] && \MongoId::isValid($params['id'])) {
            $query['_id'] = new \MongoId($params['id']);
        }

        if ($params['type']) {
            $query['type'] = $params['type'];
        }
        if ($params['channel']) {
            $query['channel'] = $params['channel'];
        }
        if ($params['server_id']) {
            $query['server_id'] = $params['server_id'];
        }
        if ($params['version']) {
            $query['version'] = $params['version'];
        }
        if ($params['lang']) {
            $query['lang'] = $params['lang'];
        }
        if ($params['title']) {
            $query['title'] = $params['title'];
        }
        if ($params['title_like']) {
            $query['title'] = new \MongoRegex("/.*" . $params['title_like'] . ".*/");
        }

        if ($params['start_time_min']) {
            $query['start']['$gt'] = strtotime($params['start_time_min']);
        }
        if ($params['start_time_max']) {
            $query['start']['$lte'] = strtotime($params['start_time_max']);
        }
        if ($params['end_time_min']) {
            $query['end']['$gt'] = strtotime($params['end_time_min']);
        }
        if ($params['end_time_max']) {
            $query['end']['$lte'] = strtotime($params['end_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
