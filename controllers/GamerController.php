<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\PbApi;
use app\models\MgGameServer;
use app\models\MgRedisServer;
use app\models\MgRole;

//use DefaultBugClass;

class GamerController extends BaseController
{
    /*
        默认服用户列表
    */
    public function actionIndex()
    {
        $api = new PbApi();
        $res = $api->fetchIdNameList('gamer');
        if ($res['ok']) {
            $list = $res['data'];
        } else {
            $error = $res['msg'];
        }

        $server = new MgGameServer();
        $server_list = $server->findAllByAttributes(['active' => '1']);

        return $this->render('index', [
            'args'              => [
                                    'id'    => Yii::$app->request->post('id'),
                                    'name'  => Yii::$app->request->post('name'),
                                ],
            'list'              => (array) $list,
            'redis_host'        => Yii::$app->Rdb->host,
            'redis_port'        => Yii::$app->Rdb->port,
            'redis_password'    => Yii::$app->Rdb->password,
            'error'             => $error,
            'server_list'       => $server_list,
        ]);
    }

    /*
        跨服搜用户
    */
    public function actionSearch()
    {
        $name = Yii::$app->request->get('name');
        $uid = Yii::$app->request->get('uid');

        $list = [];
        if ($uid) {
            $model = new MgRole();
            $ret_msg = $model->getDetailByUid($uid);
            if ($ret_msg['ok']) {
                $list[] = $ret_msg['data'];
                $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $list];
            }
        } elseif ($name) {
            $api = new PbApi();
            $ret_msg = $api->getUidByName($name);
            if ($ret_msg['ok']) {
                $uids = $ret_msg['data'];
                if ($uids) {
                    $model = new MgRole();
                    foreach ($uids as $uid) {
                        $ret_msg = $model->getDetailByUid($uid);
                        if ($ret_msg['ok']) {
                            $list[] = $ret_msg['data'];
                        }
                    }
                }
                $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => $list];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '请输入UID或者昵称'];
        }

        return Json::encode($ret_msg);
    }

    /*
        跨服按ID导出用户
    */
    public function actionExportByUid()
    {
        $filename = 'daochu.xls';
        header("Content-Type: application/vnd.ms-execl;charset=UTF-8");
        header("Content-Disposition: attachment;filename = {$filename}");
        header("Pragma: no-cache");
        header("Expires: 0");


        $uids = range(4100, 4614);

        $model = new MgRole();
        $html = '<table>';
        foreach ($uids as $uid) {
            $ret_msg = $model->getDetailByUid($uid);
            if ($ret_msg['ok']) {
                $html .= '<tr>';
                $html .= '<td>' . $uid . '</td>' . '<td>' . $ret_msg['data']['name'] . '</td>' . '<td>' . $ret_msg['data']['regist_time_sec'] . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';
        echo $html;
    }

    /*
        跨服按注册时间导出用户
    */
    public function actionExportByRegistTime()
    {
        $filename = 'regist_2017_1_16.xlsx';
        header("Content-Type: application/vnd.ms-execl;charset=UTF-8");
        header("Content-Disposition: attachment;filename = {$filename}");
        header("Pragma: no-cache");
        header("Expires: 0");

        $time_min = strtotime('2017-01-16');
        $time_max = strtotime('2017-01-17');
        $failed_user_html = '<table>';
        $failed_user_html .= '<tr>';
        $failed_user_html .= '<td>角色UID</td><td>未获取到原因</td>';
        $failed_user_html .= '</tr>';
        $html = '<table>';
        $html .= '<tr>';
        $html .= '<td>角色UID</td><td>昵称</td><td>区服</td><td>注册时间</td><td>最后登录时间</td>';
        $html .= '</tr>';

        $api = new PbApi();
        $server_model = new MgGameServer();
        $redis_model = new MgRedisServer();
        $redis_list = $redis_model->findAllByAttributes([]);
        foreach ($redis_list as $redis) {
            $redis_server = [
                'host'      => $redis['ip'],
                'port'      => $redis['port'],
                'password'  => $redis['password'],
            ];
            if (Yii::$app->Rdb->connect($redis_server)) {
                $server = $server_model->findByAttributes(['lid' => $redis['lid']]);

                $redis = Yii::$app->Rdb;
                $user_list = $redis->conn->hGetAll("names.gamer");
                foreach ($user_list as $name => $uid) {
                    $user_detail = $api->getGamerById($uid);
                    if ($user_detail['ok']) {
                        $regist_time_sec = $user_detail['data']->getCreate();
                        if ($regist_time_sec > $time_min) {
                            $html .= '<tr>';
                            $html .= '<td>' . $uid . '</td>' . '<td>' . $user_detail['data']->getName() . '</td>' . '<td>' . $server['name'] . '</td>' . '<td>' . date('Y-m-d H:i:s', $user_detail['data']->getCreate()) . '</td>' . '<td>' . date('Y-m-d H:i:s', $user_detail['data']->getLastlogin()) . '</td>';
                            $html .= '</tr>';
                        }
                    } else {
                        $failed_user_html .= '<tr>';
                        $failed_user_html .= '<td>' . $uid . '</td>' . '<td>' . $user_detail['msg'] . '</td>';
                        $failed_user_html .= '</tr>';
                    }
                }
            }
        }

        $html .= '</table>';
        $failed_user_html .= '</table>';
        echo $html;
        echo $failed_user_html;


//        $uids = range(1, 5000);
//
//        $model = new MgRole();
//        foreach ($uids as $uid) {
//            $ret_msg = $model->getDetailByUid($uid);
//            if ($ret_msg['ok']) {
//                $regist_time_sec = strtotime($ret_msg['data']['regist_time_sec']);
//                if ($regist_time_sec > $time_min) {
//                    $html .= '<tr>';
//                    $html .= '<td>' . $uid . '</td>' . '<td>' . $ret_msg['data']['name'] . '</td>' . '<td>' . $ret_msg['data']['server'] . '</td>' . '<td>' . $ret_msg['data']['regist_time_sec'] . '</td>' . '<td>' . $ret_msg['data']['last_login_sec'] . '</td>';
//                    $html .= '</tr>';
//                }
//            } else {
//                $failed_user_html .= '<tr>';
//                $failed_user_html .= '<td>' . $uid . '</td>' . '<td>' . $ret_msg['msg'] . '</td>';
//                $failed_user_html .= '</tr>';
//            }
//        }
//        $html .= '</table>';
//        $failed_user_html .= '</table>';

    }

    /*
        跨服按登录时间导出用户
    */
    public function actionExportByLoginTime()
    {
        $filename = 'login_2017_1_16.xlsx';
        header("Content-Type: application/vnd.ms-execl;charset=UTF-8");
        header("Content-Disposition: attachment;filename = {$filename}");
        header("Pragma: no-cache");
        header("Expires: 0");

        $time_min = strtotime('2017-01-16');
        $time_max = strtotime('2017-01-17');
        $failed_user_html = '<table>';
        $failed_user_html .= '<tr>';
        $failed_user_html .= '<td>角色UID</td><td>未获取到原因</td>';
        $failed_user_html .= '</tr>';
        $html = '<table>';
        $html .= '<tr>';
        $html .= '<td>角色UID</td><td>昵称</td><td>区服</td><td>注册时间</td><td>最后登录时间</td>';
        $html .= '</tr>';

        $api = new PbApi();
        $server_model = new MgGameServer();
        $redis_model = new MgRedisServer();
        $redis_list = $redis_model->findAllByAttributes([]);
        foreach ($redis_list as $redis) {
            $redis_server = [
                'host'      => $redis['ip'],
                'port'      => $redis['port'],
                'password'  => $redis['password'],
            ];
            if (Yii::$app->Rdb->connect($redis_server)) {
                $server = $server_model->findByAttributes(['lid' => $redis['lid']]);

                $redis = Yii::$app->Rdb;
                $user_list = $redis->conn->hGetAll("names.gamer");
                foreach ($user_list as $name => $uid) {
                    $user_detail = $api->getGamerById($uid);
                    if ($user_detail['ok']) {
                        $login_time_sec = $user_detail['data']->getLastlogin();
                        if ($login_time_sec > $time_min) {
                            $html .= '<tr>';
                            $html .= '<td>' . $uid . '</td>' . '<td>' . $user_detail['data']->getName() . '</td>' . '<td>' . $server['name'] . '</td>' . '<td>' . date('Y-m-d H:i:s', $user_detail['data']->getCreate()) . '</td>' . '<td>' . date('Y-m-d H:i:s', $user_detail['data']->getLastlogin()) . '</td>';
                            $html .= '</tr>';
                        }
                    } else {
                        $failed_user_html .= '<tr>';
                        $failed_user_html .= '<td>' . $uid . '</td>' . '<td>' . $user_detail['msg'] . '</td>';
                        $failed_user_html .= '</tr>';
                    }
                }
            }
        }

        $html .= '</table>';
        $failed_user_html .= '</table>';
        echo $html;
        echo $failed_user_html;


//        $filename = 'login_2017_1_16.xlsx';
//        header("Content-Type: application/vnd.ms-execl;charset=UTF-8");
//        header("Content-Disposition: attachment;filename = {$filename}");
//        header("Pragma: no-cache");
//        header("Expires: 0");
//
//
//        $uids = range(1, 5000);
//        $time_min = strtotime('2017-01-16');
//        $time_max = strtotime('2017-01-17');
//
//        $model = new MgRole();
//        
//        $failed_user_html = '<table>';
//        $failed_user_html .= '<tr>';
//        $failed_user_html .= '<td>角色UID</td><td>未获取到原因</td>';
//        $failed_user_html .= '</tr>';
//        $html = '<table>';
//        $html .= '<tr>';
//        $html .= '<td>角色UID</td><td>昵称</td><td>区服</td><td>注册时间</td><td>最后登录时间</td>';
//        $html .= '</tr>';
//        foreach ($uids as $uid) {
//            $ret_msg = $model->getDetailByUid($uid);
//            if ($ret_msg['ok']) {
//                $login_time_sec = strtotime($ret_msg['data']['last_login_sec']);
//                if ($login_time_sec > $time_min) {
//                    $html .= '<tr>';
//                    $html .= '<td>' . $uid . '</td>' . '<td>' . $ret_msg['data']['name'] . '</td>' . '<td>' . $ret_msg['data']['server'] . '</td>' . '<td>' . $ret_msg['data']['regist_time_sec'] . '</td>' . '<td>' . $ret_msg['data']['last_login_sec'] . '</td>';
//                    $html .= '</tr>';
//                }
//            } else {
//                $failed_user_html .= '<tr>';
//                $failed_user_html .= '<td>' . $uid . '</td>' . '<td>' . $ret_msg['msg'] . '</td>';
//                $failed_user_html .= '</tr>';
//            }
//        }
//        $html .= '</table>';
//        $failed_user_html .= '</table>';
//        echo $html;
//        echo $failed_user_html;
    }


    /*
        获取游戏用户ID和名称列表
    */
    public function actionList()
    {
        $name = Yii::$app->request->get('name');
        $uid = Yii::$app->request->get('id');
        $api = new PbApi();
        $ret_msg = $api->fetchIdNameList('gamer', $uid, $name);

        return Json::encode($ret_msg);
    }

    /*
        查看指定gamer id对象
    */
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');

        $role_model = new MgRole();
        $role_model->setRedisByUid($id);

        $api = new PbApi();
        $ret_msg = $api->getGamerById($id);
        $name_list = $api->getGamerResouceNameList();

        $ret_msg['data'] = [
            'gamer'     => $ret_msg['data'],
            'name_list' => $name_list,
        ];
        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode($ret_msg);
        } else {
            return $this->render('detail', [
                'id'                => $id,
                'ret_msg'           => $ret_msg,
            ]);
        }
    }

    /*
        更新指定Gamer 资产列表
    */
    public function actionUpdateResourceList()
    {
        $uid = Yii::$app->request->post('uid');
        $resource = Yii::$app->request->post('resource');
        if (count($resource) < 19) {
            $resource = [];
            for ($i = 1; $i < 20; $i++) {
                $resource[$i] = 0;
            }
        }
        
        if ($uid) {
            $resource[0] = 0;

            $role_model = new MgRole();
            $role_model->setRedisByUid($uid);

            $api = new PbApi();
            $ret_msg = $api->getGamerById($uid);
            if ($ret_msg['ok']) {
                $gamer = $ret_msg['data'];
                $gamer->clearResource();
                foreach ($resource as $val) {
                    $gamer->appendResource($val);
                }
                $ret_msg = $api->setGamerById($uid, $gamer);
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID'];
        }

        return Json::encode($ret_msg);
    }

    /*
        设置建筑等级
    */
    public function actionSetBuildingLevel()
    {
        $uid = Yii::$app->request->get('uid');
        $level = Yii::$app->request->get('level');

        if ($uid && $level >= 4) {
            $role_model = new MgRole();
            $role_model->setRedisByUid($uid);

            $api = new PbApi();
            $ret_msg = $api->setBuildingLevelByUid($uid, $level);
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID或LEVEL'];
        }

        return Json::encode($ret_msg);
    }

    /*
        ajax编辑指定用户指定道具
    */
    public function actionAjaxSetItem()
    {
        $uid = Yii::$app->request->post('uid');
        $item_id = Yii::$app->request->post('item_id');
        $count = intval(Yii::$app->request->post('count'));

        if ($uid) {
            $role_model = new MgRole();
            $role_model->setRedisByUid($uid);

            $api = new PbApi();
            $ret_msg = $api->setGamerItem($uid, $item_id, $count);
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID'];
        }

        return Json::encode($ret_msg);
    }

    /*
        ajax删除指定用户指定道具
    */
    public function actionAjaxDeleteItem()
    {
        $uid = Yii::$app->request->post('uid');
        $item_id = Yii::$app->request->post('item_id');

        if ($uid) {
            $role_model = new MgRole();
            $role_model->setRedisByUid($uid);

            $api = new PbApi();
            $ret_msg = $api->deleteGamerItem($uid, $item_id);
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效的UID'];
        }

        return Json::encode($ret_msg);
    }


    /*
        ajax获取指定用户副列表
    */
    public function actionAjaxSubList()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');
        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;

        $ret_msg = ['ok' => false, 'msg' => '获取失败', 'data' => []];
        if ($id) {
            $role_model = new MgRole();
            $role = $role_model->setRedisByUid($id);

            $api = new PbApi();
            $dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/AllText.json')));

            $name_list = [];
            switch ($type) {
                case 'build': // 获取建筑列表
                    $res = $api->getGamerSubListById($id, 'build', 'PB_Build');
                    if ($res['ok']) {
                        $build_dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/Build.json')));
                        $current_page_data = array_slice($res['data'], $offset, $page_size, true);
                        foreach ($current_page_data as $val) {
                            $build_id = $val->getId();
                            $name_list[$build_id] = $dict[$build_dict[$build_id][0]['name']][0]['chinese'];
                        }
                    }
                    break;
                case 'tech': // 获取科技列表
                    $res = $api->getGamerSubListById($id, 'tech', 'PB_Tech');
                    if ($res['ok']) {
                        $tech_dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/Tech.json')));
                        $current_page_data = array_slice($res['data'], $offset, $page_size, true);
                        foreach ($current_page_data as $val) {
                            $tech_id = $val->getId();
                            $name_list[$tech_id] = $dict[$tech_dict[$tech_id][0]['name']][0]['chinese'];
                        }
                    }
                    break;
                case 'soldier': // 获取士兵列表
                    $res = $api->getGamerSubListById($id, 'soldier', 'PB_Soldier');
                    if ($res['ok']) {
                        $soldier_dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/Soldier.json')));
                        $current_page_data = array_slice($res['data'], $offset, $page_size, true);
                        foreach ($current_page_data as $val) {
                            $soldier_id = $val->getId();
                            $name_list[$soldier_id] = $dict[$soldier_dict[$soldier_id][0]['name']][0]['chinese'];
                        }
                    }
                    break;
                case 'item': // 获取道具列表
                    $res = $api->getGamerSubListById($id, 'bag', 'PB_Item');
                    if ($res['ok']) {
                        $item_dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/Item.json')));
                        $current_page_data = array_slice($res['data'], $offset, $page_size, true);
                        foreach ($current_page_data as $key => $val) {
                            $item_id = $key;
                            $name_list[$item_id] = $dict[$item_dict[$item_id][0]['name']][0]['chinese'];
                        }
                    }
                    break;
                case 'combat': // 获取战斗数据
                    $soldier_dict = Json::decode(file_get_contents(Yii::getAlias('@app/config/json/Soldier.json')));
                    $res = $api->getGamerCombatListById($id, $role['data']['role']['server'], $dict, $soldier_dict);
                    if ($res['ok']) {
                        $current_page_data = array_slice($res['data'], $offset, $page_size, true);
                    }
                    break;
                default:
                    $res = [];
                    break;
            }
            if ($res['ok']) {
                $ret_msg = ['ok' => true, 'msg' => '获取成功', 'data' => [
                    'total' => count($res['data']),
                    'list'  => $current_page_data,
                    'page'  => $page,
                    'name_list' => $name_list,
                ]];
            } else {
                $ret_msg = ['ok' => false, 'msg' => $res['msg'], 'data' => []];
            }
        }
        return Json::encode($ret_msg);
    }

}
