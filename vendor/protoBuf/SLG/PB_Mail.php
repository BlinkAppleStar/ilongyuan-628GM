<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_Mail message
 */
class PB_Mail extends \ProtobufMessage
{
    /* Field index constants */
    const MAIL_ID = 1;
    const TYPE = 2;
    const TEMPLATE_ID = 3;
    const CREATE_TIME = 4;
    const READ_TIME = 5;
    const GET_TIME = 6;
    const TITLE = 7;
    const MSG = 8;
    const SENDER_TYPE = 9;
    const SENDER_ID = 10;
    const SENDER_NAME = 11;
    const LEAGUE_ID = 12;
    const LEAGUE_NAME = 13;
    const PACK_IDS = 14;
    const ITEMS = 15;
    const DATA = 16;
    const POS = 17;
    const RECIPIENT_ID = 18;
    const IS_GLOBAL = 19;
    const DELETED = 20;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MAIL_ID => array(
            'name' => 'mail_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TEMPLATE_ID => array(
            'name' => 'template_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CREATE_TIME => array(
            'name' => 'create_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::READ_TIME => array(
            'name' => 'read_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GET_TIME => array(
            'name' => 'get_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TITLE => array(
            'name' => 'title',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::MSG => array(
            'name' => 'msg',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::SENDER_TYPE => array(
            'name' => 'sender_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SENDER_ID => array(
            'name' => 'sender_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SENDER_NAME => array(
            'name' => 'sender_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::LEAGUE_ID => array(
            'name' => 'league_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEAGUE_NAME => array(
            'name' => 'league_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PACK_IDS => array(
            'name' => 'pack_ids',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ITEMS => array(
            'name' => 'items',
            'repeated' => true,
            'type' => '\PB_Item'
        ),
        self::DATA => array(
            'name' => 'data',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::POS => array(
            'name' => 'pos',
            'required' => false,
            'type' => '\PB_Vec2'
        ),
        self::RECIPIENT_ID => array(
            'name' => 'recipient_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::IS_GLOBAL => array(
            'name' => 'is_global',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::DELETED => array(
            'name' => 'deleted',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::MAIL_ID] = null;
        $this->values[self::TYPE] = null;
        $this->values[self::TEMPLATE_ID] = null;
        $this->values[self::CREATE_TIME] = null;
        $this->values[self::READ_TIME] = null;
        $this->values[self::GET_TIME] = null;
        $this->values[self::TITLE] = null;
        $this->values[self::MSG] = null;
        $this->values[self::SENDER_TYPE] = null;
        $this->values[self::SENDER_ID] = null;
        $this->values[self::SENDER_NAME] = null;
        $this->values[self::LEAGUE_ID] = null;
        $this->values[self::LEAGUE_NAME] = null;
        $this->values[self::PACK_IDS] = array();
        $this->values[self::ITEMS] = array();
        $this->values[self::DATA] = null;
        $this->values[self::POS] = null;
        $this->values[self::RECIPIENT_ID] = null;
        $this->values[self::IS_GLOBAL] = null;
        $this->values[self::DELETED] = null;
    }

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'mail_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMailId($value)
    {
        return $this->set(self::MAIL_ID, $value);
    }

    /**
     * Returns value of 'mail_id' property
     *
     * @return integer
     */
    public function getMailId()
    {
        $value = $this->get(self::MAIL_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        $value = $this->get(self::TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'template_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTemplateId($value)
    {
        return $this->set(self::TEMPLATE_ID, $value);
    }

    /**
     * Returns value of 'template_id' property
     *
     * @return integer
     */
    public function getTemplateId()
    {
        $value = $this->get(self::TEMPLATE_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'create_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCreateTime($value)
    {
        return $this->set(self::CREATE_TIME, $value);
    }

    /**
     * Returns value of 'create_time' property
     *
     * @return integer
     */
    public function getCreateTime()
    {
        $value = $this->get(self::CREATE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'read_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReadTime($value)
    {
        return $this->set(self::READ_TIME, $value);
    }

    /**
     * Returns value of 'read_time' property
     *
     * @return integer
     */
    public function getReadTime()
    {
        $value = $this->get(self::READ_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'get_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGetTime($value)
    {
        return $this->set(self::GET_TIME, $value);
    }

    /**
     * Returns value of 'get_time' property
     *
     * @return integer
     */
    public function getGetTime()
    {
        $value = $this->get(self::GET_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'title' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTitle($value)
    {
        return $this->set(self::TITLE, $value);
    }

    /**
     * Returns value of 'title' property
     *
     * @return string
     */
    public function getTitle()
    {
        $value = $this->get(self::TITLE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'msg' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setMsg($value)
    {
        return $this->set(self::MSG, $value);
    }

    /**
     * Returns value of 'msg' property
     *
     * @return string
     */
    public function getMsg()
    {
        $value = $this->get(self::MSG);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'sender_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSenderType($value)
    {
        return $this->set(self::SENDER_TYPE, $value);
    }

    /**
     * Returns value of 'sender_type' property
     *
     * @return integer
     */
    public function getSenderType()
    {
        $value = $this->get(self::SENDER_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sender_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSenderId($value)
    {
        return $this->set(self::SENDER_ID, $value);
    }

    /**
     * Returns value of 'sender_id' property
     *
     * @return integer
     */
    public function getSenderId()
    {
        $value = $this->get(self::SENDER_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sender_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSenderName($value)
    {
        return $this->set(self::SENDER_NAME, $value);
    }

    /**
     * Returns value of 'sender_name' property
     *
     * @return string
     */
    public function getSenderName()
    {
        $value = $this->get(self::SENDER_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'league_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLeagueId($value)
    {
        return $this->set(self::LEAGUE_ID, $value);
    }

    /**
     * Returns value of 'league_id' property
     *
     * @return integer
     */
    public function getLeagueId()
    {
        $value = $this->get(self::LEAGUE_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'league_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLeagueName($value)
    {
        return $this->set(self::LEAGUE_NAME, $value);
    }

    /**
     * Returns value of 'league_name' property
     *
     * @return string
     */
    public function getLeagueName()
    {
        $value = $this->get(self::LEAGUE_NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Appends value to 'pack_ids' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendPackIds($value)
    {
        return $this->append(self::PACK_IDS, $value);
    }

    /**
     * Clears 'pack_ids' list
     *
     * @return null
     */
    public function clearPackIds()
    {
        return $this->clear(self::PACK_IDS);
    }

    /**
     * Returns 'pack_ids' list
     *
     * @return integer[]
     */
    public function getPackIds()
    {
        return $this->get(self::PACK_IDS);
    }

    /**
     * Returns 'pack_ids' iterator
     *
     * @return \ArrayIterator
     */
    public function getPackIdsIterator()
    {
        return new \ArrayIterator($this->get(self::PACK_IDS));
    }

    /**
     * Returns element from 'pack_ids' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getPackIdsAt($offset)
    {
        return $this->get(self::PACK_IDS, $offset);
    }

    /**
     * Returns count of 'pack_ids' list
     *
     * @return int
     */
    public function getPackIdsCount()
    {
        return $this->count(self::PACK_IDS);
    }

    /**
     * Appends value to 'items' list
     *
     * @param \PB_Item $value Value to append
     *
     * @return null
     */
    public function appendItems(\PB_Item $value)
    {
        return $this->append(self::ITEMS, $value);
    }

    /**
     * Clears 'items' list
     *
     * @return null
     */
    public function clearItems()
    {
        return $this->clear(self::ITEMS);
    }

    /**
     * Returns 'items' list
     *
     * @return \PB_Item[]
     */
    public function getItems()
    {
        return $this->get(self::ITEMS);
    }

    /**
     * Returns 'items' iterator
     *
     * @return \ArrayIterator
     */
    public function getItemsIterator()
    {
        return new \ArrayIterator($this->get(self::ITEMS));
    }

    /**
     * Returns element from 'items' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_Item
     */
    public function getItemsAt($offset)
    {
        return $this->get(self::ITEMS, $offset);
    }

    /**
     * Returns count of 'items' list
     *
     * @return int
     */
    public function getItemsCount()
    {
        return $this->count(self::ITEMS);
    }

    /**
     * Sets value of 'data' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setData($value)
    {
        return $this->set(self::DATA, $value);
    }

    /**
     * Returns value of 'data' property
     *
     * @return string
     */
    public function getData()
    {
        $value = $this->get(self::DATA);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'pos' property
     *
     * @param \PB_Vec2 $value Property value
     *
     * @return null
     */
    public function setPos(\PB_Vec2 $value=null)
    {
        return $this->set(self::POS, $value);
    }

    /**
     * Returns value of 'pos' property
     *
     * @return \PB_Vec2
     */
    public function getPos()
    {
        return $this->get(self::POS);
    }

    /**
     * Sets value of 'recipient_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRecipientId($value)
    {
        return $this->set(self::RECIPIENT_ID, $value);
    }

    /**
     * Returns value of 'recipient_id' property
     *
     * @return integer
     */
    public function getRecipientId()
    {
        $value = $this->get(self::RECIPIENT_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'IS_GLOBAL' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsGlobal($value)
    {
        return $this->set(self::IS_GLOBAL, $value);
    }

    /**
     * Returns value of 'global' property
     *
     * @return boolean
     */
    public function getIsGlobal()
    {
        $value = $this->get(self::IS_GLOBAL);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'deleted' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setDeleted($value)
    {
        return $this->set(self::DELETED, $value);
    }

    /**
     * Returns value of 'deleted' property
     *
     * @return boolean
     */
    public function getDeleted()
    {
        $value = $this->get(self::DELETED);
        return $value === null ? (boolean)$value : $value;
    }
}
}