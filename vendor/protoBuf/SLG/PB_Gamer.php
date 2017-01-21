<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_Gamer message
 */
class PB_Gamer extends \ProtobufMessage
{
    /* Field index constants */
    const ID = 1;
    const NAME = 2;
    const LEVEL = 3;
    const _RMB = 4;
    const ALLRMB = 5;
    const VIP = 7;
    const CREATE = 8;
    const LASTLOGIN = 9;
    const PROTECT = 10;
    const MONEY = 11;
    const ICON = 12;
    const SEALED = 13;
    const EXPER = 14;
    const ENERGY = 15;
    const SERVER_IP = 16;
    const SERVER_PORT = 17;
    const BATTLE_RECORD = 18;
    const COST_RECORD = 19;
    const TIME_RECORD = 20;
    const LEAGUE = 21;
    const SERVER_PID = 22;
    const POSITION = 23;
    const RESOURCE = 24;
    const CITY_HP = 25;
    const CITY_FIRE_BEGIN_TIME = 26;
    const CITY_REPAIR_TIME = 27;
    const CITY_FIRE_STATE_TIME = 28;
    const LAST_REFRESH_WISH_TIME = 29;
    const WISH_RES_INDEX = 30;
    const WISH_TOTAL_TIMES = 31;
    const RELIVE_BEHELPED_TIMES = 33;
    const POWER = 34;
    const RELIVE_HELP_ASKED = 35;
    const BATTLE_QUE_COUNT = 36;
    const QUEST_AWARD_RECORD = 37;
    const FAVORITES = 38;
    const GUIDE_DATAS = 39;
    const LEVELUP_HERO_SKILL_HERO = 40;
    const LEVELUP_HERO_SKILL_ID = 41;
    const LEVELUP_HERO_SKILL_TIME = 42;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ID => array(
            'name' => 'id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::LEVEL => array(
            'default' => 1,
            'name' => 'level',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::_RMB => array(
            'name' => '_rmb',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ALLRMB => array(
            'name' => 'allrmb',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VIP => array(
            'name' => 'vip',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CREATE => array(
            'name' => 'create',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LASTLOGIN => array(
            'name' => 'lastlogin',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PROTECT => array(
            'name' => 'protect',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MONEY => array(
            'name' => 'money',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ICON => array(
            'default' => 1,
            'name' => 'icon',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SEALED => array(
            'name' => 'sealed',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::EXPER => array(
            'name' => 'exper',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::ENERGY => array(
            'name' => 'energy',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SERVER_IP => array(
            'name' => 'server_ip',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::SERVER_PORT => array(
            'name' => 'server_port',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BATTLE_RECORD => array(
            'name' => 'battle_record',
            'required' => false,
            'type' => '\PB_BattleRecord'
        ),
        self::COST_RECORD => array(
            'name' => 'cost_record',
            'required' => false,
            'type' => '\PB_CostRecord'
        ),
        self::TIME_RECORD => array(
            'name' => 'time_record',
            'required' => false,
            'type' => '\PB_TimeRecord'
        ),
        self::LEAGUE => array(
            'name' => 'league',
            'required' => false,
            'type' => '\PB_GamerLeague'
        ),
        self::SERVER_PID => array(
            'name' => 'server_pid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POSITION => array(
            'name' => 'position',
            'required' => false,
            'type' => '\PB_Vec2'
        ),
        self::RESOURCE => array(
            'name' => 'resource',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CITY_HP => array(
            'name' => 'city_hp',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CITY_FIRE_BEGIN_TIME => array(
            'name' => 'city_fire_begin_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CITY_REPAIR_TIME => array(
            'name' => 'city_repair_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::CITY_FIRE_STATE_TIME => array(
            'name' => 'city_fire_state_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LAST_REFRESH_WISH_TIME => array(
            'name' => 'last_refresh_wish_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::WISH_RES_INDEX => array(
            'name' => 'wish_res_index',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::WISH_TOTAL_TIMES => array(
            'name' => 'wish_total_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RELIVE_BEHELPED_TIMES => array(
            'name' => 'relive_behelped_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POWER => array(
            'name' => 'power',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RELIVE_HELP_ASKED => array(
            'default' => false,
            'name' => 'relive_help_asked',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::BATTLE_QUE_COUNT => array(
            'default' => 1,
            'name' => 'battle_que_count',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::QUEST_AWARD_RECORD => array(
            'name' => 'quest_award_record',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FAVORITES => array(
            'name' => 'favorites',
            'repeated' => true,
            'type' => '\PB_FavoritePos'
        ),
        self::GUIDE_DATAS => array(
            'name' => 'guide_datas',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVELUP_HERO_SKILL_HERO => array(
            'name' => 'levelup_hero_skill_hero',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVELUP_HERO_SKILL_ID => array(
            'name' => 'levelup_hero_skill_id',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEVELUP_HERO_SKILL_TIME => array(
            'name' => 'levelup_hero_skill_time',
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
        $this->values[self::NAME] = null;
        $this->values[self::LEVEL] = self::$fields[self::LEVEL]['default'];
        $this->values[self::_RMB] = null;
        $this->values[self::ALLRMB] = null;
        $this->values[self::VIP] = null;
        $this->values[self::CREATE] = null;
        $this->values[self::LASTLOGIN] = null;
        $this->values[self::PROTECT] = null;
        $this->values[self::MONEY] = null;
        $this->values[self::ICON] = self::$fields[self::ICON]['default'];
        $this->values[self::SEALED] = null;
        $this->values[self::EXPER] = null;
        $this->values[self::ENERGY] = null;
        $this->values[self::SERVER_IP] = null;
        $this->values[self::SERVER_PORT] = null;
        $this->values[self::BATTLE_RECORD] = null;
        $this->values[self::COST_RECORD] = null;
        $this->values[self::TIME_RECORD] = null;
        $this->values[self::LEAGUE] = null;
        $this->values[self::SERVER_PID] = null;
        $this->values[self::POSITION] = null;
        $this->values[self::RESOURCE] = array();
        $this->values[self::CITY_HP] = null;
        $this->values[self::CITY_FIRE_BEGIN_TIME] = null;
        $this->values[self::CITY_REPAIR_TIME] = null;
        $this->values[self::CITY_FIRE_STATE_TIME] = null;
        $this->values[self::LAST_REFRESH_WISH_TIME] = null;
        $this->values[self::WISH_RES_INDEX] = array();
        $this->values[self::WISH_TOTAL_TIMES] = null;
        $this->values[self::RELIVE_BEHELPED_TIMES] = null;
        $this->values[self::POWER] = null;
        $this->values[self::RELIVE_HELP_ASKED] = self::$fields[self::RELIVE_HELP_ASKED]['default'];
        $this->values[self::BATTLE_QUE_COUNT] = self::$fields[self::BATTLE_QUE_COUNT]['default'];
        $this->values[self::QUEST_AWARD_RECORD] = null;
        $this->values[self::FAVORITES] = array();
        $this->values[self::GUIDE_DATAS] = array();
        $this->values[self::LEVELUP_HERO_SKILL_HERO] = null;
        $this->values[self::LEVELUP_HERO_SKILL_ID] = null;
        $this->values[self::LEVELUP_HERO_SKILL_TIME] = null;
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
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
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
     * Sets value of '_rmb' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRmb($value)
    {
        return $this->set(self::_RMB, $value);
    }

    /**
     * Returns value of '_rmb' property
     *
     * @return integer
     */
    public function getRmb()
    {
        $value = $this->get(self::_RMB);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'allrmb' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setAllrmb($value)
    {
        return $this->set(self::ALLRMB, $value);
    }

    /**
     * Returns value of 'allrmb' property
     *
     * @return integer
     */
    public function getAllrmb()
    {
        $value = $this->get(self::ALLRMB);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'vip' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVip($value)
    {
        return $this->set(self::VIP, $value);
    }

    /**
     * Returns value of 'vip' property
     *
     * @return integer
     */
    public function getVip()
    {
        $value = $this->get(self::VIP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'create' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCreate($value)
    {
        return $this->set(self::CREATE, $value);
    }

    /**
     * Returns value of 'create' property
     *
     * @return integer
     */
    public function getCreate()
    {
        $value = $this->get(self::CREATE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'lastlogin' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLastlogin($value)
    {
        return $this->set(self::LASTLOGIN, $value);
    }

    /**
     * Returns value of 'lastlogin' property
     *
     * @return integer
     */
    public function getLastlogin()
    {
        $value = $this->get(self::LASTLOGIN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'protect' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setProtect($value)
    {
        return $this->set(self::PROTECT, $value);
    }

    /**
     * Returns value of 'protect' property
     *
     * @return integer
     */
    public function getProtect()
    {
        $value = $this->get(self::PROTECT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'money' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMoney($value)
    {
        return $this->set(self::MONEY, $value);
    }

    /**
     * Returns value of 'money' property
     *
     * @return integer
     */
    public function getMoney()
    {
        $value = $this->get(self::MONEY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'icon' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIcon($value)
    {
        return $this->set(self::ICON, $value);
    }

    /**
     * Returns value of 'icon' property
     *
     * @return integer
     */
    public function getIcon()
    {
        $value = $this->get(self::ICON);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'sealed' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSealed($value)
    {
        return $this->set(self::SEALED, $value);
    }

    /**
     * Returns value of 'sealed' property
     *
     * @return integer
     */
    public function getSealed()
    {
        $value = $this->get(self::SEALED);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'exper' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setExper($value)
    {
        return $this->set(self::EXPER, $value);
    }

    /**
     * Returns value of 'exper' property
     *
     * @return integer
     */
    public function getExper()
    {
        $value = $this->get(self::EXPER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'energy' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setEnergy($value)
    {
        return $this->set(self::ENERGY, $value);
    }

    /**
     * Returns value of 'energy' property
     *
     * @return integer
     */
    public function getEnergy()
    {
        $value = $this->get(self::ENERGY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'server_ip' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setServerIp($value)
    {
        return $this->set(self::SERVER_IP, $value);
    }

    /**
     * Returns value of 'server_ip' property
     *
     * @return string
     */
    public function getServerIp()
    {
        $value = $this->get(self::SERVER_IP);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'server_port' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setServerPort($value)
    {
        return $this->set(self::SERVER_PORT, $value);
    }

    /**
     * Returns value of 'server_port' property
     *
     * @return integer
     */
    public function getServerPort()
    {
        $value = $this->get(self::SERVER_PORT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'battle_record' property
     *
     * @param \PB_BattleRecord $value Property value
     *
     * @return null
     */
    public function setBattleRecord(\PB_BattleRecord $value=null)
    {
        return $this->set(self::BATTLE_RECORD, $value);
    }

    /**
     * Returns value of 'battle_record' property
     *
     * @return \PB_BattleRecord
     */
    public function getBattleRecord()
    {
        return $this->get(self::BATTLE_RECORD);
    }

    /**
     * Sets value of 'cost_record' property
     *
     * @param \PB_CostRecord $value Property value
     *
     * @return null
     */
    public function setCostRecord(\PB_CostRecord $value=null)
    {
        return $this->set(self::COST_RECORD, $value);
    }

    /**
     * Returns value of 'cost_record' property
     *
     * @return \PB_CostRecord
     */
    public function getCostRecord()
    {
        return $this->get(self::COST_RECORD);
    }

    /**
     * Sets value of 'time_record' property
     *
     * @param \PB_TimeRecord $value Property value
     *
     * @return null
     */
    public function setTimeRecord(\PB_TimeRecord $value=null)
    {
        return $this->set(self::TIME_RECORD, $value);
    }

    /**
     * Returns value of 'time_record' property
     *
     * @return \PB_TimeRecord
     */
    public function getTimeRecord()
    {
        return $this->get(self::TIME_RECORD);
    }

    /**
     * Sets value of 'league' property
     *
     * @param \PB_GamerLeague $value Property value
     *
     * @return null
     */
    public function setLeague(\PB_GamerLeague $value=null)
    {
        return $this->set(self::LEAGUE, $value);
    }

    /**
     * Returns value of 'league' property
     *
     * @return \PB_GamerLeague
     */
    public function getLeague()
    {
        return $this->get(self::LEAGUE);
    }

    /**
     * Sets value of 'server_pid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setServerPid($value)
    {
        return $this->set(self::SERVER_PID, $value);
    }

    /**
     * Returns value of 'server_pid' property
     *
     * @return integer
     */
    public function getServerPid()
    {
        $value = $this->get(self::SERVER_PID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'position' property
     *
     * @param \PB_Vec2 $value Property value
     *
     * @return null
     */
    public function setPosition(\PB_Vec2 $value=null)
    {
        return $this->set(self::POSITION, $value);
    }

    /**
     * Returns value of 'position' property
     *
     * @return \PB_Vec2
     */
    public function getPosition()
    {
        return $this->get(self::POSITION);
    }

    /**
     * Appends value to 'resource' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendResource($value)
    {
        return $this->append(self::RESOURCE, $value);
    }

    /**
     * Clears 'resource' list
     *
     * @return null
     */
    public function clearResource()
    {
        return $this->clear(self::RESOURCE);
    }

    /**
     * Returns 'resource' list
     *
     * @return integer[]
     */
    public function getResource()
    {
        return $this->get(self::RESOURCE);
    }

    /**
     * Returns 'resource' iterator
     *
     * @return \ArrayIterator
     */
    public function getResourceIterator()
    {
        return new \ArrayIterator($this->get(self::RESOURCE));
    }

    /**
     * Returns element from 'resource' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getResourceAt($offset)
    {
        return $this->get(self::RESOURCE, $offset);
    }

    /**
     * Returns count of 'resource' list
     *
     * @return int
     */
    public function getResourceCount()
    {
        return $this->count(self::RESOURCE);
    }

    /**
     * Sets value of 'city_hp' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCityHp($value)
    {
        return $this->set(self::CITY_HP, $value);
    }

    /**
     * Returns value of 'city_hp' property
     *
     * @return integer
     */
    public function getCityHp()
    {
        $value = $this->get(self::CITY_HP);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'city_fire_begin_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCityFireBeginTime($value)
    {
        return $this->set(self::CITY_FIRE_BEGIN_TIME, $value);
    }

    /**
     * Returns value of 'city_fire_begin_time' property
     *
     * @return integer
     */
    public function getCityFireBeginTime()
    {
        $value = $this->get(self::CITY_FIRE_BEGIN_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'city_repair_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCityRepairTime($value)
    {
        return $this->set(self::CITY_REPAIR_TIME, $value);
    }

    /**
     * Returns value of 'city_repair_time' property
     *
     * @return integer
     */
    public function getCityRepairTime()
    {
        $value = $this->get(self::CITY_REPAIR_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'city_fire_state_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCityFireStateTime($value)
    {
        return $this->set(self::CITY_FIRE_STATE_TIME, $value);
    }

    /**
     * Returns value of 'city_fire_state_time' property
     *
     * @return integer
     */
    public function getCityFireStateTime()
    {
        $value = $this->get(self::CITY_FIRE_STATE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'last_refresh_wish_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLastRefreshWishTime($value)
    {
        return $this->set(self::LAST_REFRESH_WISH_TIME, $value);
    }

    /**
     * Returns value of 'last_refresh_wish_time' property
     *
     * @return integer
     */
    public function getLastRefreshWishTime()
    {
        $value = $this->get(self::LAST_REFRESH_WISH_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'wish_res_index' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendWishResIndex($value)
    {
        return $this->append(self::WISH_RES_INDEX, $value);
    }

    /**
     * Clears 'wish_res_index' list
     *
     * @return null
     */
    public function clearWishResIndex()
    {
        return $this->clear(self::WISH_RES_INDEX);
    }

    /**
     * Returns 'wish_res_index' list
     *
     * @return integer[]
     */
    public function getWishResIndex()
    {
        return $this->get(self::WISH_RES_INDEX);
    }

    /**
     * Returns 'wish_res_index' iterator
     *
     * @return \ArrayIterator
     */
    public function getWishResIndexIterator()
    {
        return new \ArrayIterator($this->get(self::WISH_RES_INDEX));
    }

    /**
     * Returns element from 'wish_res_index' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getWishResIndexAt($offset)
    {
        return $this->get(self::WISH_RES_INDEX, $offset);
    }

    /**
     * Returns count of 'wish_res_index' list
     *
     * @return int
     */
    public function getWishResIndexCount()
    {
        return $this->count(self::WISH_RES_INDEX);
    }

    /**
     * Sets value of 'wish_total_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setWishTotalTimes($value)
    {
        return $this->set(self::WISH_TOTAL_TIMES, $value);
    }

    /**
     * Returns value of 'wish_total_times' property
     *
     * @return integer
     */
    public function getWishTotalTimes()
    {
        $value = $this->get(self::WISH_TOTAL_TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'relive_behelped_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setReliveBehelpedTimes($value)
    {
        return $this->set(self::RELIVE_BEHELPED_TIMES, $value);
    }

    /**
     * Returns value of 'relive_behelped_times' property
     *
     * @return integer
     */
    public function getReliveBehelpedTimes()
    {
        $value = $this->get(self::RELIVE_BEHELPED_TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'power' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPower($value)
    {
        return $this->set(self::POWER, $value);
    }

    /**
     * Returns value of 'power' property
     *
     * @return integer
     */
    public function getPower()
    {
        $value = $this->get(self::POWER);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'relive_help_asked' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setReliveHelpAsked($value)
    {
        return $this->set(self::RELIVE_HELP_ASKED, $value);
    }

    /**
     * Returns value of 'relive_help_asked' property
     *
     * @return boolean
     */
    public function getReliveHelpAsked()
    {
        $value = $this->get(self::RELIVE_HELP_ASKED);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'battle_que_count' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBattleQueCount($value)
    {
        return $this->set(self::BATTLE_QUE_COUNT, $value);
    }

    /**
     * Returns value of 'battle_que_count' property
     *
     * @return integer
     */
    public function getBattleQueCount()
    {
        $value = $this->get(self::BATTLE_QUE_COUNT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'quest_award_record' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setQuestAwardRecord($value)
    {
        return $this->set(self::QUEST_AWARD_RECORD, $value);
    }

    /**
     * Returns value of 'quest_award_record' property
     *
     * @return integer
     */
    public function getQuestAwardRecord()
    {
        $value = $this->get(self::QUEST_AWARD_RECORD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'favorites' list
     *
     * @param \PB_FavoritePos $value Value to append
     *
     * @return null
     */
    public function appendFavorites(\PB_FavoritePos $value)
    {
        return $this->append(self::FAVORITES, $value);
    }

    /**
     * Clears 'favorites' list
     *
     * @return null
     */
    public function clearFavorites()
    {
        return $this->clear(self::FAVORITES);
    }

    /**
     * Returns 'favorites' list
     *
     * @return \PB_FavoritePos[]
     */
    public function getFavorites()
    {
        return $this->get(self::FAVORITES);
    }

    /**
     * Returns 'favorites' iterator
     *
     * @return \ArrayIterator
     */
    public function getFavoritesIterator()
    {
        return new \ArrayIterator($this->get(self::FAVORITES));
    }

    /**
     * Returns element from 'favorites' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_FavoritePos
     */
    public function getFavoritesAt($offset)
    {
        return $this->get(self::FAVORITES, $offset);
    }

    /**
     * Returns count of 'favorites' list
     *
     * @return int
     */
    public function getFavoritesCount()
    {
        return $this->count(self::FAVORITES);
    }

    /**
     * Appends value to 'guide_datas' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendGuideDatas($value)
    {
        return $this->append(self::GUIDE_DATAS, $value);
    }

    /**
     * Clears 'guide_datas' list
     *
     * @return null
     */
    public function clearGuideDatas()
    {
        return $this->clear(self::GUIDE_DATAS);
    }

    /**
     * Returns 'guide_datas' list
     *
     * @return integer[]
     */
    public function getGuideDatas()
    {
        return $this->get(self::GUIDE_DATAS);
    }

    /**
     * Returns 'guide_datas' iterator
     *
     * @return \ArrayIterator
     */
    public function getGuideDatasIterator()
    {
        return new \ArrayIterator($this->get(self::GUIDE_DATAS));
    }

    /**
     * Returns element from 'guide_datas' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getGuideDatasAt($offset)
    {
        return $this->get(self::GUIDE_DATAS, $offset);
    }

    /**
     * Returns count of 'guide_datas' list
     *
     * @return int
     */
    public function getGuideDatasCount()
    {
        return $this->count(self::GUIDE_DATAS);
    }

    /**
     * Sets value of 'levelup_hero_skill_hero' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevelupHeroSkillHero($value)
    {
        return $this->set(self::LEVELUP_HERO_SKILL_HERO, $value);
    }

    /**
     * Returns value of 'levelup_hero_skill_hero' property
     *
     * @return integer
     */
    public function getLevelupHeroSkillHero()
    {
        $value = $this->get(self::LEVELUP_HERO_SKILL_HERO);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'levelup_hero_skill_id' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevelupHeroSkillId($value)
    {
        return $this->set(self::LEVELUP_HERO_SKILL_ID, $value);
    }

    /**
     * Returns value of 'levelup_hero_skill_id' property
     *
     * @return integer
     */
    public function getLevelupHeroSkillId()
    {
        $value = $this->get(self::LEVELUP_HERO_SKILL_ID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'levelup_hero_skill_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLevelupHeroSkillTime($value)
    {
        return $this->set(self::LEVELUP_HERO_SKILL_TIME, $value);
    }

    /**
     * Returns value of 'levelup_hero_skill_time' property
     *
     * @return integer
     */
    public function getLevelupHeroSkillTime()
    {
        $value = $this->get(self::LEVELUP_HERO_SKILL_TIME);
        return $value === null ? (integer)$value : $value;
    }
}
}