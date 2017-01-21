<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb Redis服务器类
 *
 *
 */
/*
    attributes = {
            "_id" : Objec1",("5836afac7f8b9a41058b4568"),
            "lid" : "1", // 区服逻辑ID
            "ip" : "localhost",
            "port" : "6379",
            "password" : "",
            "active" : "1"
    }
*/
class MgRedisServer extends MongoModel
{
    public $tableName = 'redis_server';

}
