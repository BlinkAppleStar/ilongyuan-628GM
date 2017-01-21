<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Mongo 模型类
 *
 *
 */
class MongoModel extends Model
{
    public $col = null;

    public $attributes = [];
    public $mongo_id = null;

    public $tableName = '';

    public function __construct()
    {
        $this->col = Yii::$app->Mdb->conn->selectDB(Yii::$app->params['MongoServer']['database'])->selectCollection($this->tableName);
    }

    /*
        查询 list 数据
        @params $query = array(
            'field'            => xxx,  
        )
        @params $skip 从第几条开始
        @params $limit 限制数量
        @params $sort = array(
            'field'     => 1, // 1为ASC, -1为DESC
        )
        @return array(
            '_id'   => array(
                'field' => xxx,
                ...
            ),
            ...
        )
    */
    public function findAllByAttributes($query = [], $skip = 0, $limit = 0, $sort = [])
    {
        $cursor = $this->col->find($query);
        if ($sort) {
            $cursor->sort($sort);
        }
        if ($skip) {
            $cursor->skip($skip);
        }
        if ($limit) {
            $cursor->limit($limit);
        }
        return iterator_to_array($cursor);
    }

    /*
        查询一条数据
        @params $query = array(
            ’s’ =>array(’$lt’=>100)
        )
        @params $fields = array(
            ’a'=>true,
            ’b'=>true,
        )
        @return array(
            'field_1' => xxx,
            ...
        );
    */
    public function findByAttributes($query = [], $fields = [])
    {
        return $this->col->findOne($query, $fields);
    }

    /*
        查询分页list数据
        @params $query = array(
            'field'            => xxx,  
        )
        @params $skip 从第几条开始
        @params $limit 限制数量
        @params $sort = array(
            'field'     => 1, // 1为ASC, -1为DESC
        )
        @return array(
            'total' => 总条数,
            'list' => array(), // 当页列表
        )
    */
    public function findListByAttributes($query = [], $skip = 0, $limit = 0, $sort = [])
    {
        $cursor = $this->col->find($query);
        $total = $cursor->count();
        if ($sort) {
            $cursor->sort($sort);
        }
        if ($skip) {
            $cursor->skip($skip);
        }
        if ($limit) {
            $cursor->limit($limit);
        }
        $current_page_data = iterator_to_array($cursor);
        return [
            'total' => $total,
            'list' => $current_page_data,
        ];
    }

    /*
        查询数据迭代器（下载时循环迭代器更快）
    */
    public function getCursorByAttributes($query)
    {
        return $this->col->find($query);
    }

    /*
        插入/更新
    */
    public function save($options = [])
    {
        if ($this->attributes) {
            $attributes = $this->attributes;
            if (!$this->mongo_id) {
                $this->mongo_id = new \MongoId();
            }
            $attributes['_id'] = $this->mongo_id;
            $res = $this->col->save($attributes, $options);
        }
        return $res;
    }

    /*
        @param  $id = string // ID字符串 24 个十六进制字符
    */
    public function findByPk($id)
    {
        $ret = false;
        if (\MongoId::isValid($id)) {
            $_id = new \MongoId($id);
            $res = $this->col->findOne(['_id' => $_id]);
            if ($res) {
                $this->mongo_id = $res['_id'];
                $this->attributes = $res;
                $ret = true;
            } else { //避免连续调用问题
                $this->mongo_id = null;
                $this->attributes = [];
            }
        }
        return $ret;
    }

    /*
        @param  $id = string // ID字符串 24 个十六进制字符
    */
    public function deleteByPk($id)
    {
        $ret = false;
        if (\MongoId::isValid($id)) {
            $_id = new \MongoId($id);
            $res = $this->col->remove(['_id' => $_id]);
            if ($res) {
                $this->mongo_id = null;
                $this->attributes = [];

                $ret = true;
            }
        }
        return $ret;
    }

    /*
        @param $query = array()
    */
    public function deleteByAttributes($query, $options = [])
    {
        return $this->col->remove($query, $options);
    }

    /*
        @param $query = array()
    */
    public function updateByAttributes($query, $value, $options = [])
    {
        return $this->col->update($query, $value, $options);
    }
}
