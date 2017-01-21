<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 计数器类
 *
 *
 */
 /*
    attributes = {
        "_id" : ObjectId("5829224d7f8b9a6e058b4567"),
        "name" : "gift_id",
        "value" : "23"
    }

 */
class MgCounter extends MongoModel
{
    public $tableName = 'counter';


    /*
        计数器递增
        @params $name 计数器名字
        @params $number 递增数量
        @return $cnt  递增后的值
    */
    public function incr($name, $number = 1)
    {
        
        $counter = $this->findByAttributes(['name' => $name]);
        if (!$counter) {
            $this->attributes = [
                'name'  => $name,
                'value' => 1,
            ];
            $this->save();
            $ret = 1;
        } else {
            $this->mongo_id = $counter['_id'];
            $this->attributes['name'] = $counter['name'];
            $this->attributes['value'] = $counter['value'] + $number;
            $this->save();
            $ret = $this->attributes['value'];
        }

        return $ret;
    }

}
