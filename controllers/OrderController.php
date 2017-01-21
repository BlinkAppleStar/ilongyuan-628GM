<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Url;
use app\models\PbApi;
use app\models\MgRole;

class OrderController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect('recharge');
    }

    public function actionRecharge()
    {
        return $this->render('recharge', [
            
        ]);
    }

    /*
        充值接口
    */
    public function actionRechargeGamer()
    {
        $uid = Yii::$app->request->post('uid');
        $amount = Yii::$app->request->post('amount');
        $goods_id = Yii::$app->request->post('goods_id');

        $role_model = new MgRole();
        $role_model->setRedisByUid($uid);

        $api = new PbApi();
        $ret_msg = $api->createGamerRecharge($uid, $amount, $goods_id);

        return Json::encode($ret_msg);
    }

}
