<?php

//Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

//$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'Mdb' => [
            'class' => 'app\components\MongoReader'
        ],
        'Rdb' => [
            'class' => 'app\components\ConsoleRedisReader'
        ],
    ],
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
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
