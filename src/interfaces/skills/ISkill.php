<?php
namespace junkman\interfaces\skills;

use extas\interfaces\samples\IHasSample;
use junkman\interfaces\using\ICanUse;

/**
 * Interface ISkill
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface ISkill extends ISkillSample, IHasSample, ICanUse
{
    public const FIELD__CAN_DAMAGE_ANOTHER = 'can_damage_another';

    /**
     * @return bool
     */
    public function canDamageAnother(): bool;
}
