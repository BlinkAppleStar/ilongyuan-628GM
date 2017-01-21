<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 用户统计/其他信息类
 *
 *
 */

/*
    {
            "_id" : ObjectId("585a47bc7f8b9a43058b4567"),
            "uid" : "2003",
            "feedback_count" : "23",
    }

*/
class MgUserProfile extends MongoModel
{
    public $tableName = 'user_profile';

}
