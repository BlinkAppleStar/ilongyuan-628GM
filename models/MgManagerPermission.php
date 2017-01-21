<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MongoDb 管理员权限类
 *
 *
 */

/*
    {
            "_id" : ObjectId("585a47bc7f8b9a43058b4567"),
            "name" : "access_api_send_email",
            "value" : "allow",
            "type" : "manager",
            "created_time" : NumberLong(1482311612),
            "updated_by" : 585a47bc7f8b9a43058b4567,

            "manager_id" : 585a47bc7f8b9a43058b4567,
    }

*/
class MgManagerPermission extends MongoModel
{
    public $tableName = 'manager_permission';

    /*
        检查指定管理员指定权限
    */
    public function checkAccess($manager_id, $permission)
    {
        $res = $this->findByAttributes([
            'manager_id'        => $manager_id,
            'name'              => $permission,
            'type'              => MgPermission::TYPE_MANAGER,
        ]);
        if ($res) {
            if ($res['value'] == 'allow') {
                $return = true;
            } else {
                $return = false;
            }
        } else {
            $return = true;
        }
        return $return;
    }

    /*
        给指定管理员添加指定权限
    */
    public function add($manager_id, $permission_id)
    {
        $permission_model = new MgPermission();
        $permis_exist = $permission_model->findByPk($permission_id);
        if ($permis_exist) {
            $duplicate = $this->findByAttributes([
                'manager_id'        => $manager_id,
                'name'              => $permission_model->attributes['name'],
                'type'              => MgPermission::TYPE_MANAGER,
            ]);
            if (!$duplicate) {
                $this->attributes = [
                    'name'          => $permission_model->attributes['name'],
                    'desc'          => $permission_model->attributes['desc'],
                    'value'         => $permission_model->attributes['value'],
                    'type'          => MgPermission::TYPE_MANAGER,
                    'created_time'  => time(),
                    'updated_by'    => Yii::$app->user->id,
                    'manager_id'    => $manager_id,
                ];
                $this->mongo_id = null;
                $res = $this->save();
                if ($res) {
                    $ret_msg = ['ok' => true, 'msg' => '权限添加成功'];
                } else {
                    $ret_msg = ['ok' => false, 'msg' => '权限添加失败'];
                }
            } else {
                $ret_msg = ['ok' => false, 'msg' => '权限重复设置'];
            }
        } else {
            $ret_msg = ['ok' => false, 'msg' => '无效权限'];
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

        if ($params['type']) {
            $query['type'] = $params['type'];
        }
        if ($params['name']) {
            $query['name'] = $params['name'];
        }
        if ($params['value']) {
            $query['value'] = $params['value'];
        }
        if ($params['manager_id']) {
            $query['manager_id'] = $params['manager_id'];
        }
        if ($params['name_like']) {
            $query['name'] = new \MongoRegex("/.*" . $params['name_like'] . ".*/");
        }
        if ($params['desc_like']) {
            $query['desc'] = new \MongoRegex("/.*" . $params['desc_like'] . ".*/");
        }

        if ($params['created_time_min']) {
            $query['start']['$gt'] = strtotime($params['created_time_min']);
        }
        if ($params['created_time_max']) {
            $query['start']['$lte'] = strtotime($params['created_time_max']);
        }

        return $this->findListByAttributes($query, $skip, $limit, $sort);
    }
}
