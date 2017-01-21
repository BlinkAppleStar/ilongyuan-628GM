<?php

namespace app\components;
 
use Yii;
use yii\base\Component;

class MongoReader extends Component
{
    public $conn = null;

    public function __construct()
    {
        try {
            $result = new \MongoClient('mongodb://'
                . Yii::$app->params['MongoServer']['host']
                . ':'
                . Yii::$app->params['MongoServer']['port']
                . '/'
                . Yii::$app->params['MongoServer']['database']
            );
            $this->conn = $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public function isConnected()
    {
        return $this->conn !== null;
    }
}