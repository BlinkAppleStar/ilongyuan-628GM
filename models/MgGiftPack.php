<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 礼包类
 *
 *
 */
 /*
    attributes = {
        "_id" : ObjectId("5829224d7f8b9a6e058b4567"),
        "id" : "23",
        "name" : "标题名字",
        "desc" : "内容描述",
        "attachs" : [
                {
                        "item_id" : "30103001",
                        "item_count" : "223"
                },
                {
                        "item_id" : "30103002",
                        "item_count" : "223"
                },
        ],
        "created_time" : timestamp,
        "cdkey_count" : "50",
        "cdkey_used" : "32",
        "channel" : "渠道",
        "start_time" : timestamp,
        "end_time" : timestamp,
        "status" : 1,
        "type" : 1,
    }

 */
class MgGiftPack extends MongoModel
{
    public $tableName = 'gift_pack';

    const TYPE_EMAIL = 'email';

    const STATUS_DELETED = '0';
    const STATUS_VALID = '1';

    /*
        创建礼包
        @params = array(
            'cdkey_count'   => 123, // 要生成的CDK个数
            'cdkey_len'     => 10, // CDK长度
            'name'          => xxx, // 礼包名
            'desc'          => xxx, // 描述
            'attachs'       => array(
                array(
                    'item_id'       => 30103001,
                    'item_count'    => 233,
                ),
                ...
            ),
            'start_time'    => xxx, // 生效时间戳
            'end_time'      => xxx, // 失效时间
            'channels'      => array(
                array(
                    'name'  => xxx,
                ),
                ...
            ), // 渠道
            'type'          => xxx, // 礼包类型（待定）
        )
        @return 
    */
    public function create($params)
    {
        if ($params['cdkey_count'] > 50000) {
            $ret_msg = ['ok' => false, 'msg' => '单个礼包最多生成 50000 个CDKey'];
        } elseif ($params['cdkey_count'] <= 0) {
            $ret_msg = ['ok' => false, 'msg' => '需要设置CDK生成个数'];
        } else {
            // 生成CDK
            $cdkey_model = new MgCdKey();
            $cdkey_arr = $cdkey_model->generate($params['cdkey_count'], $params['cdkey_len']);

            if ($cdkey_arr) {
                // 生成流水号
                $counter_model = new MgCounter();
                $gift_id = $counter_model->incr('gift_id');

                // 生成gift
                $this->attributes = [
                    'id'                    => strval($gift_id),
                    'name'                  => $params['name'],
                    'desc'                  => $params['desc'],
                    'attachs'               => $params['attachs'],
                    'created_time'          => time(),
                    'cdkey_count'           => strval($params['cdkey_count']),
                    'cdkey_used'            => '0',
                    'channels'              => $params['channels'],
                    'start_time'            => $params['start_time'],
                    'end_time'              => $params['end_time'],
                    'status'                => self::STATUS_VALID,
                    'type'                  => $params['type'],
                ];

                $res = $this->save();
                if ($res) {
                    // 保存CDK
                    $cdkey_save_faild = [];
                    foreach ($cdkey_arr as $cdkey_str) {
                        $cdkey_model->mongo_id = null;
                        $cdkey_model->attributes = [
                            'code'              => $cdkey_str,
                            'used_by'           => '',
                            'status'            => MgCdKey::STATUS_VALID,
                            'gift_pack_id'      => $this->mongo_id->__toString(),
                            'user_server_lid'   => '',
                            'use_time'          => '',
                        ];
                        $res = $cdkey_model->save();
                        if (!$res) {
                            $cdkey_save_faild[] = $cdkey_str;
                        }
                    }
                    if ($cdkey_save_faild) {
                        // 撤销gift
                        $cdkey_model->deleteByAttributes(['gift_pack_id' => $this->mongo_id->__toString()]);
                        $this->deleteByPk($this->mongo_id->__toString());

                        $ret_msg = ['ok' => false, 'msg' => 'CDK保存失败'];
                    } else {
                        $ret_msg = ['ok' => true, 'msg' => '创建成功', 'data' => $this->mongo_id->__toString()];
                    } 
                } else {
                    $ret_msg = ['ok' => false, 'msg' => '创建礼包失败'];
                }
            } else {
                $ret_msg = ['ok' => false, 'msg' => '生成CDK失败'];
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

        if ($params['_id'] && \MongoId::isValid($params['_id'])) {
            $query['_id'] = new \MongoId($params['_id']);
        }
        if (strval($params['id']) != '') {
            $query['id'] = strval($params['id']);
        }
        if ($params['name']) {
            $query['name'] = $params['name'];
        }
        if (strval($params['status']) != '') {
            $query['status'] = strval($params['status']);
        }
        if (strval($params['type']) != '') {
            $query['type'] = strval($params['type']);
        }
        if ($params['name_like']) {
            $query['name'] = new \MongoRegex("/.*" . $params['name_like'] . ".*/");
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
