<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 管理员类
 *
 *
 */

/*
    {
            "_id" : ObjectId("585a47bc7f8b9a43058b4567"),
            "name" : "admin",
            "password" : "21232f297a57a5a743894a0e4a801fc3",
            "email" : "",
            "real_name" : "",
            "status" : "1",
            "created_time" : NumberLong(1482311612),
            "last_login" : NumberLong(1482397212)
    }

*/
class MgManager extends MongoModel
{
    public $tableName = 'manager';


}
