<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'what s this for',
            'enableCsrfValidation' => false,
        ],
        //'cache' => [
            //'class' => 'yii\caching\FileCache',
        //],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'Mdb' => [
            'class' => 'app\components\MongoReader'
        ],
        'Rdb' => [
            'class' => 'app\components\RedisReader'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' => '.html',
            'rules' => [
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],

//        'assetManager' => [
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,
//                    'js' => []
//                    // 'js'=>[]//禁用JQuery (jquery.js)
//                ],
//              /*  'yii\bootstrap\BootstrapPluginAsset' => [
//                    'js'=>[]//禁用JS (bootstrap.js):
//                ],
//                'yii\bootstrap\BootstrapAsset' => [
//                    'css' => [],//禁用Css (bootstrap.css):
//                ],*/
//            ],
//        ],
        
    ],
    'defaultRoute' => 'site/login',
    'params' => [
        'adminEmail' => 'admin@example.com',
        'redisServer' => [
                            'host'      => 'localhost',
                            'port'      => 6379,
                            'password'  => '',
                            'database'  => 0,
                            'lid'       => '',
                        ],
        'MongoServer' => [
                            'host'      => 'localhost',
                            'port'      => 27017,
                            'user'      => '',
                            'password'  => '',
                            'database'  => 'gm',
                        ],
        'ForeignToken'  => '6998ccb31db2888a18be4838fee5ae44',
        'ForeignUrl'    => 'http://dataportal.ilongyuan.com.cn',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
