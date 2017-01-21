<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 玩家角色类
 *
 *
 */

/*
    attributes = {
        "_id" : ObjectId("584134403cb60610dc24876c"),
        "game" : "soe",
        "role" : {
                "type" : 1,
                "id" : 2020001, // gamer_id 我们系统内用这个
                "server" : "1" // 区服LID
        },
        "uid" : "5841343f8614a03eef4e4a96",
        "channel" : "mine", // 渠道名
    }
*/
class MgRole extends MongoModel
{
    public $tableName = 'role';

    public function __construct()
    {
        $this->col = Yii::$app->Mdb->conn->selectDB('game')->selectCollection($this->tableName);
    }

    /*
        获取用户detail
    */
    public function getDetailByUid($uid)
    {
        $ret_msg = $this->setRedisByUid($uid);
        if ($ret_msg['ok']) {
            $role = $ret_msg['data'];
            $api = new PbApi();
            $ret_msg = $api->getGamerById($uid);
            if ($ret_msg['ok']) {
                $PB_Gamer = $ret_msg['data'];
                //fixing to do
                $server_model = new MgGameServer();
                $server = $server_model->findByAttributes(['lid' => $role['role']['server']]);
                if ($server) {
                    $PB_GamerLeague = $PB_Gamer->getLeague();
                    if ($PB_GamerLeague) {
                        $league_id = $PB_GamerLeague->getLid();
                        $league_name = $PB_GamerLeague->getShortName();
                    }

                    $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => [
                        'id'            => $uid,
                        'name'          => $PB_Gamer->getName(),
                        'channel'       => $role['channel'],
                        'lid'           => $role['role']['server'],
                        'server'        => $server['name'],
                        'league_id'     => $league_id,
                        'league_name'   => $league_name,
                        'total_charged' => number_format($PB_Gamer->getAllrmb(), 2, '.', ','),
                        'regist_time'   => date('Y-m-d', $PB_Gamer->getCreate()),
                        'last_login'    => date('Y-m-d', $PB_Gamer->getLastlogin()),
                        'regist_time_sec'   => date('Y-m-d H:i:s', $PB_Gamer->getCreate()),
                        'last_login_sec'    => date('Y-m-d H:i:s', $PB_Gamer->getLastlogin()),
                    ]];
                } else {
                    $ret_msg = ['ok' => false, 'msg' => '未找到用户所在区服配置'];
                }
            }
        }

        return $ret_msg;
    }

    /*
        根据UID设置当前请求全局Redis
    */
    public function setRedisByUid($uid)
    {
        $role = $this->findByAttributes(['role.id' => intval($uid)]);

        if ($role) {
            $redis_model = new MgRedisServer();
            $redis = $redis_model->findByAttributes(['lid' => $role['role']['server']]);

            if ($redis) {
                $redis_server = [
                    'host'      => $redis['ip'],
                    'port'      => $redis['port'],
                    'password'  => $redis['password'],
                ];

                if (Yii::$app->Rdb->connect($redis_server)) {
                    $ret_msg = ['ok' => true, 'msg' => '设置成功', 'data' => $role];
                } else {
                    $ret_msg = ['ok' => false, 'msg' => 'Redis 链接失败'];
                }
            } else {
                $ret_msg = ['ok' => false, 'msg' => '未找到Redis配置'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '未找到用户所在服务器'];
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

        if ($params['game']) {
            $query['game'] = $params['game'];
        }
        if ($params['channel']) {
            $query['channel'] = $params['channel'];
        }
        if ($params['role_id']) {
            $query['role.id'] = $params['role_id'];
        }
        if ($params['lid']) {
            $query['role.server'] = $params['lid'];
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
