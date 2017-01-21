<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 黑名单类
 *
 *
 */
 /*
    {
        "_id" : ObjectId("585ce6ac7f8b9a47058b4567"),
        "type" : "black", //black, white
        "start_time" : NumberLong(1482483369),
        "end_time" : NumberLong(1482483371),
        "uid" : "2001001",
        "name" : "yy1",
        "channel" : "mine",
        "lid": "1",
        "server" : '区服1',
        "created_time" : NumberLong(1482483372),
        "updated_by" : "585a410b7f8b9a42058b4568"
    }

    {
        "_id" : ObjectId("585ce6ac7f8b9a47058b4567"),
        "type" : "ip_white", // IP白名单结构
        "ip" : "127.0.0.1",
        "created_time" : NumberLong(1482483372),
        "updated_by" : "585a410b7f8b9a42058b4568"
    }
 */
class MgBlackList extends MongoModel
{
    public $tableName = 'black_list';

    const TYPE_BLACK = 'black';
    const TYPE_WHITE = 'white';
    const TYPE_IP_WHITE = 'ip_white';

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
        if ($params['lid']) {
            $query['lid'] = $params['lid'];
        }
        if ($params['name']) {
            $query['name'] = $params['name'];
        }
        if ($params['uid']) {
            $query['uid'] = $params['uid'];
        }

        if ($params['start_time_min']) {
            $query['start_time']['$gt'] = strtotime($params['start_time_min']);
        }
        if ($params['start_time_max']) {
            $query['start_time']['$lte'] = strtotime($params['start_time_max']);
        }
        if ($params['end_time_min']) {
            $query['end_time']['$gt'] = strtotime($params['end_time_min']);
        }
        if ($params['end_time_max']) {
            $query['end_time']['$lte'] = strtotime($params['end_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
