<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb CDKey类
 *
 *
 */
 /*
    attributes = {
        "_id" : ObjectId("5829224d7f8b9a6e058b4567"),
        "code" : "DIREFJI2323J43KJ",
        "used_by" : "2333",
        "status" : 1,
        "gift_pack_id" : "5829224d7f8b9a6e058b4567",
        "user_server_lid" : "3",
        "use_time" : timestamp,
    }

 */
class MgCdKey extends MongoModel
{
    public $tableName = 'cdkey';

    const STATUS_INVALID = '0';
    const STATUS_VALID = '1';

    // 使用CDK出错时 返回的错误码
    const ERROR_SUCCESS         = 60003; // 兑换成功
    const ERROR_GIFT_EXPIRE     = 60001; // 礼包过期
    const ERROR_GIFT_PREPARING  = 60001; // 礼包还未生效
    const ERROR_GIFT_INVALID    = 60008; // 礼包已失效
    const ERROR_USED            = 60002; // CDK被使用过
    const ERROR_INVALID_CDK     = 60004; // 无效的CDK
    const ERROR_SYS             = 60009; // 其他错误
    const ERROR_DOUBLE_USE      = 60011; // 同批次礼包同一用户重复使用


    /*
        生成无重复的CDK
        @params $count 要生成的CDK个数
        @params $cdkey_len 每个CDK长度
        @return array(
            'dfefefewfefw',
            'errfeffefe11'
        ) CDK数组，空数组表示生成失败
    */
    public function generate($count, $cdkey_len = 15)
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chars_len = strlen($chars);
        $cdkey_len = $cdkey_len ? $cdkey_len : 15;

        $gen_times = 0;
        $gen_ok = false;
        while (!$gen_ok) {
            $cdkey_arr = [];
            for ($i = 0; $i < $count; $i++) {
                $cdkey = '';
                for ($j = 0; $j < $cdkey_len; $j++) {
                    $cdkey .= $chars[mt_rand(0, $chars_len - 1)];
                }
                $cdkey_arr[] = $cdkey;
            }

            $duplicate_cdkey = $this->searchByAttr([
                'code_in'   => $cdkey_arr,
            ]);

            if ($duplicate_cdkey['total'] == 0) {
                $gen_ok = true;
            }
            $gen_times++;
            if ($gen_times > 10) {
                break;
            }
        }

        return $cdkey_arr;
    }

    /*
        使用CDK
        @params $uid 使用用户ID
        @params $code CDK码
        @params $lid 用户所在区服
        @params $channel 用户渠道（保留）
        @return $ret_msg = array(
            'ok' => bool,
            'msg' => xxx,
        )
    */
    public function consume($uid, $code, $lid, $channel = '')
    {
        $redis_model = new MgRedisServer();
        $redis = $redis_model->findByAttributes(['lid' => strval($lid)]);

        if (!$uid) {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID', 'code' => self::ERROR_SYS];
        } elseif (!$code) {
            $ret_msg = ['ok' => false, 'msg' => '没传CDK', 'code' => self::ERROR_SYS];
        } elseif (!$redis) {
            $ret_msg = ['ok' => false, 'msg' => '无效的区服', 'code' => self::ERROR_SYS];
        } else {
            $server_id = $redis['_id']->__toString();
            $redis_server = [
                'host' => $redis['ip'],
                'port' => $redis['port'],
                'password' => $redis['password'],
                'lid' => $redis['lid'],
            ];

            $api = new PbApi();
            $res = $api->existGamerInServers([$server_id => $redis_server], [$uid], []);
            $to_user_ids = $res['data'][$server_id];
            if (!$to_user_ids) {
                $ret_msg = ['ok' => false, 'msg' => '该区服未找到该用户', 'code' => self::ERROR_SYS];
            } else {
                $cdkey = $this->findByAttributes(['code' => $code]);
                if (!$cdkey) {
                    $ret_msg = ['ok' => false, 'msg' => '无效的CDK', 'code' => self::ERROR_INVALID_CDK];
                } elseif ($cdkey['status'] != self::STATUS_VALID) {
                    $ret_msg = ['ok' => false, 'msg' => 'CDK已被使用', 'code' => self::ERROR_USED];
                } else {// 有效的CDK 和 用户
                    $double_use_cdkey = $this->findByAttributes(['used_by' => $uid, 'gift_pack_id' => $cdkey['gift_pack_id']]);
                    if ($double_use_cdkey) {
                        $ret_msg = ['ok' => false, 'msg' => '您已使用该批次CDK，不能再使用了( ⊙ o ⊙ )！', 'code' => self::ERROR_DOUBLE_USE];
                    } else {
                        $gift_model = new MgGiftPack();
                        $res = $gift_model->findByPk($cdkey['gift_pack_id']);

                        if (!$res) {
                            $ret_msg = ['ok' => false, 'msg' => '无效的礼包', 'code' => self::ERROR_SYS];
                        } elseif ($gift_model->attributes['status'] != MgGiftPack::STATUS_VALID) {
                            $ret_msg = ['ok' => false, 'msg' => '礼包已失效', 'code' => self::ERROR_GIFT_INVALID];
                        } elseif ($gift_model->attributes['start_time'] > time()) {
                            $ret_msg = ['ok' => false, 'msg' => '礼包还未生效', 'code' => self::ERROR_GIFT_PREPARING];
                        } elseif ($gift_model->attributes['end_time'] < time()) {
                            $ret_msg = ['ok' => false, 'msg' => '礼包已过期', 'code' => self::ERROR_GIFT_EXPIRE];
                        } else {
                            $api = new PbApi();
                            $ret_msg = $api->sendEmail($redis_server, $uid, $gift_model->attributes['name'], $gift_model->attributes['desc'], $gift_model->attributes['attachs']);
                            if ($ret_msg['ok']) {
                                // 更新CDK
                                $this->attributes = [
                                    'code'              => $cdkey['code'],
                                    'used_by'           => $uid,
                                    'status'            => self::STATUS_INVALID,
                                    'gift_pack_id'      => $cdkey['gift_pack_id'],
                                    'user_server_lid'   => strval($lid),
                                    'use_time'          => time(),
                                ];
                                $this->mongo_id = $cdkey['_id'];
                                $this->save();

                                $gift_model->attributes['cdkey_used'] = strval($gift_model->attributes['cdkey_used'] + 1);
                                $gift_model->save();
                                $ret_msg = ['ok' => true, 'msg' => '使用成功', 'code' => self::ERROR_SUCCESS];
                            } else {
                                $ret_msg = ['ok' => false, 'msg' => '邮件发送失败', 'code' => self::ERROR_SYS];
                            }
                        }
                    }
                }
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

        if ($params['id'] && \MongoId::isValid($params['id'])) {
            $query['_id'] = new \MongoId($params['id']);
        }

        if ($params['code']) {
            $query['code'] = $params['code'];
        }
        if ($params['code_in']) {
            $query['code'] = ['$in' => [$params['code_in']]];
        }
        if ($params['used_by']) {
            $query['used_by'] = $params['used_by'];
        }
        if ($params['status']) {
            $query['status'] = $params['status'];
        }
        if ($params['gift_pack_id']) {
            $query['gift_pack_id'] = $params['gift_pack_id'];
        }
        if ($params['user_server_lid']) {
            $query['user_server_lid'] = $params['user_server_lid'];
        }

        if ($params['use_time_min']) {
            $query['use_time']['$gt'] = strtotime($params['use_time_min']);
        }
        if ($params['use_time_max']) {
            $query['use_time']['$lte'] = strtotime($params['use_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
