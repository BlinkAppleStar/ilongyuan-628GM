<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_Soldier message
 */
class PB_Soldier extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;
    const NUM = 3;
    const PRODUCE_NUM = 4;
    const PRODUCE_TIME = 5;
    const RELIVE_NUM = 6;
    const RELIVE_TIME = 7;
    const INJURED_NUM = 8;
    const DIED_NUM = 9;
    const KILL_NUM = 10;
    const _DUMMY = 11;
    const PRODUCE_TOTAL_TIME = 12;
    const RELIVE_TOTAL_TIME = 13;
    const COMBAT_NUM = 14;
    const HERO_GRADE = 50;
    const HERO_HP = 51;
    const HERO_HP_PERCENT = 52;
    const HERO_LOSS_PERCENT = 53;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NUM => array(
            'name' => 'num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_NUM => array(
            'name' => 'produce_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PRODUCE_TIME => array(
            'name' => 'produce_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RELIVE_NUM => array(
            'name' => 'relive_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RELIVE_TIME => array(
            'name' => 'relive_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::INJURED_NUM => array(
            'name' => 'injured_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DIED_NUM => array(
            'name' => 'died_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::KILL_NUM => array(
            'name' => 'kill_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::_DUMMY => array(
            'default' => false,
            'name' => '_dummy',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::PRODUCE_TOTAL_TIME => array(
            'name' => 'produce_total_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RELIVE_TOTAL_TIME => array(
            'name' => 'relive_total_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::COMBAT_NUM => array(
            'name' => 'combat_num',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HERO_GRADE => array(
            'name' => 'hero_grade',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HERO_HP => array(
            'name' => 'hero_hp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HERO_HP_PERCENT => array(
            'name' => 'hero_hp_percent',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::HERO_LOSS_PERCENT => array(
            'name' => 'hero_loss_percent',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
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
        $this->values[self::NUM] = null;
        $this->values[self::PRODUCE_NUM] = null;
        $this->values[self::PRODUCE_TIME] = null;
        $this->values[self::RELIVE_NUM] = null;
        $this->values[self::RELIVE_TIME] = null;
        $this->values[self::INJURED_NUM] = null;
        $this->values[self::DIED_NUM] = null;
        $this->values[self::KILL_NUM] = null;
        $this->values[self::_DUMMY] = self::$fields[self::_DUMMY]['default'];
        $this->values[self::PRODUCE_TOTAL_TIME] = null;
        $this->values[self::RELIVE_TOTAL_TIME] = null;
        $this->values[self::COMBAT_NUM] = null;
        $this->values[self::HERO_GRADE] = null;
        $this->values[self::HERO_HP] = null;
        $this->values[self::HERO_HP_PERCENT] = null;
        $this->values[self::HERO_LOSS_PERCENT] = null;
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
     * Sets value of 'num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNum($value)
    {
        return $this->set(self::NUM, $value);
    }

    /**
     * Returns value of 'num' property
     *
     * @return integer
     */
    public function getNum()
    {
        $value = $this->get(self::NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceNum($value)
    {
        return $this->set(self::PRODUCE_NUM, $value);
    }

    /**
     * Returns value of 'produce_num' property
     *
     * @return integer
     */
    public function getProduceNum()
    {
        $value = $this->get(self::PRODUCE_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'produce_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceTime($value)
    {
        return $this->set(self::PRODUCE_TIME, $value);
    }

    /**
     * Returns value of 'produce_time' property
     *
     * @return integer
     */
    public function getProduceTime()
    {
        $value = $this->get(self::PRODUCE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'relive_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReliveNum($value)
    {
        return $this->set(self::RELIVE_NUM, $value);
    }

    /**
     * Returns value of 'relive_num' property
     *
     * @return integer
     */
    public function getReliveNum()
    {
        $value = $this->get(self::RELIVE_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'relive_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReliveTime($value)
    {
        return $this->set(self::RELIVE_TIME, $value);
    }

    /**
     * Returns value of 'relive_time' property
     *
     * @return integer
     */
    public function getReliveTime()
    {
        $value = $this->get(self::RELIVE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'injured_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setInjuredNum($value)
    {
        return $this->set(self::INJURED_NUM, $value);
    }

    /**
     * Returns value of 'injured_num' property
     *
     * @return integer
     */
    public function getInjuredNum()
    {
        $value = $this->get(self::INJURED_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'died_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDiedNum($value)
    {
        return $this->set(self::DIED_NUM, $value);
    }

    /**
     * Returns value of 'died_num' property
     *
     * @return integer
     */
    public function getDiedNum()
    {
        $value = $this->get(self::DIED_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'kill_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setKillNum($value)
    {
        return $this->set(self::KILL_NUM, $value);
    }

    /**
     * Returns value of 'kill_num' property
     *
     * @return integer
     */
    public function getKillNum()
    {
        $value = $this->get(self::KILL_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of '_dummy' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setDummy($value)
    {
        return $this->set(self::_DUMMY, $value);
    }

    /**
     * Returns value of '_dummy' property
     *
     * @return boolean
     */
    public function getDummy()
    {
        $value = $this->get(self::_DUMMY);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'produce_total_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProduceTotalTime($value)
    {
        return $this->set(self::PRODUCE_TOTAL_TIME, $value);
    }

    /**
     * Returns value of 'produce_total_time' property
     *
     * @return integer
     */
    public function getProduceTotalTime()
    {
        $value = $this->get(self::PRODUCE_TOTAL_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'relive_total_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReliveTotalTime($value)
    {
        return $this->set(self::RELIVE_TOTAL_TIME, $value);
    }

    /**
     * Returns value of 'relive_total_time' property
     *
     * @return integer
     */
    public function getReliveTotalTime()
    {
        $value = $this->get(self::RELIVE_TOTAL_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'combat_num' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCombatNum($value)
    {
        return $this->set(self::COMBAT_NUM, $value);
    }

    /**
     * Returns value of 'combat_num' property
     *
     * @return integer
     */
    public function getCombatNum()
    {
        $value = $this->get(self::COMBAT_NUM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'hero_grade' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHeroGrade($value)
    {
        return $this->set(self::HERO_GRADE, $value);
    }

    /**
     * Returns value of 'hero_grade' property
     *
     * @return integer
     */
    public function getHeroGrade()
    {
        $value = $this->get(self::HERO_GRADE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'hero_hp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setHeroHp($value)
    {
        return $this->set(self::HERO_HP, $value);
    }

    /**
     * Returns value of 'hero_hp' property
     *
     * @return integer
     */
    public function getHeroHp()
    {
        $value = $this->get(self::HERO_HP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'hero_hp_percent' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setHeroHpPercent($value)
    {
        return $this->set(self::HERO_HP_PERCENT, $value);
    }

    /**
     * Returns value of 'hero_hp_percent' property
     *
     * @return double
     */
    public function getHeroHpPercent()
    {
        $value = $this->get(self::HERO_HP_PERCENT);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'hero_loss_percent' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setHeroLossPercent($value)
    {
        return $this->set(self::HERO_LOSS_PERCENT, $value);
    }

    /**
     * Returns value of 'hero_loss_percent' property
     *
     * @return double
     */
    public function getHeroLossPercent()
    {
        $value = $this->get(self::HERO_LOSS_PERCENT);
        return $value === null ? (double)$value : $value;
    }
}
}