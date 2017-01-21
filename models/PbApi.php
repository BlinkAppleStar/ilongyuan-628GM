<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;

use ArmyState;
use ArmyType;
use PB_Build;
use PB_BattleRecord;
use PB_Combat;
use PB_CombatGamer;
use PB_CombatAssemble;
use PB_CostRecord;
use PB_FavoritePos;
use PB_Gamer;
use PB_GamerLeague;
use PB_GamerRecharge;
use PB_Item;
use PB_Mail;
use PB_Soldier;
use PB_Tech;
use PB_TimeRecord;
use PB_Vec2;

/**
 * ProtoBuf 统一操作接口
 *
 *
 */
class PbApi extends Model
{
    public function __construct()
    {
        
    }

    //////////////////////////////////Gamer////////////////////////////////////

    /*
        根据昵称遍历所有redis查找用户UID
    */
    public function getUidByName($name)
    {
        if (!$name) {
            $ret_msg = ['ok' => false, 'msg' => '请输入昵称'];
        } else {
            $uids = [];
            $redis_model = new MgRedisServer();
            $redis_list = $redis_model->findAllByAttributes();

            $redis_reader = Yii::$app->Rdb;
            foreach ($redis_list as $redis) {
                if ($redis['lid']) {
                    $redis_server = $redis;
                    $redis_server['host'] = $redis['ip'];
                    if ($redis_reader->connect($redis_server)) {
                        $uid = $redis_reader->conn->Hget("names.gamer", $name);
                        if ($uid) {
                            $uids[] = $uid;
                        }
                    }
                }
            }

            $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $uids];
        }

        return $ret_msg;
    }


    /*
        查询 用户列表 list 数据
        @params $type 名称类别 : gamer 游戏用户
        @params $ids 查找存在的指定ID
        @params $names 查找存在的昵称的用户
        @return array(
            'ok'    => true / false,
            'msg'   => '',
            'data'  => array(
                name => id,
                ...
            )
        )
    */
    public function fetchIdNameList($type, $ids=[], $names=[])
    {
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $list = [];
            $res = $redis->conn->hGetAll("names.$type");
            if ($ids || $names) {
                foreach ($res as $name => $id) {
                    if (in_array($name, (array)$names) || in_array($id, (array)$ids)) {
                        $list[$name] = $id;
                    }
                }
            } else {
                $list = $res;
            }
            $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $list];
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        }
        return $ret_msg;
    }

    /*
        跨服务器查询用户ID，昵称
        返回存在的服务器和用户
        @params $servers = array(
            server_id1 => array(
                'host' => string,
                'port' => int,
                'password' => string,
                'lid'   => string,
            ),
            ...
        ) 指定服务器，或者全部
        @params $uids 查找存在的指定UID
        @params $user_names 查找存在的昵称的用户
        @return array(
            'ok'    => true / false,
            'msg'   => '',
            'data'  => array(
                server_id1 => array(uid1, uid2...),
                server_id2 => array(uid1, uid2...),
                ...
            )
        )
    */
    public function existGamerInServers($servers=[], $uids=[], $user_names=[])
    {
        $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => []];
        $redis = Yii::$app->Rdb;
        foreach ((array) $servers as $server_id => $server) {
            if ($redis->connect($server)) {
                foreach ((array) $uids as $id) {
                    $id = intval($id);
                    if ($redis->conn->Exists("gamer.$id")) {
                        $ret_msg['data'][$server_id][$id] = $id;
                    }
                }
                foreach ((array) $user_names as $name) {
                    $id = $redis->conn->Hget("names.gamer", $name);
                    if ($id) {
                        $ret_msg['data'][$server_id][$id] = $id;
                    }
                }
            }
        }
        return $ret_msg;
    }

    /*
        获取指定Gamer
        @params $id = 玩家ID
        @return $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
            'data'  => $PB_Gamer
        )
    */
    public function getGamerById($id)
    {
        $redis = Yii::$app->Rdb;
        if (!$id) {
            $ret_msg = ['ok' => false, 'msg' => '无效的ID', 'data' => []];
        } elseif (!$redis->connect()) {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        } else {
            $packed = $redis->conn->hGet("gamer.$id", 'main');
            if (empty($packed)) {
                $ret_msg = ['ok' => false, 'msg' => '不存在该玩家', 'data' => []];
            } else {
                $PB_Gamer = new PB_Gamer(); 
                try {
                    $PB_Gamer->parseFromString($packed);
                    $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $PB_Gamer];
                } catch (Exception $ex) {
                    $ret_msg = ['ok' => false, 'msg' => '解码出错：' . $ex->getMessage(), 'data' => []];
                }
            }
        }
        return $ret_msg;
    }

    /*
        更新指定Gamer
        @params $id 更新用户ID
        @params $PB_Gamer 用户数据对象
        @return $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
        )
    */
    public function setGamerById($id, $PB_Gamer)
    {
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            if (get_class($PB_Gamer) == 'PB_Gamer') {
                $packed = $PB_Gamer->serializeToString();
                $res = $redis->conn->hSet("gamer.$id", 'main', $packed);
                $ret_msg = ['ok' => true, 'msg' => '保存成功'];
            } else {
                $ret_msg = ['ok' => false, 'msg' => '参数错误'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败'];
        }
        return $ret_msg;
    }

    /////////////////////////////////Building/////////////////////////////////
    /*
        设置指定Gamer的建筑等级
        设置后，没有数据的建筑自动加入数据，10001 主城建筑等级为设置的等级，其他建筑等级为设置的等级-1, 原来不在列表中的建筑等级不变
        @params $id 更新用户ID
        @params $PB_Gamer 用户数据对象
        @return $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
        )
    */
    public function setBuildingLevelByUid($id, $level)
    {
        $ret_msg = ['ok' => true, 'msg' => '操作成功', 'data' => []];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $build_config_arr = [
                10001 => 10001,
                10002 => 10002,
                10003 => 10003,
                10004 => 10004,
                10005 => 10005,
                10006 => 10006,
                10007 => 10007,
                10009 => 10009,
                10010 => 10010,
                10013 => 10013,
                10015 => 10015,
                10016 => 10016,
                10018 => 10018,
                10020 => 10020,
                10021 => 10021,
                10022 => 10022,
                10023 => 10023,
            ];
            $error = '';
            $max_lid = 0;

            $data = $redis->conn->hGetAll("gamer.$id.build");
            foreach ((array) $data as $lid => $item_packed) { // 更新已有建筑等级
                if ($item_packed) {
                    $item = new PB_Build();
                    try {
                        $item->parseFromString($item_packed);
                        $building_id = substr($item->getId(), 0, 5);
                        if ($building_id == 10001) {
                            $building_level = $level;
                        } else {
                            $building_level = $level - 1;
                        }

                        if (in_array($building_id, $build_config_arr)) {
                            $item->setId($building_id . str_pad($building_level, 3, '0', STR_PAD_LEFT));
                            $item->setLevel($building_level);
                            $max_lid = ($item->getLid() > $max_lid) ? $item->getLid() : $max_lid;
                            $item_packed = $item->serializeToString();
                            $redis->conn->hSet("gamer.$id.build", $item->getLid(), $item_packed);

                            unset($build_config_arr[$building_id]);
                        }
                    } catch (Exception $ex) {
                        $ret_msg['ok'] = false;
                        $error .= '|解码出错：' . $lid;
                    }
                }
            }

            foreach ($build_config_arr as $building_id) { // 添加新的建筑
                if ($building_id == 10001) {
                    $building_level = $level;
                } else {
                    $building_level = $level - 1;
                }

                $max_lid++;
                $item = new PB_Build();
                $item->setId($building_id . str_pad($building_level, 3, '0', STR_PAD_LEFT));
                $item->setLid($max_lid);
                $item->setLevel($building_level);
                $item->setSubIndex(1);
                $item->setBuildQueueIndex(-1);
                $item_packed = $item->serializeToString();
                $redis->conn->hSetNx("gamer.$id.build", $max_lid, $item_packed);
            }

            if (!$ret_msg['ok']) {
                $ret_msg['msg'] = $error;
            } else {
                $ret_msg = $this->getGamerById($id);
                $gamer = $ret_msg['data'];
                $gamer->setLevel($level);
                $ret_msg = $this->setGamerById($id, $gamer);
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        }

        return $ret_msg;
    }

    /*
        获取指定Gamer.sub list数据, 如gamer.$id.bag ; gamer.$id.soldier ; gamer.$id.build
        @params $id = 玩家ID
        @params $redis_key_suffix = redis列表键后缀 如 bag; soldier ; build
        @params $class = 用于解析每个数据的类
        @return $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
            'data'  => array(
                'item_id' => 'PB_Item',
            )
        )
    */
    public function getGamerSubListById($id, $redis_key_suffix, $class)
    {
        $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => []];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $data = $redis->conn->hGetAll("gamer.$id.$redis_key_suffix");
            $list = [];
            $error = '';
            foreach ((array) $data as $item_id => $item_packed) {
                if ($item_packed) {
                    $list[$item_id] = new $class();
                    try {
                        $list[$item_id]->parseFromString($item_packed);
                    } catch (Exception $ex) {
                        $ret_msg['ok'] = false;
                        $error .= '|解码出错：' . $item_id;
                    }
                }
            }
            $ret_msg['data'] = $list;
            if (!$ret_msg['ok']) {
                $ret_msg['msg'] = $error;
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        }
        return $ret_msg;
    }

    /*
        新增/编辑道具
    */
    public function setGamerItem($uid, $item_id, $value)
    {
        $ret_msg = ['ok' => true, 'msg' => '操作成功', 'data' => []];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $item = new PB_Item();
            $item->setType($item_id);
            $item->setCount($value);
            $packed = $item->serializeToString();

            $res = $redis->conn->hSet("gamer.$uid.bag", $item_id, $packed);
            $ret_msg['data'] = $item;
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        }
        return $ret_msg;
    }

    /*
        删除道具
    */
    public function deleteGamerItem($uid, $item_id)
    {
        $ret_msg = ['ok' => true, 'msg' => '操作成功', 'data' => []];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $res = $redis->conn->hDel("gamer.$uid.bag", $item_id);
            if (!$res) {
                $ret_msg = ['ok' => false, 'msg' => '操作失败，不存在的key'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        }
        return $ret_msg;
    }

    /*
        获取资源名称列表
    */
    public function getGamerResouceNameList()
    {
        return [
            '1'     => '原油',
            '2'     => '铁矿',
            '3'     => '钻晶',
            '4'     => '行动力',
            '5'     => 'vip点数',
            '6'     => '领主经验',
            '7'     => '锰钢',
            '8'     => '稀土',
            '9'     => '科技点',
            '10'     => '病毒样本',
            '11'     => '原油安全',
            '12'     => '铁矿安全',
            '13'     => '联盟功勋',
            '14'     => '龙晶',
            '15'     => '英雄经验',
            '16'     => '英雄技能点',
            '17'     => '锰钢安全',
            '18'     => '稀土安全',
            '19'     => '免费供给次数',
        ];
    }

    /*
        获取道具列表
    */
    public function getItemList()
    {
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $res = $redis->conn->get('item_list');
//            if ($res) {
//                $list = Json::decode($res);
//            } else {
                $list = $this->getItemListFromFile();
                $res = $redis->conn->set('item_list', Json::encode($list));

                $res = $redis->conn->expire('item_list', 7200);
            //}
        } else {
            $list = $this->getItemListFromFile();
        }

        return $list;
    }

    /*
        从文件获取道具列表
    */
    private function getItemListFromFile()
    {
        $data = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/Item.json')));
        $dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/AllText.json')));
        $formated = [];
        foreach ($data as $key => $item) {
            $formated[$item[0]['id']] = $dict[$item[0]['name']][0]['chinese'];
        }
        return $formated;
    }

    /*
        获取商品列表
    */
    public function getGoodsList()
    {
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $res = $redis->conn->get('goods_list');
//            if ($res) {
//                $list = Json::decode($res);
//            } else {
                $list = $this->getGoodsListFromFile();
                $res = $redis->conn->set('goods_list', Json::encode($list));

                $res = $redis->conn->expire('goods_list', 7200);
            //}
        } else {
            $list = $this->getGoodsListFromFile();
        }

        return $list;
    }

    /*
        从文件获取商品列表
    */
    public function getGoodsListFromFile()
    {
        $data = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/RechargeGift.json')));
        $dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/AllText.json')));
        $formated = [];
        foreach ($data as $key => $item) {
            $formated[$item[0]['id']] = $dict[$item[0]['name']][0]['chinese'];
        }
        return $formated;
    }

    /*
        获取战斗状态名称列表
    */
    public function getGamerArmyStateList()
    {
        //$state = new ArmyState();
        //return array_flip($state->getEnumValues());
        return [
            1       => '前进',
            2       => '返回',
            3       => '采集中',
            4       => '战斗中',
            5       => '（忽略）',
            6       => '在矿点被攻击',
            7       => '（忽略）',
            8       => '发起者等待集结',
            9       => '正在消失',
            10      => '等待',
            11      => '参与者等待集结',
            12      => '援助中',
            13      => '攻击时被合兵',
        ];
    }

    /*
        获取队列类型名称列表
    */
    public function getGamerArmyTypeList()
    {
        //$type = new ArmyType();
        //return array_flip($type->getEnumValues());
        return [
            11       => '攻打玩家',
            12       => '攻打怪物',
            13       => '采集',
            14       => '侦查玩家',
            15       => '侦查怪物',
            16       => '侦查矿点',
            17       => '加入集结',
            18       => '援助',
        ];
    }

    /*
        获取指定用户战斗数据
        key: L%u.combat       %u代表server_id
        sub_key: 专用的hkey， 格式为   gamer_id.时间戳.随机数
        筛选时, hgetall所有combat，找到以此gamer_id开头的key就行了
        数据内容为PB_Combat结构

        @params $id = 玩家ID
        @params $lid = 玩家所在区服LID
        @params $dict = Alltext字典，不传则不返回士兵名称
        @params $soldier_dict = Soldier字典，不传则不返回士兵名称
        @return $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
            'data'  => array(
                'item_id' => 'PB_Item',
            )
        )
    */
    public function getGamerCombatListById($id, $lid, $dict = null, $soldier_dict = null)
    {
        $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => []];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $type_list = $this->getGamerArmyTypeList();
            $state_list = $this->getGamerArmyStateList();

            $data = $redis->conn->hGetAll("L$lid.combat");
            $list = [];
            $error = '';
            foreach ((array) $data as $key => $item_packed) {
                if (substr($key, 0, 4) == $id) {
                    if ($item_packed) {
                        $item = new PB_Combat();
                        try {
                            $item->parseFromString($item_packed);
                        } catch (Exception $ex) {
                            $ret_msg['ok'] = false;
                            $error .= '|解码出错：' . $key;
                        }

                        $PB_attacker_list = $item->getAttacker();
                        $PB_defendor_list = $item->getDefendor();
                        $combat_gamer_list = array_merge($PB_attacker_list, $PB_defendor_list);
                        $gamer_list = [];
                        foreach ((array) $combat_gamer_list as $PB_CombatGamer) {
                            $combat_gamer_uid = $PB_CombatGamer->getGid();
                            $combat_gamer_name = '昵称获取错误';
                            $res = $this->getGamerById($combat_gamer_uid);
                            if ($res['ok']) {
                                $combat_gamer_name = $res['data']->getName();
                            }

                            $PB_soldier_list = $PB_CombatGamer->getSoldier();
                            $soldier_list = [];
                            foreach ((array) $PB_soldier_list as $PB_Soldier) {
                                $soldier_id = $PB_Soldier->getId();
                                
                                $soldier_list[] = [
                                    'name'      => $dict[$soldier_dict[$soldier_id][0]['name']][0]['chinese'],
                                    'level'     => $soldier_dict[$soldier_id][0]['level'],
                                    'rest_num'  => $PB_Soldier->getNum() - $PB_Soldier->getInjuredNum() - $PB_Soldier->getDiedNum(), //士兵数量
                                    //'num'       => $PB_Soldier->getNum(), // 总数
                                ];
                            }

                            $gamer_list[] = [
                                'uid'           => $combat_gamer_uid,
                                'name'          => $combat_gamer_name,
                                'soldier_list'  => $soldier_list,
                            ];
                        }


                        $list[$key] = [
                            'id'            => $key,
                            'state'         => $state_list[$item->getState()],
                            'type'          => $type_list[$item->getBattleType()],
                            'end_pos'       => '(' . $item->getEndPos()->getX() . ',' . $item->getEndPos()->getY() . ')',
                            //'state_time'    => ($item->getStateTime() ? date('Y-m-d H:i:s', $item->getStateTime()) : '无'),
                            'state_time'    => $item->getStateTime(),
                            'gamer_list'    => $gamer_list,
                        ];
                    }
                }
            }
            $ret_msg['msg'] = $error;
            $ret_msg['data'] = $list;
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败', 'data' => []];
        }
        return $ret_msg;
    }

    ///////////////////////////////////Email////////////////////////////////////////
    /*
        给指定服务器指定用户发送邮件，必须先确保用户已存在于指定服务器
        @params $server = array(
            'host' =>  string,
            'port' => int,
            'password' => string,
            'lid'   => string
        ) 指定redis服务器
        @params $uids = array 玩家ID列表 不传则为区服邮件
        @params $title = string 邮件标题
        @params $content = string 邮件内容
        @params $attachs = array(
            0 => array(
                'item_id' => int,
                'item_count' => int,
            ),
        ) 附件列表
        @return $ret_msg = array(
            'ok'    => true / false, 是否发送成功
            'msg'   => 错误信息
        )
    */
    public function sendEmail($server, $uids, $title='', $content='', $attachs=[])
    {
        $ret_msg = ['ok' => false, 'msg' => '发送失败'];
        $redis = Yii::$app->Rdb;
        if ($redis->connect($server)) {
            if ($uids) { // 个人邮件
                $failed_arr = [];
                foreach ((array) $uids as $uid) {
                    $exist_uid = $redis->conn->Exists("gamer.$uid");
                    if ($exist_uid) {
                        //$mail_id = $redis->conn->Hincrby("gamer.$uid", 'lidgen', 1);
                        $mail_id = $now = time();
                        if ($mail_id) {
                            $mail = new PB_Mail();
                            $mail->setMailId($mail_id);
                            $mail->setType(4);
                            $mail->setTemplateId(7001);
                            $mail->setCreateTime($now);
                            $mail->setTitle($title);
                            $mail->setMsg($content);
                            $mail->setRecipientId($uid);
                            foreach ((array) $attachs as $attach) {
                                if (isset($attach['item_id']) && $attach['item_count']) {
                                    $item = new PB_Item();
                                    $item->setType($attach['item_id']);
                                    $item->setCount($attach['item_count']);
                                    $mail->appendItems($item);
                                }
                            }

                            $packed = $mail->serializeToString();

                            $res = $redis->conn->Hset("gamer.$uid.mail", $mail_id, $packed);

                            $res = $redis->conn->Publish('L' . $server['lid'] . '.gm.mail', $packed);
                        } else {
                            $failed_arr[] = $uid;
                        }
                    }
                }

                if (count($failed_arr) == count($uids)) {
                    $ret_msg = ['ok' => false, 'msg' => '发送失败，mail_id获取失败'];
                } elseif ($failed_arr) {
                    $ret_msg = ['ok' => true, 'msg' => '部分邮件发送失败-UID：' . implode('|', $failed_arr)];
                } else {
                    $ret_msg = ['ok' => true, 'msg' => '个人邮件发送成功'];
                }
            } else {// 区服邮件
                $mail_id = $now = time();
                $mail = new PB_Mail();
                $mail->setMailId($mail_id);
                $mail->setType(4);
                $mail->setTemplateId(7001);
                $mail->setCreateTime($now);
                $mail->setTitle($title);
                $mail->setMsg($content);
                $mail->setIsGlobal(true);
                foreach ((array) $attachs as $attach) {
                    $item = new PB_Item();
                    $item->setType($attach['item_id']);
                    $item->setCount($attach['item_count']);
                    $mail->appendItems($item);
                }

                $packed = $mail->serializeToString();

                $res = $redis->conn->Hset('mail', $mail_id, $packed);

                $res = $redis->conn->Publish('L' . $server['lid'] . '.gm.mail', $packed);

                $ret_msg = ['ok' => true, 'msg' => '区服邮件发送成功'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败'];
        }
        return $ret_msg;
    }
    

    /*
        获取指定用户的所有邮件
        @params $uid 指定用户ID
        @return $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
            'data'  => array(
                'mail_id1' => PB_Mail,
                ...
            )
        )
    */
    public function getEmailListByUid($uid)
    {
        $ret_msg = ['ok' => false, 'msg' => '获取失败'];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $error = '';
            $list = [];
            $data = $redis->conn->hGetAll("gamer.$uid.mail");
            foreach ((array)$data as $mail_id => $packed) {
                $PB_mail = new PB_Mail();
                try {
                    $PB_mail->parseFromString($packed);
                    $list[$mail_id] = [
                        'mail_id'           => $PB_mail->getMailId(),
                        'type'              => $PB_mail->getType(),
                        'template_id'       => $PB_mail->getTemplateId(),
                        'create_time'       => $PB_mail->getCreateTime(),
                        'items'             => $PB_mail->getItems(),
                        'title'             => $PB_mail->getTitle(),
                        'content'           => $PB_mail->getMsg(),
                    ];
                } catch (Exception $ex) {
                    $ret_msg['ok'] = false;
                    $error .= '|解码出错：' . $mail_id;
                }
            }

            $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $list];
        }

        return $ret_msg;
    }


    ////////////////////////////////////Order///////////////////////////////////
    /*
        给指定玩家充值
        @params $uid 指定玩家ID
        @params $amount 充值金额
        @params $goods_id 商品ID
        @params $ret_msg = array(
            'ok'    => true / false, 是否获取成功
            'msg'   => 错误信息
        )
    */
    public function createGamerRecharge($uid, $amount, $goods_id)
    {
        $ret_msg = ['ok' => false, 'msg' => '充值失败'];
        $redis = Yii::$app->Rdb;
        if ($redis->connect()) {
            $uid = intval($uid);
            if ($redis->conn->Exists("gamer.$uid")) {
                $PB_GamerRecharge = new PB_GamerRecharge();
                $PB_GamerRecharge->setRmb(intval($amount));
                $PB_GamerRecharge->setGamer(intval($uid));
                $PB_GamerRecharge->setGoodId(intval($goods_id));
                $packed = $PB_GamerRecharge->serializeToString();

                $before_len = $redis->conn->Llen("gamer.$uid.recharge");
                $after_len = $redis->conn->Lpush("gamer.$uid.recharge", $packed);
                if ($after_len > $before_len) {
                    $receiver_num = $redis->conn->Publish('recharge', $packed);
                    $ret_msg = ['ok' => true, 'msg' => '充值成功'];
                } else {
                    $ret_msg = ['ok' => false, 'msg' => '充值失败：充值列表添加失败'];
                }
            } else {
                $ret_msg = ['ok' => false, 'msg' => '充值失败：无效的UID'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败'];
        }

        return $ret_msg;
    }

}
