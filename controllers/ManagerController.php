<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\MgManager;

class ManagerController extends BaseController
{
    /*
        管理员列表数据
    */
    public function actionList()
    {
        $model = new MgManager();
        $list = $model->findAllByAttributes();
        
        foreach ($list as &$manager) {
            $manager['created_time'] = date('Y-m-d H:i:s', $manager['created_time']);
            $manager['last_login'] = date('Y-m-d H:i:s', $manager['last_login']);
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            return Json::encode(['ok' => true, 'msg' => '获取成功', 'data' => $list]);
        } else {
            return $this->render('index', [
                'list'          => $list,
            ]);
        }
    }

    /*
        管理员新增/编辑
    */
    public function actionEdit()
    {
        $mongo_id = Yii::$app->request->post('mongo_id') ? Yii::$app->request->post('mongo_id') : Yii::$app->request->get('mongo_id');

        $model = new MgManager();
        $res = $model->findByPk($mongo_id);
        if ($res) {
            $action = 'Edit';
        } else {
            $action = 'Add';
        }

        if (Yii::$app->request->isPost) {


            $model->attributes = [
                'name'          => Yii::$app->request->post('name', ''),
                'password'      => md5(Yii::$app->request->post('password', '')),
                'email'         => Yii::$app->request->post('email', ''),
                'real_name'     => Yii::$app->request->post('real_name', ''),
                'status'        => Yii::$app->request->post('status', '1'),

                'created_time'  => ($action == 'Add' ? time() : $model->attributes['created_time']),
                'last_login'    => ($model->attributes['last_login'] ? $model->attributes['last_login'] : 0),
            ];

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

}
