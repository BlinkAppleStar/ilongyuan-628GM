<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_GamerRecharge message
 */
class PB_GamerRecharge extends \ProtobufMessage
{
    /* Field index constants */
    const RMB = 1;
    const GAMER = 2;
    const GOOD_ID = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::RMB => array(
            'name' => 'rmb',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GAMER => array(
            'name' => 'gamer',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GOOD_ID => array(
            'name' => 'good_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
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
        $this->values[self::RMB] = null;
        $this->values[self::GAMER] = null;
        $this->values[self::GOOD_ID] = null;
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
     * Sets value of 'rmb' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRmb($value)
    {
        return $this->set(self::RMB, $value);
    }

    /**
     * Returns value of 'rmb' property
     *
     * @return integer
     */
    public function getRmb()
    {
        $value = $this->get(self::RMB);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'gamer' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGamer($value)
    {
        return $this->set(self::GAMER, $value);
    }

    /**
     * Returns value of 'gamer' property
     *
     * @return integer
     */
    public function getGamer()
    {
        $value = $this->get(self::GAMER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'good_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGoodId($value)
    {
        return $this->set(self::GOOD_ID, $value);
    }

    /**
     * Returns value of 'good_id' property
     *
     * @return integer
     */
    public function getGoodId()
    {
        $value = $this->get(self::GOOD_ID);
        return $value === null ? (integer)$value : $value;
    }
}
}