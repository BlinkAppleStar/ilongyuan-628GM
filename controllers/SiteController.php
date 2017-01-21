<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MgManagerPermission;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['login', 'logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'], // 仅限登录用户访问
//                    ],
//                    [
//                        'actions' => ['login'],
//                        'allow' => true,
//                        'roles' => ['?'], // 仅限未登录用户访问
//                    ],
//                ],
//            ],
////            'verbs' => [
////                'class' => VerbFilter::className(),
////                'actions' => [
////                    'logout' => ['post'], // 仅限post方式访问
////                ],
////            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,
                'maxLength' => 4,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/static/index.html');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/static/index.html');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/site/login');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /*
        获取登录状态
    */
    public function actionCheckLogin()
    {
        if (Yii::$app->user->isGuest) {
            $ret_msg = ['ok' => false, 'msg' => '未登录'];
        } else {
            $login_manager = Yii::$app->user->_identity;
            $info = [
                'manager_id'        => $login_manager->id,
                'real_name'         => $login_manager->realname,
                'foreign_token'     => Yii::$app->params['ForeignToken'],
                'foreign_url'       => Yii::$app->params['ForeignUrl'],
                'left_menu_html'    => $this->renderPartial('left_menu', [
                                            'manager_id'    => Yii::$app->user->id,
                                            'permission'    => new MgManagerPermission(),
                                            'real_name'     => $login_manager->realname,
                                        ],
                                        true),
            ];

            $ret_msg = ['ok' => true, 'msg' => '已登录', 'data' => $info];
        }

        return Json::encode($ret_msg);
    }
}
