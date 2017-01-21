<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgPermission;
use app\models\MgManager;
use app\models\MgManagerPermission;

class PermissionController extends BaseController
{
    /*
        权限列表数据
    */
    public function actionList()
    {
        $model = new MgPermission();
        $list = $model->findAllByAttributes();

        $manager_model = new MgManager();

        foreach ($list as &$val) {
            $val['created_time'] = date('Y-m-d H:i:s', $val['created_time']);
            $manager = $manager_model->findByPk($val['updated_by']);
            if ($manager) {
                $val['updater'] = $manager_model->attributes['real_name'];
            }
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
        } else {
            return $this->render('list', [
                'list'          => $list,
            ]);
        }
    }

    /*
        权限新增/编辑
    */
    public function actionEdit()
    {
        $mongo_id = Yii::$app->request->post('mongo_id') ? Yii::$app->request->post('mongo_id') : Yii::$app->request->get('mongo_id');

        $model = new MgPermission();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {

            $model->attributes = [
                'name'          => Yii::$app->request->post('name', ''),
                'desc'          => Yii::$app->request->post('desc', ''),
                'value'         => Yii::$app->request->post('value', 'allow'),
                'type'          => MgPermission::TYPE_MANAGER,
                'updated_by'    => Yii::$app->user->id,
            ];
            if ($action == 'Add') {
                $model->attributes['created_time'] = time();
            }

            $res = $model->save();
            if (!$res) {
                $ret_msg = ['ok' => false, 'msg' => '保存失败'];
            } else {
                $ret_msg = ['ok' => true, 'msg' => '保存成功'];
            }
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->post('ajax')) {
            return Json::encode($ret_msg);
        } else {
            return $this->render('edit', [
                'model'             => $model,
                'action'            => $action,
                'msg'               => $ret_msg['msg'],
            ]);
        }
    }

    /*
        ajax 删除权限
    */
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgPermission();

        $res = $model->deleteByPk($id);
        if ($res) {
            $ret_msg = ['ok' => true, 'msg' => '删除成功'];
        } else {
            $ret_msg = ['ok' => false, 'msg' => '删除失败'];
        }

        return Json::encode($ret_msg);
    }


    //////////////////////////////////管理员权限接口//////////////////////////////////

    /*
        ajax管理员权限列表
    */
    public function actionManagerList()
    {

        $page = Yii::$app->request->get('page', 1);
        $page = $page < 1 ? 1 : $page;
        $page_size = Yii::$app->request->get('page_size', 10);
        $offset = ($page - 1) * $page_size;
        
        $model = new MgManagerPermission();
        $data = $model->searchByAttr([
            'id'                => Yii::$app->request->get('id'),
            'type'              => MgPermission::TYPE_MANAGER,
            'name_like'         => Yii::$app->request->get('name'),
            'desc_like'         => Yii::$app->request->get('desc'),
            'value'             => Yii::$app->request->get('value'),
            'manager_id'        => Yii::$app->request->get('manager_id'),
            'created_time_min'  => Yii::$app->request->get('created_time_min'),
            'created_time_max'  => Yii::$app->request->get('created_time_max'),
        ], $offset, $page_size);

        $manager_model = new MgManager();

        foreach ((array) $data['list'] as $key => $val) {
            $data['list'][$key]['created_time'] = date('Y-m-d H:i:s', $val['created_time']);
            $manager = $manager_model->findByPk($val['updated_by']);
            if ($manager) {
                $data['list'][$key]['updater'] = $manager_model->attributes['real_name'];
            }
            $manager = $manager_model->findByPk($val['manager_id']);
            if ($manager) {
                $data['list'][$key]['manager'] = $manager_model->attributes['real_name'];
            }
        }

        return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $data]);
    }

    /*
        管理员权限列表索引页
    */
    public function actionManagerIndex()
    {
        return $this->render('manager_index', [

        ]);
    }

    /*
        ajax管理员权限批量授权
    */
    public function actionGrantBulkManager()
    {
        $managers = Yii::$app->request->get('managers', []);
        $permissions = Yii::$app->request->get('permissions', []);
        $model = new MgManagerPermission();
        $ret_msg = ['ok' => false];
        $total = count($managers) * count($permissions);
        $count = 0;
        foreach ((array) $managers as $manager_id) {
            foreach ((array) $permissions as $permission_id) {
                $res = $model->add($manager_id, $permission_id);
                if ($res['ok']) {
                    $ret_msg['ok'] = true;
                    $count++;
                }
            }
        }
        if ($count == $total) {
            $ret_msg['msg'] = '授权完毕';
        } elseif (!$count) {
            $ret_msg['msg'] = '授权全失败';
        } else {
            $ret_msg['msg'] = '部分授权成功';
        }

        return Json::encode($ret_msg);
    }

    /*
        ajax管理员权限授权
    */
    public function actionGrantManager()
    {
        $manager_id = Yii::$app->request->get('manager_id', '');
        $permission_id = Yii::$app->request->get('permission_id', '');
        $model = new MgManagerPermission();
        $ret_msg = $model->add($manager_id, $permission_id);
        return Json::encode($ret_msg);
    }

    /*
        管理员权限授权索引页
    */
    public function actionGrantManagerIndex()
    {
        $permission = new MgPermission();
        $permission_list = $permission->findAllByAttributes(['type' => MgPermission::TYPE_MANAGER]);

        return $this->render('grant_manager_index', [
            'permission_list'       => $permission_list,
        ]);
    }

    /*
        ajax移除管理员权限
    */
    public function actionRemoveManager()
    {
        $id = Yii::$app->request->get('id');

        $model = new MgManagerPermission();

        $res = $model->deleteByPk($id);
        if ($res) {
            $ret_msg = ['ok' => true, 'msg' => '删除成功'];
        } else {
            $ret_msg = ['ok' => false, 'msg' => '删除失败'];
        }

        return Json::encode($ret_msg);
    }


}
