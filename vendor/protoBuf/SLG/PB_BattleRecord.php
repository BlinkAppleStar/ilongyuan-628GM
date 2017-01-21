<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_BattleRecord message
 */
class PB_BattleRecord extends \ProtobufMessage
{
    /* Field index constants */
    const ALL = 1;
    const WIN = 2;
    const TIME = 3;
    const SCORE = 4;
    const DRAW = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ALL => array(
            'name' => 'all',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::WIN => array(
            'name' => 'win',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TIME => array(
            'name' => 'time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SCORE => array(
            'name' => 'score',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DRAW => array(
            'name' => 'draw',
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
        $this->values[self::ALL] = null;
        $this->values[self::WIN] = null;
        $this->values[self::TIME] = null;
        $this->values[self::SCORE] = null;
        $this->values[self::DRAW] = null;
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
     * Sets value of 'all' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAll($value)
    {
        return $this->set(self::ALL, $value);
    }

    /**
     * Returns value of 'all' property
     *
     * @return integer
     */
    public function getAll()
    {
        $value = $this->get(self::ALL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'win' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setWin($value)
    {
        return $this->set(self::WIN, $value);
    }

    /**
     * Returns value of 'win' property
     *
     * @return integer
     */
    public function getWin()
    {
        $value = $this->get(self::WIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTime($value)
    {
        return $this->set(self::TIME, $value);
    }

    /**
     * Returns value of 'time' property
     *
     * @return integer
     */
    public function getTime()
    {
        $value = $this->get(self::TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'score' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setScore($value)
    {
        return $this->set(self::SCORE, $value);
    }

    /**
     * Returns value of 'score' property
     *
     * @return integer
     */
    public function getScore()
    {
        $value = $this->get(self::SCORE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'draw' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDraw($value)
    {
        return $this->set(self::DRAW, $value);
    }

    /**
     * Returns value of 'draw' property
     *
     * @return integer
     */
    public function getDraw()
    {
        $value = $this->get(self::DRAW);
        return $value === null ? (integer)$value : $value;
    }
}
}