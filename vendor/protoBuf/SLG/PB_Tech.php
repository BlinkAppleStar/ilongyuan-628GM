<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_Tech message
 */
class PB_Tech extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;
    const LEVELUP_TIME = 2;
    const BEHELPED_TIMES = 3;
    const HELP_ASKED = 4;
    const TOTAL_TIME = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVELUP_TIME => array(
            'name' => 'levelup_time',
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
        $this->values[self::LEVELUP_TIME] = null;
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
     * Sets value of 'levelup_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevelupTime($value)
    {
        return $this->set(self::LEVELUP_TIME, $value);
    }

    /**
     * Returns value of 'levelup_time' property
     *
     * @return integer
     */
    public function getLevelupTime()
    {
        $value = $this->get(self::LEVELUP_TIME);
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