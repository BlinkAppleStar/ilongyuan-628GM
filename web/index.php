<?php
header('Access-Control-Allow-Origin: *');
require(__DIR__ . '/../config/function.php');

$config_dev = __DIR__ . '/../config/dev.php';
$config_prod = __DIR__ . '/../config/prod.php';
error_reporting(E_ALL  ^  E_NOTICE);
if (file_exists($config_dev)) {
    //define('IS_DEV_SITE', true);
    //define('IS_PROD_SITE', false);
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
    //ini_set('display_errors','1');
    //xmp('dev');
    $config_file = $config_dev;
} else {
    //ini_set('display_errors','0');
    //xmp('prod');
    $config_file = $config_prod;
}

$config = require($config_file);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$class_map_arr = require(__DIR__ . '/../config/class_map.php');
Yii::$classMap = array_merge(Yii::$classMap, $class_map_arr);

(new yii\web\Application($config))->run();
