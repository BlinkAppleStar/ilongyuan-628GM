<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_Build message
 */
class PB_Build extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;
    const LID = 2;
    const LEVEL = 3;
    const HP = 4;
    const STATE = 5;
    const DONE_TIME = 6;
    const BUILD_QUEUE_INDEX = 7;
    const HARVEST_BEGIN_TIME = 8;
    const HARVEST_BEGIN_BID = 9;
    const SUB_INDEX = 10;
    const BEHELPED_TIMES = 11;
    const HELP_ASKED = 12;
    const TOTAL_TIME = 13;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LID => array(
            'name' => 'lid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVEL => array(
            'name' => 'level',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HP => array(
            'name' => 'hp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STATE => array(
            'default' => 3,
            'name' => 'state',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DONE_TIME => array(
            'name' => 'done_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BUILD_QUEUE_INDEX => array(
            'default' => -1,
            'name' => 'build_queue_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HARVEST_BEGIN_TIME => array(
            'name' => 'harvest_begin_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HARVEST_BEGIN_BID => array(
            'name' => 'harvest_begin_bid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SUB_INDEX => array(
            'name' => 'sub_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BEHELPED_TIMES => array(
            'name' => 'behelped_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HELP_ASKED => array(
            'default' => false,
            'name' => 'help_asked',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::TOTAL_TIME => array(
            'name' => 'total_time',
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
        $this->values[self::ID] = null;
        $this->values[self::LID] = null;
        $this->values[self::LEVEL] = null;
        $this->values[self::HP] = null;
        $this->values[self::STATE] = self::$fields[self::STATE]['default'];
        $this->values[self::DONE_TIME] = null;
        $this->values[self::BUILD_QUEUE_INDEX] = self::$fields[self::BUILD_QUEUE_INDEX]['default'];
        $this->values[self::HARVEST_BEGIN_TIME] = null;
        $this->values[self::HARVEST_BEGIN_BID] = null;
        $this->values[self::SUB_INDEX] = null;
        $this->values[self::BEHELPED_TIMES] = null;
        $this->values[self::HELP_ASKED] = self::$fields[self::HELP_ASKED]['default'];
        $this->values[self::TOTAL_TIME] = null;
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
     * Sets value of 'id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setId($value)
    {
        return $this->set(self::ID, $value);
    }

    /**
     * Returns value of 'id' property
     *
     * @return integer
     */
    public function getId()
    {
        $value = $this->get(self::ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'lid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLid($value)
    {
        return $this->set(self::LID, $value);
    }

    /**
     * Returns value of 'lid' property
     *
     * @return integer
     */
    public function getLid()
    {
        $value = $this->get(self::LID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'level' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevel($value)
    {
        return $this->set(self::LEVEL, $value);
    }

    /**
     * Returns value of 'level' property
     *
     * @return integer
     */
    public function getLevel()
    {
        $value = $this->get(self::LEVEL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'hp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHp($value)
    {
        return $this->set(self::HP, $value);
    }

    /**
     * Returns value of 'hp' property
     *
     * @return integer
     */
    public function getHp()
    {
        $value = $this->get(self::HP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'state' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setState($value)
    {
        return $this->set(self::STATE, $value);
    }

    /**
     * Returns value of 'state' property
     *
     * @return integer
     */
    public function getState()
    {
        $value = $this->get(self::STATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'done_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDoneTime($value)
    {
        return $this->set(self::DONE_TIME, $value);
    }

    /**
     * Returns value of 'done_time' property
     *
     * @return integer
     */
    public function getDoneTime()
    {
        $value = $this->get(self::DONE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'build_queue_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBuildQueueIndex($value)
    {
        return $this->set(self::BUILD_QUEUE_INDEX, $value);
    }

    /**
     * Returns value of 'build_queue_index' property
     *
     * @return integer
     */
    public function getBuildQueueIndex()
    {
        $value = $this->get(self::BUILD_QUEUE_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'harvest_begin_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHarvestBeginTime($value)
    {
        return $this->set(self::HARVEST_BEGIN_TIME, $value);
    }

    /**
     * Returns value of 'harvest_begin_time' property
     *
     * @return integer
     */
    public function getHarvestBeginTime()
    {
        $value = $this->get(self::HARVEST_BEGIN_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'harvest_begin_bid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHarvestBeginBid($value)
    {
        return $this->set(self::HARVEST_BEGIN_BID, $value);
    }

    /**
     * Returns value of 'harvest_begin_bid' property
     *
     * @return integer
     */
    public function getHarvestBeginBid()
    {
        $value = $this->get(self::HARVEST_BEGIN_BID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sub_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSubIndex($value)
    {
        return $this->set(self::SUB_INDEX, $value);
    }

    /**
     * Returns value of 'sub_index' property
     *
     * @return integer
     */
    public function getSubIndex()
    {
        $value = $this->get(self::SUB_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'behelped_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBehelpedTimes($value)
    {
        return $this->set(self::BEHELPED_TIMES, $value);
    }

    /**
     * Returns value of 'behelped_times' property
     *
     * @return integer
     */
    public function getBehelpedTimes()
    {
        $value = $this->get(self::BEHELPED_TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'help_asked' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setHelpAsked($value)
    {
        return $this->set(self::HELP_ASKED, $value);
    }

    /**
     * Returns value of 'help_asked' property
     *
     * @return boolean
     */
    public function getHelpAsked()
    {
        $value = $this->get(self::HELP_ASKED);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'total_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTotalTime($value)
    {
        return $this->set(self::TOTAL_TIME, $value);
    }

    /**
     * Returns value of 'total_time' property
     *
     * @return integer
     */
    public function getTotalTime()
    {
        $value = $this->get(self::TOTAL_TIME);
        return $value === null ? (integer)$value : $value;
    }
}
}