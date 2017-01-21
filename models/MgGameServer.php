<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 区服类
 *
 *
 */
/*
    attributes = {
            "_id" : Objec1",("5836afac7f8b9a41058b4568"),
            "lid" : "1", // 区服逻辑ID
            "name" : "本地",
            "input" : "1", // 导量服务器标示
            "ip" : "localhost",
            "port" : "8080",
            "start_time" : NumberLong(1482483372),
            "end_time" : NumberLong(1482483372),
            "active" : "1"
    }
*/
class MgGameServer extends MongoModel
{
    public $tableName = 'game_server';

    /*
        设置导量服务器
        @params $lid 要设置的服务器LID
        @params $ret_msg = array(
            'ok'    => bool 是否成功
            'msg'   => xxx, 提示
        )
    */
    public function setImport($lid)
    {
        $server = $this->findByAttributes(['lid' => $lid]);

        if ($server['input']) {
            $ret_msg = ['ok' => false, 'msg' => '重复设置'];
        } elseif (!$server) {
            $ret_msg = ['ok' => false, 'msg' => '无效的LID'];
        } else {
            $cancel_org = $this->updateByAttributes(['input' => '1'], ['$set' => ['input' => '0']]);
            $res = $this->updateByAttributes(['_id' => $server['_id']], ['$set' => ['input' => '1']]);
        }

        return $ret_msg;
    }
}
