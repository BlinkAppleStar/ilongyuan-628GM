<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_Combat message
 */
class PB_Combat extends \ProtobufMessage
{
    /* Field index constants */
    const STARTTIME = 1;
    const WIN = 2;
    const END_POS = 3;
    const ATTACKER = 4;
    const DEFENDOR = 5;
    const ENDTIME = 6;
    const MAIN_DEFENDOR = 7;
    const MAIN_ATTACKER = 8;
    const BATTLE_TYPE = 9;
    const TARGET_TYPE = 10;
    const BEGIN_POS = 11;
    const HKEY = 12;
    const CUR_POS = 13;
    const STATE = 14;
    const SPEED = 15;
    const BATTLETIME = 16;
    const FORWARD_TIME = 17;
    const BACK_TIME = 18;
    const ADD_SPEED_TIME = 19;
    const GETRES_SPEED = 20;
    const GETRES_TYPE = 21;
    const GETRES_COUNT = 22;
    const TARGET_POS_ID = 23;
    const ATTACKER_LEAGUE = 24;
    const DEFENDER_LEAGUE = 25;
    const DEFENDOR_HKEY = 26;
    const BEGIN_GETRES_TIME = 27;
    const TARGET_ID = 28;
    const STATE_TIME = 29;
    const ASSEMBLE_INFO = 30;
    const COST_STAMINA = 31;
    const COST_LEAGUE_MONSTER_TIMES = 32;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::STARTTIME => array(
            'name' => 'starttime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::WIN => array(
            'name' => 'win',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::END_POS => array(
            'name' => 'end_pos',
            'required' => false,
            'type' => '\PB_Vec2'
        ),
        self::ATTACKER => array(
            'name' => 'attacker',
            'repeated' => true,
            'type' => '\PB_CombatGamer'
        ),
        self::DEFENDOR => array(
            'name' => 'defendor',
            'repeated' => true,
            'type' => '\PB_CombatGamer'
        ),
        self::ENDTIME => array(
            'name' => 'endtime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MAIN_DEFENDOR => array(
            'name' => 'main_defendor',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MAIN_ATTACKER => array(
            'name' => 'main_attacker',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BATTLE_TYPE => array(
            'name' => 'battle_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TARGET_TYPE => array(
            'name' => 'target_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BEGIN_POS => array(
            'name' => 'begin_pos',
            'required' => false,
            'type' => '\PB_Vec2'
        ),
        self::HKEY => array(
            'name' => 'hkey',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CUR_POS => array(
            'name' => 'cur_pos',
            'required' => false,
            'type' => '\PB_Vec2'
        ),
        self::STATE => array(
            'name' => 'state',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SPEED => array(
            'name' => 'speed',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::BATTLETIME => array(
            'name' => 'battletime',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FORWARD_TIME => array(
            'name' => 'forward_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BACK_TIME => array(
            'name' => 'back_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ADD_SPEED_TIME => array(
            'name' => 'add_speed_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GETRES_SPEED => array(
            'name' => 'getres_speed',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GETRES_TYPE => array(
            'name' => 'getres_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GETRES_COUNT => array(
            'name' => 'getres_count',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TARGET_POS_ID => array(
            'name' => 'target_pos_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ATTACKER_LEAGUE => array(
            'name' => 'attacker_league',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DEFENDER_LEAGUE => array(
            'name' => 'defender_league',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DEFENDOR_HKEY => array(
            'name' => 'defendor_hkey',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BEGIN_GETRES_TIME => array(
            'name' => 'begin_getres_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TARGET_ID => array(
            'name' => 'target_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STATE_TIME => array(
            'name' => 'state_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ASSEMBLE_INFO => array(
            'name' => 'assemble_info',
            'required' => false,
            'type' => '\PB_CombatAssemble'
        ),
        self::COST_STAMINA => array(
            'name' => 'cost_stamina',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::COST_LEAGUE_MONSTER_TIMES => array(
            'name' => 'cost_league_monster_times',
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
        $this->values[self::STARTTIME] = null;
        $this->values[self::WIN] = null;
        $this->values[self::END_POS] = null;
        $this->values[self::ATTACKER] = array();
        $this->values[self::DEFENDOR] = array();
        $this->values[self::ENDTIME] = null;
        $this->values[self::MAIN_DEFENDOR] = null;
        $this->values[self::MAIN_ATTACKER] = null;
        $this->values[self::BATTLE_TYPE] = null;
        $this->values[self::TARGET_TYPE] = null;
        $this->values[self::BEGIN_POS] = null;
        $this->values[self::HKEY] = null;
        $this->values[self::CUR_POS] = null;
        $this->values[self::STATE] = null;
        $this->values[self::SPEED] = null;
        $this->values[self::BATTLETIME] = null;
        $this->values[self::FORWARD_TIME] = null;
        $this->values[self::BACK_TIME] = null;
        $this->values[self::ADD_SPEED_TIME] = null;
        $this->values[self::GETRES_SPEED] = null;
        $this->values[self::GETRES_TYPE] = null;
        $this->values[self::GETRES_COUNT] = null;
        $this->values[self::TARGET_POS_ID] = null;
        $this->values[self::ATTACKER_LEAGUE] = null;
        $this->values[self::DEFENDER_LEAGUE] = null;
        $this->values[self::DEFENDOR_HKEY] = null;
        $this->values[self::BEGIN_GETRES_TIME] = null;
        $this->values[self::TARGET_ID] = null;
        $this->values[self::STATE_TIME] = null;
        $this->values[self::ASSEMBLE_INFO] = null;
        $this->values[self::COST_STAMINA] = null;
        $this->values[self::COST_LEAGUE_MONSTER_TIMES] = null;
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
     * Sets value of 'starttime' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStarttime($value)
    {
        return $this->set(self::STARTTIME, $value);
    }

    /**
     * Returns value of 'starttime' property
     *
     * @return integer
     */
    public function getStarttime()
    {
        $value = $this->get(self::STARTTIME);
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
     * Sets value of 'end_pos' property
     *
     * @param \PB_Vec2 $value Property value
     *
     * @return null
     */
    public function setEndPos(\PB_Vec2 $value=null)
    {
        return $this->set(self::END_POS, $value);
    }

    /**
     * Returns value of 'end_pos' property
     *
     * @return \PB_Vec2
     */
    public function getEndPos()
    {
        return $this->get(self::END_POS);
    }

    /**
     * Appends value to 'attacker' list
     *
     * @param \PB_CombatGamer $value Value to append
     *
     * @return null
     */
    public function appendAttacker(\PB_CombatGamer $value)
    {
        return $this->append(self::ATTACKER, $value);
    }

    /**
     * Clears 'attacker' list
     *
     * @return null
     */
    public function clearAttacker()
    {
        return $this->clear(self::ATTACKER);
    }

    /**
     * Returns 'attacker' list
     *
     * @return \PB_CombatGamer[]
     */
    public function getAttacker()
    {
        return $this->get(self::ATTACKER);
    }

    /**
     * Returns 'attacker' iterator
     *
     * @return \ArrayIterator
     */
    public function getAttackerIterator()
    {
        return new \ArrayIterator($this->get(self::ATTACKER));
    }

    /**
     * Returns element from 'attacker' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_CombatGamer
     */
    public function getAttackerAt($offset)
    {
        return $this->get(self::ATTACKER, $offset);
    }

    /**
     * Returns count of 'attacker' list
     *
     * @return int
     */
    public function getAttackerCount()
    {
        return $this->count(self::ATTACKER);
    }

    /**
     * Appends value to 'defendor' list
     *
     * @param \PB_CombatGamer $value Value to append
     *
     * @return null
     */
    public function appendDefendor(\PB_CombatGamer $value)
    {
        return $this->append(self::DEFENDOR, $value);
    }

    /**
     * Clears 'defendor' list
     *
     * @return null
     */
    public function clearDefendor()
    {
        return $this->clear(self::DEFENDOR);
    }

    /**
     * Returns 'defendor' list
     *
     * @return \PB_CombatGamer[]
     */
    public function getDefendor()
    {
        return $this->get(self::DEFENDOR);
    }

    /**
     * Returns 'defendor' iterator
     *
     * @return \ArrayIterator
     */
    public function getDefendorIterator()
    {
        return new \ArrayIterator($this->get(self::DEFENDOR));
    }

    /**
     * Returns element from 'defendor' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_CombatGamer
     */
    public function getDefendorAt($offset)
    {
        return $this->get(self::DEFENDOR, $offset);
    }

    /**
     * Returns count of 'defendor' list
     *
     * @return int
     */
    public function getDefendorCount()
    {
        return $this->count(self::DEFENDOR);
    }

    /**
     * Sets value of 'endtime' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setEndtime($value)
    {
        return $this->set(self::ENDTIME, $value);
    }

    /**
     * Returns value of 'endtime' property
     *
     * @return integer
     */
    public function getEndtime()
    {
        $value = $this->get(self::ENDTIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'main_defendor' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMainDefendor($value)
    {
        return $this->set(self::MAIN_DEFENDOR, $value);
    }

    /**
     * Returns value of 'main_defendor' property
     *
     * @return integer
     */
    public function getMainDefendor()
    {
        $value = $this->get(self::MAIN_DEFENDOR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'main_attacker' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMainAttacker($value)
    {
        return $this->set(self::MAIN_ATTACKER, $value);
    }

    /**
     * Returns value of 'main_attacker' property
     *
     * @return integer
     */
    public function getMainAttacker()
    {
        $value = $this->get(self::MAIN_ATTACKER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'battle_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBattleType($value)
    {
        return $this->set(self::BATTLE_TYPE, $value);
    }

    /**
     * Returns value of 'battle_type' property
     *
     * @return integer
     */
    public function getBattleType()
    {
        $value = $this->get(self::BATTLE_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'target_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTargetType($value)
    {
        return $this->set(self::TARGET_TYPE, $value);
    }

    /**
     * Returns value of 'target_type' property
     *
     * @return integer
     */
    public function getTargetType()
    {
        $value = $this->get(self::TARGET_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'begin_pos' property
     *
     * @param \PB_Vec2 $value Property value
     *
     * @return null
     */
    public function setBeginPos(\PB_Vec2 $value=null)
    {
        return $this->set(self::BEGIN_POS, $value);
    }

    /**
     * Returns value of 'begin_pos' property
     *
     * @return \PB_Vec2
     */
    public function getBeginPos()
    {
        return $this->get(self::BEGIN_POS);
    }

    /**
     * Sets value of 'hkey' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setHkey($value)
    {
        return $this->set(self::HKEY, $value);
    }

    /**
     * Returns value of 'hkey' property
     *
     * @return string
     */
    public function getHkey()
    {
        $value = $this->get(self::HKEY);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'cur_pos' property
     *
     * @param \PB_Vec2 $value Property value
     *
     * @return null
     */
    public function setCurPos(\PB_Vec2 $value=null)
    {
        return $this->set(self::CUR_POS, $value);
    }

    /**
     * Returns value of 'cur_pos' property
     *
     * @return \PB_Vec2
     */
    public function getCurPos()
    {
        return $this->get(self::CUR_POS);
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
     * Sets value of 'speed' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setSpeed($value)
    {
        return $this->set(self::SPEED, $value);
    }

    /**
     * Returns value of 'speed' property
     *
     * @return double
     */
    public function getSpeed()
    {
        $value = $this->get(self::SPEED);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Sets value of 'battletime' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBattletime($value)
    {
        return $this->set(self::BATTLETIME, $value);
    }

    /**
     * Returns value of 'battletime' property
     *
     * @return integer
     */
    public function getBattletime()
    {
        $value = $this->get(self::BATTLETIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'forward_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setForwardTime($value)
    {
        return $this->set(self::FORWARD_TIME, $value);
    }

    /**
     * Returns value of 'forward_time' property
     *
     * @return integer
     */
    public function getForwardTime()
    {
        $value = $this->get(self::FORWARD_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'back_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBackTime($value)
    {
        return $this->set(self::BACK_TIME, $value);
    }

    /**
     * Returns value of 'back_time' property
     *
     * @return integer
     */
    public function getBackTime()
    {
        $value = $this->get(self::BACK_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'add_speed_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAddSpeedTime($value)
    {
        return $this->set(self::ADD_SPEED_TIME, $value);
    }

    /**
     * Returns value of 'add_speed_time' property
     *
     * @return integer
     */
    public function getAddSpeedTime()
    {
        $value = $this->get(self::ADD_SPEED_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'getres_speed' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGetresSpeed($value)
    {
        return $this->set(self::GETRES_SPEED, $value);
    }

    /**
     * Returns value of 'getres_speed' property
     *
     * @return integer
     */
    public function getGetresSpeed()
    {
        $value = $this->get(self::GETRES_SPEED);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'getres_type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGetresType($value)
    {
        return $this->set(self::GETRES_TYPE, $value);
    }

    /**
     * Returns value of 'getres_type' property
     *
     * @return integer
     */
    public function getGetresType()
    {
        $value = $this->get(self::GETRES_TYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'getres_count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGetresCount($value)
    {
        return $this->set(self::GETRES_COUNT, $value);
    }

    /**
     * Returns value of 'getres_count' property
     *
     * @return integer
     */
    public function getGetresCount()
    {
        $value = $this->get(self::GETRES_COUNT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'target_pos_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTargetPosId($value)
    {
        return $this->set(self::TARGET_POS_ID, $value);
    }

    /**
     * Returns value of 'target_pos_id' property
     *
     * @return integer
     */
    public function getTargetPosId()
    {
        $value = $this->get(self::TARGET_POS_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'attacker_league' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAttackerLeague($value)
    {
        return $this->set(self::ATTACKER_LEAGUE, $value);
    }

    /**
     * Returns value of 'attacker_league' property
     *
     * @return integer
     */
    public function getAttackerLeague()
    {
        $value = $this->get(self::ATTACKER_LEAGUE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'defender_league' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDefenderLeague($value)
    {
        return $this->set(self::DEFENDER_LEAGUE, $value);
    }

    /**
     * Returns value of 'defender_league' property
     *
     * @return integer
     */
    public function getDefenderLeague()
    {
        $value = $this->get(self::DEFENDER_LEAGUE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'defendor_hkey' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDefendorHkey($value)
    {
        return $this->set(self::DEFENDOR_HKEY, $value);
    }

    /**
     * Returns value of 'defendor_hkey' property
     *
     * @return string
     */
    public function getDefendorHkey()
    {
        $value = $this->get(self::DEFENDOR_HKEY);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'begin_getres_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBeginGetresTime($value)
    {
        return $this->set(self::BEGIN_GETRES_TIME, $value);
    }

    /**
     * Returns value of 'begin_getres_time' property
     *
     * @return integer
     */
    public function getBeginGetresTime()
    {
        $value = $this->get(self::BEGIN_GETRES_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'target_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTargetId($value)
    {
        return $this->set(self::TARGET_ID, $value);
    }

    /**
     * Returns value of 'target_id' property
     *
     * @return integer
     */
    public function getTargetId()
    {
        $value = $this->get(self::TARGET_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'state_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStateTime($value)
    {
        return $this->set(self::STATE_TIME, $value);
    }

    /**
     * Returns value of 'state_time' property
     *
     * @return integer
     */
    public function getStateTime()
    {
        $value = $this->get(self::STATE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'assemble_info' property
     *
     * @param \PB_CombatAssemble $value Property value
     *
     * @return null
     */
    public function setAssembleInfo(\PB_CombatAssemble $value=null)
    {
        return $this->set(self::ASSEMBLE_INFO, $value);
    }

    /**
     * Returns value of 'assemble_info' property
     *
     * @return \PB_CombatAssemble
     */
    public function getAssembleInfo()
    {
        return $this->get(self::ASSEMBLE_INFO);
    }

    /**
     * Sets value of 'cost_stamina' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCostStamina($value)
    {
        return $this->set(self::COST_STAMINA, $value);
    }

    /**
     * Returns value of 'cost_stamina' property
     *
     * @return integer
     */
    public function getCostStamina()
    {
        $value = $this->get(self::COST_STAMINA);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'cost_league_monster_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCostLeagueMonsterTimes($value)
    {
        return $this->set(self::COST_LEAGUE_MONSTER_TIMES, $value);
    }

    /**
     * Returns value of 'cost_league_monster_times' property
     *
     * @return integer
     */
    public function getCostLeagueMonsterTimes()
    {
        $value = $this->get(self::COST_LEAGUE_MONSTER_TIMES);
        return $value === null ? (integer)$value : $value;
    }
}
}