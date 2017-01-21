<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * ArmyState enum
 */
final class ArmyState
{
    const ArmyStateForward = 1;
    const ArmyStateBack = 2;
    const ArmyStateGetRes = 3;
    const ArmyStateBattle = 4;
    const ArmyStateGone = 5;
    const ArmyStateWait = 6;
    const ArmyStateWaitBattle = 7;
    const ArmyStateWaitAssemb = 8;
    const ArmyStateVanish = 9;
    const ArmyStateIdle = 10;
    const ArmyStateIdle_Assemble = 11;
    const ArmyStateIdle_Support = 12;
    const ArmyStateIdle_Merge = 13;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'ArmyStateForward' => self::ArmyStateForward,
            'ArmyStateBack' => self::ArmyStateBack,
            'ArmyStateGetRes' => self::ArmyStateGetRes,
            'ArmyStateBattle' => self::ArmyStateBattle,
            'ArmyStateGone' => self::ArmyStateGone,
            'ArmyStateWait' => self::ArmyStateWait,
            'ArmyStateWaitBattle' => self::ArmyStateWaitBattle,
            'ArmyStateWaitAssemb' => self::ArmyStateWaitAssemb,
            'ArmyStateVanish' => self::ArmyStateVanish,
            'ArmyStateIdle' => self::ArmyStateIdle,
            'ArmyStateIdle_Assemble' => self::ArmyStateIdle_Assemble,
            'ArmyStateIdle_Support' => self::ArmyStateIdle_Support,
            'ArmyStateIdle_Merge' => self::ArmyStateIdle_Merge,
        );
    }
}
}