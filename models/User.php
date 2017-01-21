<?php

namespace app\models;

/*
    Yii app user登录类
*/
class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $realname;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $manager_model = new MgManager();
        $res = $manager_model->findByPk($id);

        if ($res) {
            $user = [
                'id'            => $manager_model->mongo_id->__toString(),
                'username'      => $manager_model->attributes['name'],
                'realname'      => $manager_model->attributes['real_name'],
                'password'      => $manager_model->attributes['password'],
            ];
            return new static($user);
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $manager_model = new MgManager();
        $manager = $manager_model->findByAttributes(['access_token' => $token, 'status' => '1']);
        if ($manager) {
            $user = [
                'id'            => $manager['_id']->__toString(),
                'username'      => $manager['name'],
                'realname'      => $manager['real_name'],
                'password'      => $manager['password'],
            ];
            return new static($user);
        } else {
            return null;
        }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $manager_model = new MgManager();
        $manager = $manager_model->findByAttributes(['name' => $username, 'status' => '1']);
        if ($manager) {
            $user = [
                'id'            => $manager['_id']->__toString(),
                'username'      => $manager['name'],
                'realname'      => $manager['real_name'],
                'password'      => $manager['password'],
            ];
            return new static($user);
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
