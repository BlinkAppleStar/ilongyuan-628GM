<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['email'],
//                'rules' => [
//                    [
//                        'controllers' => ['email'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->request->isAjax || Yii::$app->request->get('ajax')) {
            if (Yii::$app->user->isGuest) {
                echo Json::encode(['ok' => false, 'msg' => '未登录']);
                return false;
            } else {
                return true;
            }
        } else {
            if (Yii::$app->user->isGuest) {
                return $this->redirect('/site/login');
            } else {
                return true; // or false to not run the action
            }
        }
    }
}
