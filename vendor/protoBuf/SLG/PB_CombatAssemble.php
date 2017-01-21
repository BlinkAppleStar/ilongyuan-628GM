<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_CombatAssemble message
 */
class PB_CombatAssemble extends \ProtobufMessage
{
    /* Field index constants */
    const ASSEMBLES = 1;
    const START_TIME = 2;
    const WAIT_TIME = 3;
    const MIN_GAMERS = 4;
    const MAX_GAMERS = 5;
    const AUTOGO = 6;
    const ASSEMBLE_TARGET = 7;
    const IS_ASSEMBLE_MAIN = 8;
    const MAX_SOLDIERS = 9;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ASSEMBLES => array(
            'name' => 'assembles',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::START_TIME => array(
            'name' => 'start_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::WAIT_TIME => array(
            'name' => 'wait_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MIN_GAMERS => array(
            'name' => 'min_gamers',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MAX_GAMERS => array(
            'name' => 'max_gamers',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::AUTOGO => array(
            'name' => 'autogo',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::ASSEMBLE_TARGET => array(
            'name' => 'assemble_target',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IS_ASSEMBLE_MAIN => array(
            'default' => false,
            'name' => 'is_assemble_main',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::MAX_SOLDIERS => array(
            'name' => 'max_soldiers',
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
        $this->values[self::ASSEMBLES] = array();
        $this->values[self::START_TIME] = null;
        $this->values[self::WAIT_TIME] = null;
        $this->values[self::MIN_GAMERS] = null;
        $this->values[self::MAX_GAMERS] = null;
        $this->values[self::AUTOGO] = null;
        $this->values[self::ASSEMBLE_TARGET] = null;
        $this->values[self::IS_ASSEMBLE_MAIN] = self::$fields[self::IS_ASSEMBLE_MAIN]['default'];
        $this->values[self::MAX_SOLDIERS] = null;
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
     * Appends value to 'assembles' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendAssembles($value)
    {
        return $this->append(self::ASSEMBLES, $value);
    }

    /**
     * Clears 'assembles' list
     *
     * @return null
     */
    public function clearAssembles()
    {
        return $this->clear(self::ASSEMBLES);
    }

    /**
     * Returns 'assembles' list
     *
     * @return string[]
     */
    public function getAssembles()
    {
        return $this->get(self::ASSEMBLES);
    }

    /**
     * Returns 'assembles' iterator
     *
     * @return \ArrayIterator
     */
    public function getAssemblesIterator()
    {
        return new \ArrayIterator($this->get(self::ASSEMBLES));
    }

    /**
     * Returns element from 'assembles' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getAssemblesAt($offset)
    {
        return $this->get(self::ASSEMBLES, $offset);
    }

    /**
     * Returns count of 'assembles' list
     *
     * @return int
     */
    public function getAssemblesCount()
    {
        return $this->count(self::ASSEMBLES);
    }

    /**
     * Sets value of 'start_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStartTime($value)
    {
        return $this->set(self::START_TIME, $value);
    }

    /**
     * Returns value of 'start_time' property
     *
     * @return integer
     */
    public function getStartTime()
    {
        $value = $this->get(self::START_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'wait_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setWaitTime($value)
    {
        return $this->set(self::WAIT_TIME, $value);
    }

    /**
     * Returns value of 'wait_time' property
     *
     * @return integer
     */
    public function getWaitTime()
    {
        $value = $this->get(self::WAIT_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'min_gamers' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMinGamers($value)
    {
        return $this->set(self::MIN_GAMERS, $value);
    }

    /**
     * Returns value of 'min_gamers' property
     *
     * @return integer
     */
    public function getMinGamers()
    {
        $value = $this->get(self::MIN_GAMERS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'max_gamers' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMaxGamers($value)
    {
        return $this->set(self::MAX_GAMERS, $value);
    }

    /**
     * Returns value of 'max_gamers' property
     *
     * @return integer
     */
    public function getMaxGamers()
    {
        $value = $this->get(self::MAX_GAMERS);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'autogo' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setAutogo($value)
    {
        return $this->set(self::AUTOGO, $value);
    }

    /**
     * Returns value of 'autogo' property
     *
     * @return boolean
     */
    public function getAutogo()
    {
        $value = $this->get(self::AUTOGO);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'assemble_target' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAssembleTarget($value)
    {
        return $this->set(self::ASSEMBLE_TARGET, $value);
    }

    /**
     * Returns value of 'assemble_target' property
     *
     * @return string
     */
    public function getAssembleTarget()
    {
        $value = $this->get(self::ASSEMBLE_TARGET);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'is_assemble_main' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsAssembleMain($value)
    {
        return $this->set(self::IS_ASSEMBLE_MAIN, $value);
    }

    /**
     * Returns value of 'is_assemble_main' property
     *
     * @return boolean
     */
    public function getIsAssembleMain()
    {
        $value = $this->get(self::IS_ASSEMBLE_MAIN);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'max_soldiers' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMaxSoldiers($value)
    {
        return $this->set(self::MAX_SOLDIERS, $value);
    }

    /**
     * Returns value of 'max_soldiers' property
     *
     * @return integer
     */
    public function getMaxSoldiers()
    {
        $value = $this->get(self::MAX_SOLDIERS);
        return $value === null ? (integer)$value : $value;
    }
}
}