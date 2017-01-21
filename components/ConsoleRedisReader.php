<?php
/*
    这个Redis接口不接受 cookie配置
*/
namespace app\components;
 
use Yii;
use yii\base\Component;

class ConsoleRedisReader extends Component
{
    public $conn = null;

    public $host = '';
    public $port = '';
    public $password = '';
    public $lid = '';

    public function __construct()
    {
        $this->connect();
    }

    // 长连接有时候可能会断开redis
    public function isConnected()
    {
        return $this->conn !== null;
    }

    /*
        // 短链接
        @params $server = [
            'host' => xxx,
            'port' => xxx,
            'password' => xxx,
        ]
        @return boolean 是否连接成功
    */
    public function connect($server = [])
    {
        if ($server['host']) {
            $this->host = $server['host'];
            $this->port = $server['port'];
            $this->password = $server['password'];
            $this->lid = $server['lid'];
        } elseif (!$this->host) {
            $this->host = Yii::$app->params['redisServer']['host'];
            $this->port = Yii::$app->params['redisServer']['port'];
            $this->password = Yii::$app->params['redisServer']['password'];
            $this->lid = Yii::$app->params['redisServer']['lid'];
        }

        $redis = new \Redis();
        try {
            $result = $redis->connect($this->host, $this->port, 1);
        } catch (\Exception $e) {
            $result = false;
        }
        if ($result) {
            if ($this->password) {
                $redis->auth($this->password);
            }
            $this->conn = $redis;
        }
        return $result;
    }

}