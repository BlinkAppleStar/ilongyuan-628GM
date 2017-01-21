<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * PB_TimeRecord message
 */
class PB_TimeRecord extends \ProtobufMessage
{
    /* Field index constants */
    const PREV_PERDAY = 1;
    const BUILD_QUE = 2;
    const PREV_ENERGY_GET = 3;
    const SOLDIER_PAY_TIME = 4;
    const SECRET_SHOP_CHANGE_TIME = 5;
    const SECRET_SHOP_SPECIAL_ITEM_TIMES = 6;
    const SECRET_SHOP_SPECIAL_ITEM = 7;
    const SECRET_SHOP_ITEMS = 8;
    const SECRET_SHOP_REFRESH_TIMES = 9;
    const LOGIN_AWARD_LAST_TIME = 10;
    const LOGIN_AWARD_COMBO = 11;
    const STAMINA_TIME = 12;
    const DAILY_DATA = 13;
    const LAST_DAILY_REFRESH_TIME = 14;
    const DAILY_SCORE = 15;
    const DAILY_AWARD_TAKEN = 16;
    const LEAGUE_MONSTER_TIMES = 17;
    const LEAGUE_MONSTER_TIMES_TIME = 18;
    const TAKE_TRIBUTE_TIME = 19;
    const TAKE_TRIBUTE_INDEX = 20;
    const TAKE_TRIBUTE_ITEM = 21;
    const BUY_STAMINA = 23;
    const REFRESH_STAMINA_TIME = 24;
    const FREE_RANDOM_HERO_TIME = 25;
    const FREE_RANDOM_HERO = 26;
    const BUY_TECH_POINT = 27;
    const BUY_TECH_POINT_TIME = 28;
    const FREE_CALLBACK_ARMY_TIME = 29;
    const SMALL_GAME = 30;
    const SMALL_GAME_TIME = 31;
    const MONTH_CARD_TIME = 32;
    const MONTH_CARD_GET_TIME = 33;
    const BUY_VIP_GIFT = 34;
    const VIP_EVERYDAY_GIFT_GET_TIME = 35;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::PREV_PERDAY => array(
            'name' => 'prev_perday',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BUILD_QUE => array(
            'name' => 'build_que',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PREV_ENERGY_GET => array(
            'name' => 'prev_energy_get',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SOLDIER_PAY_TIME => array(
            'name' => 'soldier_pay_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SECRET_SHOP_CHANGE_TIME => array(
            'name' => 'secret_shop_change_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SECRET_SHOP_SPECIAL_ITEM_TIMES => array(
            'name' => 'secret_shop_special_item_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SECRET_SHOP_SPECIAL_ITEM => array(
            'name' => 'secret_shop_special_item',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SECRET_SHOP_ITEMS => array(
            'name' => 'secret_shop_items',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SECRET_SHOP_REFRESH_TIMES => array(
            'name' => 'secret_shop_refresh_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LOGIN_AWARD_LAST_TIME => array(
            'name' => 'login_award_last_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LOGIN_AWARD_COMBO => array(
            'name' => 'login_award_combo',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::STAMINA_TIME => array(
            'name' => 'stamina_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAILY_DATA => array(
            'name' => 'daily_data',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LAST_DAILY_REFRESH_TIME => array(
            'name' => 'last_daily_refresh_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAILY_SCORE => array(
            'name' => 'daily_score',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DAILY_AWARD_TAKEN => array(
            'name' => 'daily_award_taken',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEAGUE_MONSTER_TIMES => array(
            'name' => 'league_monster_times',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LEAGUE_MONSTER_TIMES_TIME => array(
            'name' => 'league_monster_times_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TAKE_TRIBUTE_TIME => array(
            'name' => 'take_tribute_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TAKE_TRIBUTE_INDEX => array(
            'name' => 'take_tribute_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TAKE_TRIBUTE_ITEM => array(
            'name' => 'take_tribute_item',
            'required' => false,
            'type' => '\PB_Item'
        ),
        self::BUY_STAMINA => array(
            'name' => 'buy_stamina',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::REFRESH_STAMINA_TIME => array(
            'name' => 'refresh_stamina_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FREE_RANDOM_HERO_TIME => array(
            'name' => 'free_random_hero_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FREE_RANDOM_HERO => array(
            'name' => 'free_random_hero',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BUY_TECH_POINT => array(
            'name' => 'buy_tech_point',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BUY_TECH_POINT_TIME => array(
            'name' => 'buy_tech_point_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::FREE_CALLBACK_ARMY_TIME => array(
            'name' => 'free_callback_army_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SMALL_GAME => array(
            'name' => 'small_game',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SMALL_GAME_TIME => array(
            'name' => 'small_game_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MONTH_CARD_TIME => array(
            'name' => 'month_card_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MONTH_CARD_GET_TIME => array(
            'name' => 'month_card_get_time',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::BUY_VIP_GIFT => array(
            'name' => 'buy_vip_gift',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::VIP_EVERYDAY_GIFT_GET_TIME => array(
            'name' => 'vip_everyday_gift_get_time',
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
        $this->values[self::PREV_PERDAY] = null;
        $this->values[self::BUILD_QUE] = array();
        $this->values[self::PREV_ENERGY_GET] = null;
        $this->values[self::SOLDIER_PAY_TIME] = null;
        $this->values[self::SECRET_SHOP_CHANGE_TIME] = null;
        $this->values[self::SECRET_SHOP_SPECIAL_ITEM_TIMES] = null;
        $this->values[self::SECRET_SHOP_SPECIAL_ITEM] = null;
        $this->values[self::SECRET_SHOP_ITEMS] = array();
        $this->values[self::SECRET_SHOP_REFRESH_TIMES] = null;
        $this->values[self::LOGIN_AWARD_LAST_TIME] = null;
        $this->values[self::LOGIN_AWARD_COMBO] = null;
        $this->values[self::STAMINA_TIME] = null;
        $this->values[self::DAILY_DATA] = array();
        $this->values[self::LAST_DAILY_REFRESH_TIME] = null;
        $this->values[self::DAILY_SCORE] = null;
        $this->values[self::DAILY_AWARD_TAKEN] = null;
        $this->values[self::LEAGUE_MONSTER_TIMES] = null;
        $this->values[self::LEAGUE_MONSTER_TIMES_TIME] = null;
        $this->values[self::TAKE_TRIBUTE_TIME] = null;
        $this->values[self::TAKE_TRIBUTE_INDEX] = null;
        $this->values[self::TAKE_TRIBUTE_ITEM] = null;
        $this->values[self::BUY_STAMINA] = null;
        $this->values[self::REFRESH_STAMINA_TIME] = null;
        $this->values[self::FREE_RANDOM_HERO_TIME] = null;
        $this->values[self::FREE_RANDOM_HERO] = null;
        $this->values[self::BUY_TECH_POINT] = null;
        $this->values[self::BUY_TECH_POINT_TIME] = null;
        $this->values[self::FREE_CALLBACK_ARMY_TIME] = null;
        $this->values[self::SMALL_GAME] = null;
        $this->values[self::SMALL_GAME_TIME] = null;
        $this->values[self::MONTH_CARD_TIME] = null;
        $this->values[self::MONTH_CARD_GET_TIME] = null;
        $this->values[self::BUY_VIP_GIFT] = array();
        $this->values[self::VIP_EVERYDAY_GIFT_GET_TIME] = null;
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
     * Sets value of 'prev_perday' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPrevPerday($value)
    {
        return $this->set(self::PREV_PERDAY, $value);
    }

    /**
     * Returns value of 'prev_perday' property
     *
     * @return integer
     */
    public function getPrevPerday()
    {
        $value = $this->get(self::PREV_PERDAY);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'build_que' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendBuildQue($value)
    {
        return $this->append(self::BUILD_QUE, $value);
    }

    /**
     * Clears 'build_que' list
     *
     * @return null
     */
    public function clearBuildQue()
    {
        return $this->clear(self::BUILD_QUE);
    }

    /**
     * Returns 'build_que' list
     *
     * @return integer[]
     */
    public function getBuildQue()
    {
        return $this->get(self::BUILD_QUE);
    }

    /**
     * Returns 'build_que' iterator
     *
     * @return \ArrayIterator
     */
    public function getBuildQueIterator()
    {
        return new \ArrayIterator($this->get(self::BUILD_QUE));
    }

    /**
     * Returns element from 'build_que' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getBuildQueAt($offset)
    {
        return $this->get(self::BUILD_QUE, $offset);
    }

    /**
     * Returns count of 'build_que' list
     *
     * @return int
     */
    public function getBuildQueCount()
    {
        return $this->count(self::BUILD_QUE);
    }

    /**
     * Sets value of 'prev_energy_get' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPrevEnergyGet($value)
    {
        return $this->set(self::PREV_ENERGY_GET, $value);
    }

    /**
     * Returns value of 'prev_energy_get' property
     *
     * @return integer
     */
    public function getPrevEnergyGet()
    {
        $value = $this->get(self::PREV_ENERGY_GET);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'soldier_pay_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSoldierPayTime($value)
    {
        return $this->set(self::SOLDIER_PAY_TIME, $value);
    }

    /**
     * Returns value of 'soldier_pay_time' property
     *
     * @return integer
     */
    public function getSoldierPayTime()
    {
        $value = $this->get(self::SOLDIER_PAY_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'secret_shop_change_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSecretShopChangeTime($value)
    {
        return $this->set(self::SECRET_SHOP_CHANGE_TIME, $value);
    }

    /**
     * Returns value of 'secret_shop_change_time' property
     *
     * @return integer
     */
    public function getSecretShopChangeTime()
    {
        $value = $this->get(self::SECRET_SHOP_CHANGE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'secret_shop_special_item_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSecretShopSpecialItemTimes($value)
    {
        return $this->set(self::SECRET_SHOP_SPECIAL_ITEM_TIMES, $value);
    }

    /**
     * Returns value of 'secret_shop_special_item_times' property
     *
     * @return integer
     */
    public function getSecretShopSpecialItemTimes()
    {
        $value = $this->get(self::SECRET_SHOP_SPECIAL_ITEM_TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'secret_shop_special_item' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSecretShopSpecialItem($value)
    {
        return $this->set(self::SECRET_SHOP_SPECIAL_ITEM, $value);
    }

    /**
     * Returns value of 'secret_shop_special_item' property
     *
     * @return integer
     */
    public function getSecretShopSpecialItem()
    {
        $value = $this->get(self::SECRET_SHOP_SPECIAL_ITEM);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'secret_shop_items' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendSecretShopItems($value)
    {
        return $this->append(self::SECRET_SHOP_ITEMS, $value);
    }

    /**
     * Clears 'secret_shop_items' list
     *
     * @return null
     */
    public function clearSecretShopItems()
    {
        return $this->clear(self::SECRET_SHOP_ITEMS);
    }

    /**
     * Returns 'secret_shop_items' list
     *
     * @return integer[]
     */
    public function getSecretShopItems()
    {
        return $this->get(self::SECRET_SHOP_ITEMS);
    }

    /**
     * Returns 'secret_shop_items' iterator
     *
     * @return \ArrayIterator
     */
    public function getSecretShopItemsIterator()
    {
        return new \ArrayIterator($this->get(self::SECRET_SHOP_ITEMS));
    }

    /**
     * Returns element from 'secret_shop_items' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getSecretShopItemsAt($offset)
    {
        return $this->get(self::SECRET_SHOP_ITEMS, $offset);
    }

    /**
     * Returns count of 'secret_shop_items' list
     *
     * @return int
     */
    public function getSecretShopItemsCount()
    {
        return $this->count(self::SECRET_SHOP_ITEMS);
    }

    /**
     * Sets value of 'secret_shop_refresh_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSecretShopRefreshTimes($value)
    {
        return $this->set(self::SECRET_SHOP_REFRESH_TIMES, $value);
    }

    /**
     * Returns value of 'secret_shop_refresh_times' property
     *
     * @return integer
     */
    public function getSecretShopRefreshTimes()
    {
        $value = $this->get(self::SECRET_SHOP_REFRESH_TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'login_award_last_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLoginAwardLastTime($value)
    {
        return $this->set(self::LOGIN_AWARD_LAST_TIME, $value);
    }

    /**
     * Returns value of 'login_award_last_time' property
     *
     * @return integer
     */
    public function getLoginAwardLastTime()
    {
        $value = $this->get(self::LOGIN_AWARD_LAST_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'login_award_combo' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLoginAwardCombo($value)
    {
        return $this->set(self::LOGIN_AWARD_COMBO, $value);
    }

    /**
     * Returns value of 'login_award_combo' property
     *
     * @return integer
     */
    public function getLoginAwardCombo()
    {
        $value = $this->get(self::LOGIN_AWARD_COMBO);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'stamina_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStaminaTime($value)
    {
        return $this->set(self::STAMINA_TIME, $value);
    }

    /**
     * Returns value of 'stamina_time' property
     *
     * @return integer
     */
    public function getStaminaTime()
    {
        $value = $this->get(self::STAMINA_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'daily_data' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendDailyData($value)
    {
        return $this->append(self::DAILY_DATA, $value);
    }

    /**
     * Clears 'daily_data' list
     *
     * @return null
     */
    public function clearDailyData()
    {
        return $this->clear(self::DAILY_DATA);
    }

    /**
     * Returns 'daily_data' list
     *
     * @return integer[]
     */
    public function getDailyData()
    {
        return $this->get(self::DAILY_DATA);
    }

    /**
     * Returns 'daily_data' iterator
     *
     * @return \ArrayIterator
     */
    public function getDailyDataIterator()
    {
        return new \ArrayIterator($this->get(self::DAILY_DATA));
    }

    /**
     * Returns element from 'daily_data' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getDailyDataAt($offset)
    {
        return $this->get(self::DAILY_DATA, $offset);
    }

    /**
     * Returns count of 'daily_data' list
     *
     * @return int
     */
    public function getDailyDataCount()
    {
        return $this->count(self::DAILY_DATA);
    }

    /**
     * Sets value of 'last_daily_refresh_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLastDailyRefreshTime($value)
    {
        return $this->set(self::LAST_DAILY_REFRESH_TIME, $value);
    }

    /**
     * Returns value of 'last_daily_refresh_time' property
     *
     * @return integer
     */
    public function getLastDailyRefreshTime()
    {
        $value = $this->get(self::LAST_DAILY_REFRESH_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'daily_score' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDailyScore($value)
    {
        return $this->set(self::DAILY_SCORE, $value);
    }

    /**
     * Returns value of 'daily_score' property
     *
     * @return integer
     */
    public function getDailyScore()
    {
        $value = $this->get(self::DAILY_SCORE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'daily_award_taken' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setDailyAwardTaken($value)
    {
        return $this->set(self::DAILY_AWARD_TAKEN, $value);
    }

    /**
     * Returns value of 'daily_award_taken' property
     *
     * @return integer
     */
    public function getDailyAwardTaken()
    {
        $value = $this->get(self::DAILY_AWARD_TAKEN);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'league_monster_times' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLeagueMonsterTimes($value)
    {
        return $this->set(self::LEAGUE_MONSTER_TIMES, $value);
    }

    /**
     * Returns value of 'league_monster_times' property
     *
     * @return integer
     */
    public function getLeagueMonsterTimes()
    {
        $value = $this->get(self::LEAGUE_MONSTER_TIMES);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'league_monster_times_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLeagueMonsterTimesTime($value)
    {
        return $this->set(self::LEAGUE_MONSTER_TIMES_TIME, $value);
    }

    /**
     * Returns value of 'league_monster_times_time' property
     *
     * @return integer
     */
    public function getLeagueMonsterTimesTime()
    {
        $value = $this->get(self::LEAGUE_MONSTER_TIMES_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'take_tribute_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTakeTributeTime($value)
    {
        return $this->set(self::TAKE_TRIBUTE_TIME, $value);
    }

    /**
     * Returns value of 'take_tribute_time' property
     *
     * @return integer
     */
    public function getTakeTributeTime()
    {
        $value = $this->get(self::TAKE_TRIBUTE_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'take_tribute_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setTakeTributeIndex($value)
    {
        return $this->set(self::TAKE_TRIBUTE_INDEX, $value);
    }

    /**
     * Returns value of 'take_tribute_index' property
     *
     * @return integer
     */
    public function getTakeTributeIndex()
    {
        $value = $this->get(self::TAKE_TRIBUTE_INDEX);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'take_tribute_item' property
     *
     * @param \PB_Item $value Property value
     *
     * @return null
     */
    public function setTakeTributeItem(\PB_Item $value=null)
    {
        return $this->set(self::TAKE_TRIBUTE_ITEM, $value);
    }

    /**
     * Returns value of 'take_tribute_item' property
     *
     * @return \PB_Item
     */
    public function getTakeTributeItem()
    {
        return $this->get(self::TAKE_TRIBUTE_ITEM);
    }

    /**
     * Sets value of 'buy_stamina' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBuyStamina($value)
    {
        return $this->set(self::BUY_STAMINA, $value);
    }

    /**
     * Returns value of 'buy_stamina' property
     *
     * @return integer
     */
    public function getBuyStamina()
    {
        $value = $this->get(self::BUY_STAMINA);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'refresh_stamina_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setRefreshStaminaTime($value)
    {
        return $this->set(self::REFRESH_STAMINA_TIME, $value);
    }

    /**
     * Returns value of 'refresh_stamina_time' property
     *
     * @return integer
     */
    public function getRefreshStaminaTime()
    {
        $value = $this->get(self::REFRESH_STAMINA_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'free_random_hero_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFreeRandomHeroTime($value)
    {
        return $this->set(self::FREE_RANDOM_HERO_TIME, $value);
    }

    /**
     * Returns value of 'free_random_hero_time' property
     *
     * @return integer
     */
    public function getFreeRandomHeroTime()
    {
        $value = $this->get(self::FREE_RANDOM_HERO_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'free_random_hero' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFreeRandomHero($value)
    {
        return $this->set(self::FREE_RANDOM_HERO, $value);
    }

    /**
     * Returns value of 'free_random_hero' property
     *
     * @return integer
     */
    public function getFreeRandomHero()
    {
        $value = $this->get(self::FREE_RANDOM_HERO);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'buy_tech_point' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBuyTechPoint($value)
    {
        return $this->set(self::BUY_TECH_POINT, $value);
    }

    /**
     * Returns value of 'buy_tech_point' property
     *
     * @return integer
     */
    public function getBuyTechPoint()
    {
        $value = $this->get(self::BUY_TECH_POINT);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'buy_tech_point_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBuyTechPointTime($value)
    {
        return $this->set(self::BUY_TECH_POINT_TIME, $value);
    }

    /**
     * Returns value of 'buy_tech_point_time' property
     *
     * @return integer
     */
    public function getBuyTechPointTime()
    {
        $value = $this->get(self::BUY_TECH_POINT_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'free_callback_army_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFreeCallbackArmyTime($value)
    {
        return $this->set(self::FREE_CALLBACK_ARMY_TIME, $value);
    }

    /**
     * Returns value of 'free_callback_army_time' property
     *
     * @return integer
     */
    public function getFreeCallbackArmyTime()
    {
        $value = $this->get(self::FREE_CALLBACK_ARMY_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'small_game' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSmallGame($value)
    {
        return $this->set(self::SMALL_GAME, $value);
    }

    /**
     * Returns value of 'small_game' property
     *
     * @return integer
     */
    public function getSmallGame()
    {
        $value = $this->get(self::SMALL_GAME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'small_game_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSmallGameTime($value)
    {
        return $this->set(self::SMALL_GAME_TIME, $value);
    }

    /**
     * Returns value of 'small_game_time' property
     *
     * @return integer
     */
    public function getSmallGameTime()
    {
        $value = $this->get(self::SMALL_GAME_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'month_card_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMonthCardTime($value)
    {
        return $this->set(self::MONTH_CARD_TIME, $value);
    }

    /**
     * Returns value of 'month_card_time' property
     *
     * @return integer
     */
    public function getMonthCardTime()
    {
        $value = $this->get(self::MONTH_CARD_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'month_card_get_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMonthCardGetTime($value)
    {
        return $this->set(self::MONTH_CARD_GET_TIME, $value);
    }

    /**
     * Returns value of 'month_card_get_time' property
     *
     * @return integer
     */
    public function getMonthCardGetTime()
    {
        $value = $this->get(self::MONTH_CARD_GET_TIME);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Appends value to 'buy_vip_gift' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendBuyVipGift($value)
    {
        return $this->append(self::BUY_VIP_GIFT, $value);
    }

    /**
     * Clears 'buy_vip_gift' list
     *
     * @return null
     */
    public function clearBuyVipGift()
    {
        return $this->clear(self::BUY_VIP_GIFT);
    }

    /**
     * Returns 'buy_vip_gift' list
     *
     * @return integer[]
     */
    public function getBuyVipGift()
    {
        return $this->get(self::BUY_VIP_GIFT);
    }

    /**
     * Returns 'buy_vip_gift' iterator
     *
     * @return \ArrayIterator
     */
    public function getBuyVipGiftIterator()
    {
        return new \ArrayIterator($this->get(self::BUY_VIP_GIFT));
    }

    /**
     * Returns element from 'buy_vip_gift' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getBuyVipGiftAt($offset)
    {
        return $this->get(self::BUY_VIP_GIFT, $offset);
    }

    /**
     * Returns count of 'buy_vip_gift' list
     *
     * @return int
     */
    public function getBuyVipGiftCount()
    {
        return $this->count(self::BUY_VIP_GIFT);
    }

    /**
     * Sets value of 'vip_everyday_gift_get_time' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setVipEverydayGiftGetTime($value)
    {
        return $this->set(self::VIP_EVERYDAY_GIFT_GET_TIME, $value);
    }

    /**
     * Returns value of 'vip_everyday_gift_get_time' property
     *
     * @return integer
     */
    public function getVipEverydayGiftGetTime()
    {
        $value = $this->get(self::VIP_EVERYDAY_GIFT_GET_TIME);
        return $value === null ? (integer)$value : $value;
    }
}
}