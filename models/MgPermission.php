<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 权限类
 *
 *
 */

/*
    {
            "_id" : ObjectId("585a47bc7f8b9a43058b4567"),
            "name" : "access_api_send_email",
            "desc" : "权限描述文字",
            "value" : "allow",
            "type" : "manager",
            "created_time" : NumberLong(1482311612),
            "updated_by" : 585a47bc7f8b9a43058b4567,
    }

*/
class MgPermission extends MongoModel
{
    public $tableName = 'permission';

    const TYPE_MANAGER = 'manager';
}
