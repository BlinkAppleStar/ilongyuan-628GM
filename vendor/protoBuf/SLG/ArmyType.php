<?php
/**
 * Auto generated from Common.proto at 2016-12-05 10:43:26
 */

namespace {
/**
 * ArmyType enum
 */
final class ArmyType
{
    const ArmyType_Gamer = 11;
    const ArmyType_Monster = 12;
    const ArmyType_Res = 13;
    const ArmyType_LookGamer = 14;
    const ArmyType_LookMonster = 15;
    const ArmyType_LookRes = 16;
    const ArmyType_JoinAssemb = 17;
    const ArmyType_Support = 18;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'ArmyType_Gamer' => self::ArmyType_Gamer,
            'ArmyType_Monster' => self::ArmyType_Monster,
            'ArmyType_Res' => self::ArmyType_Res,
            'ArmyType_LookGamer' => self::ArmyType_LookGamer,
            'ArmyType_LookMonster' => self::ArmyType_LookMonster,
            'ArmyType_LookRes' => self::ArmyType_LookRes,
            'ArmyType_JoinAssemb' => self::ArmyType_JoinAssemb,
            'ArmyType_Support' => self::ArmyType_Support,
        );
    }
}
}