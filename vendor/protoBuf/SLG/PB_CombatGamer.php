<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_CombatGamer message
 */
class PB_CombatGamer extends \ProtobufMessage
{
    /* Field index constants */
    const GID = 1;
    const SOLDIER = 2;
    const RES_TYPE = 3;
    const RES_COUNT = 4;
    const NAME = 5;
    const ICON = 6;
    const POS = 7;
    const LEAGUE_ID = 8;
    const LEAGUE_NAME = 9;
    const POWER = 10;
    const COMBAT_DAILY_DATA = 11;
    const IS_MONSTER = 12;
    const LEAGUE_SHORT = 13;
    const ORIG_HKEY = 14;
    const JOIN_TIME = 15;
    const TECH_IDS = 16;
    const RES_TYPE_EXT = 17;
    const RES_COUNT_EXT = 18;
    const HERO_SKILLS = 19;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::GID => array(
            'name' => 'gid',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SOLDIER => array(
            'name' => 'soldier',
            'repeated' => true,
            'type' => '\PB_Soldier'
        ),
        self::RES_TYPE => array(
            'name' => 'res_type',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RES_COUNT => array(
            'name' => 'res_count',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ICON => array(
            'name' => 'icon',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::POS => array(
            'name' => 'pos',
            'required' => false,
            'type' => '\PB_Vec2'
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
        self::POWER => array(
            'name' => 'power',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::COMBAT_DAILY_DATA => array(
            'name' => 'combat_daily_data',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::IS_MONSTER => array(
            'default' => false,
            'name' => 'is_monster',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::LEAGUE_SHORT => array(
            'name' => 'league_short',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ORIG_HKEY => array(
            'name' => 'orig_hkey',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::JOIN_TIME => array(
            'name' => 'join_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TECH_IDS => array(
            'name' => 'tech_ids',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RES_TYPE_EXT => array(
            'name' => 'res_type_ext',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::RES_COUNT_EXT => array(
            'name' => 'res_count_ext',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::HERO_SKILLS => array(
            'name' => 'hero_skills',
            'repeated' => true,
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
        $this->values[self::GID] = null;
        $this->values[self::SOLDIER] = array();
        $this->values[self::RES_TYPE] = array();
        $this->values[self::RES_COUNT] = array();
        $this->values[self::NAME] = null;
        $this->values[self::ICON] = null;
        $this->values[self::POS] = null;
        $this->values[self::LEAGUE_ID] = null;
        $this->values[self::LEAGUE_NAME] = null;
        $this->values[self::POWER] = null;
        $this->values[self::COMBAT_DAILY_DATA] = array();
        $this->values[self::IS_MONSTER] = self::$fields[self::IS_MONSTER]['default'];
        $this->values[self::LEAGUE_SHORT] = null;
        $this->values[self::ORIG_HKEY] = null;
        $this->values[self::JOIN_TIME] = null;
        $this->values[self::TECH_IDS] = array();
        $this->values[self::RES_TYPE_EXT] = array();
        $this->values[self::RES_COUNT_EXT] = array();
        $this->values[self::HERO_SKILLS] = array();
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
     * Sets value of 'gid' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setGid($value)
    {
        return $this->set(self::GID, $value);
    }

    /**
     * Returns value of 'gid' property
     *
     * @return integer
     */
    public function getGid()
    {
        $value = $this->get(self::GID);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'soldier' list
     *
     * @param \PB_Soldier $value Value to append
     *
     * @return null
     */
    public function appendSoldier(\PB_Soldier $value)
    {
        return $this->append(self::SOLDIER, $value);
    }

    /**
     * Clears 'soldier' list
     *
     * @return null
     */
    public function clearSoldier()
    {
        return $this->clear(self::SOLDIER);
    }

    /**
     * Returns 'soldier' list
     *
     * @return \PB_Soldier[]
     */
    public function getSoldier()
    {
        return $this->get(self::SOLDIER);
    }

    /**
     * Returns 'soldier' iterator
     *
     * @return \ArrayIterator
     */
    public function getSoldierIterator()
    {
        return new \ArrayIterator($this->get(self::SOLDIER));
    }

    /**
     * Returns element from 'soldier' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \PB_Soldier
     */
    public function getSoldierAt($offset)
    {
        return $this->get(self::SOLDIER, $offset);
    }

    /**
     * Returns count of 'soldier' list
     *
     * @return int
     */
    public function getSoldierCount()
    {
        return $this->count(self::SOLDIER);
    }

    /**
     * Appends value to 'res_type' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendResType($value)
    {
        return $this->append(self::RES_TYPE, $value);
    }

    /**
     * Clears 'res_type' list
     *
     * @return null
     */
    public function clearResType()
    {
        return $this->clear(self::RES_TYPE);
    }

    /**
     * Returns 'res_type' list
     *
     * @return integer[]
     */
    public function getResType()
    {
        return $this->get(self::RES_TYPE);
    }

    /**
     * Returns 'res_type' iterator
     *
     * @return \ArrayIterator
     */
    public function getResTypeIterator()
    {
        return new \ArrayIterator($this->get(self::RES_TYPE));
    }

    /**
     * Returns element from 'res_type' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getResTypeAt($offset)
    {
        return $this->get(self::RES_TYPE, $offset);
    }

    /**
     * Returns count of 'res_type' list
     *
     * @return int
     */
    public function getResTypeCount()
    {
        return $this->count(self::RES_TYPE);
    }

    /**
     * Appends value to 'res_count' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendResCount($value)
    {
        return $this->append(self::RES_COUNT, $value);
    }

    /**
     * Clears 'res_count' list
     *
     * @return null
     */
    public function clearResCount()
    {
        return $this->clear(self::RES_COUNT);
    }

    /**
     * Returns 'res_count' list
     *
     * @return integer[]
     */
    public function getResCount()
    {
        return $this->get(self::RES_COUNT);
    }

    /**
     * Returns 'res_count' iterator
     *
     * @return \ArrayIterator
     */
    public function getResCountIterator()
    {
        return new \ArrayIterator($this->get(self::RES_COUNT));
    }

    /**
     * Returns element from 'res_count' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getResCountAt($offset)
    {
        return $this->get(self::RES_COUNT, $offset);
    }

    /**
     * Returns count of 'res_count' list
     *
     * @return int
     */
    public function getResCountCount()
    {
        return $this->count(self::RES_COUNT);
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
     * Appends value to 'combat_daily_data' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendCombatDailyData($value)
    {
        return $this->append(self::COMBAT_DAILY_DATA, $value);
    }

    /**
     * Clears 'combat_daily_data' list
     *
     * @return null
     */
    public function clearCombatDailyData()
    {
        return $this->clear(self::COMBAT_DAILY_DATA);
    }

    /**
     * Returns 'combat_daily_data' list
     *
     * @return integer[]
     */
    public function getCombatDailyData()
    {
        return $this->get(self::COMBAT_DAILY_DATA);
    }

    /**
     * Returns 'combat_daily_data' iterator
     *
     * @return \ArrayIterator
     */
    public function getCombatDailyDataIterator()
    {
        return new \ArrayIterator($this->get(self::COMBAT_DAILY_DATA));
    }

    /**
     * Returns element from 'combat_daily_data' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getCombatDailyDataAt($offset)
    {
        return $this->get(self::COMBAT_DAILY_DATA, $offset);
    }

    /**
     * Returns count of 'combat_daily_data' list
     *
     * @return int
     */
    public function getCombatDailyDataCount()
    {
        return $this->count(self::COMBAT_DAILY_DATA);
    }

    /**
     * Sets value of 'is_monster' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsMonster($value)
    {
        return $this->set(self::IS_MONSTER, $value);
    }

    /**
     * Returns value of 'is_monster' property
     *
     * @return boolean
     */
    public function getIsMonster()
    {
        $value = $this->get(self::IS_MONSTER);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Sets value of 'league_short' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLeagueShort($value)
    {
        return $this->set(self::LEAGUE_SHORT, $value);
    }

    /**
     * Returns value of 'league_short' property
     *
     * @return string
     */
    public function getLeagueShort()
    {
        $value = $this->get(self::LEAGUE_SHORT);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'orig_hkey' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setOrigHkey($value)
    {
        return $this->set(self::ORIG_HKEY, $value);
    }

    /**
     * Returns value of 'orig_hkey' property
     *
     * @return string
     */
    public function getOrigHkey()
    {
        $value = $this->get(self::ORIG_HKEY);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Sets value of 'join_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setJoinTime($value)
    {
        return $this->set(self::JOIN_TIME, $value);
    }

    /**
     * Returns value of 'join_time' property
     *
     * @return integer
     */
    public function getJoinTime()
    {
        $value = $this->get(self::JOIN_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'tech_ids' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendTechIds($value)
    {
        return $this->append(self::TECH_IDS, $value);
    }

    /**
     * Clears 'tech_ids' list
     *
     * @return null
     */
    public function clearTechIds()
    {
        return $this->clear(self::TECH_IDS);
    }

    /**
     * Returns 'tech_ids' list
     *
     * @return integer[]
     */
    public function getTechIds()
    {
        return $this->get(self::TECH_IDS);
    }

    /**
     * Returns 'tech_ids' iterator
     *
     * @return \ArrayIterator
     */
    public function getTechIdsIterator()
    {
        return new \ArrayIterator($this->get(self::TECH_IDS));
    }

    /**
     * Returns element from 'tech_ids' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getTechIdsAt($offset)
    {
        return $this->get(self::TECH_IDS, $offset);
    }

    /**
     * Returns count of 'tech_ids' list
     *
     * @return int
     */
    public function getTechIdsCount()
    {
        return $this->count(self::TECH_IDS);
    }

    /**
     * Appends value to 'res_type_ext' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendResTypeExt($value)
    {
        return $this->append(self::RES_TYPE_EXT, $value);
    }

    /**
     * Clears 'res_type_ext' list
     *
     * @return null
     */
    public function clearResTypeExt()
    {
        return $this->clear(self::RES_TYPE_EXT);
    }

    /**
     * Returns 'res_type_ext' list
     *
     * @return integer[]
     */
    public function getResTypeExt()
    {
        return $this->get(self::RES_TYPE_EXT);
    }

    /**
     * Returns 'res_type_ext' iterator
     *
     * @return \ArrayIterator
     */
    public function getResTypeExtIterator()
    {
        return new \ArrayIterator($this->get(self::RES_TYPE_EXT));
    }

    /**
     * Returns element from 'res_type_ext' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getResTypeExtAt($offset)
    {
        return $this->get(self::RES_TYPE_EXT, $offset);
    }

    /**
     * Returns count of 'res_type_ext' list
     *
     * @return int
     */
    public function getResTypeExtCount()
    {
        return $this->count(self::RES_TYPE_EXT);
    }

    /**
     * Appends value to 'res_count_ext' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendResCountExt($value)
    {
        return $this->append(self::RES_COUNT_EXT, $value);
    }

    /**
     * Clears 'res_count_ext' list
     *
     * @return null
     */
    public function clearResCountExt()
    {
        return $this->clear(self::RES_COUNT_EXT);
    }

    /**
     * Returns 'res_count_ext' list
     *
     * @return integer[]
     */
    public function getResCountExt()
    {
        return $this->get(self::RES_COUNT_EXT);
    }

    /**
     * Returns 'res_count_ext' iterator
     *
     * @return \ArrayIterator
     */
    public function getResCountExtIterator()
    {
        return new \ArrayIterator($this->get(self::RES_COUNT_EXT));
    }

    /**
     * Returns element from 'res_count_ext' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getResCountExtAt($offset)
    {
        return $this->get(self::RES_COUNT_EXT, $offset);
    }

    /**
     * Returns count of 'res_count_ext' list
     *
     * @return int
     */
    public function getResCountExtCount()
    {
        return $this->count(self::RES_COUNT_EXT);
    }

    /**
     * Appends value to 'hero_skills' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendHeroSkills($value)
    {
        return $this->append(self::HERO_SKILLS, $value);
    }

    /**
     * Clears 'hero_skills' list
     *
     * @return null
     */
    public function clearHeroSkills()
    {
        return $this->clear(self::HERO_SKILLS);
    }

    /**
     * Returns 'hero_skills' list
     *
     * @return integer[]
     */
    public function getHeroSkills()
    {
        return $this->get(self::HERO_SKILLS);
    }

    /**
     * Returns 'hero_skills' iterator
     *
     * @return \ArrayIterator
     */
    public function getHeroSkillsIterator()
    {
        return new \ArrayIterator($this->get(self::HERO_SKILLS));
    }

    /**
     * Returns element from 'hero_skills' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getHeroSkillsAt($offset)
    {
        return $this->get(self::HERO_SKILLS, $offset);
    }

    /**
     * Returns count of 'hero_skills' list
     *
     * @return int
     */
    public function getHeroSkillsCount()
    {
        return $this->count(self::HERO_SKILLS);
    }
}
}