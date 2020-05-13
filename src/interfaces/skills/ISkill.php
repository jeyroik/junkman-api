<?php
namespace junkman\interfaces\skills;

use extas\interfaces\IHasClass;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\IHasDefinition;
use junkman\interfaces\IHasFrequency;

/**
 * Interface ISkill
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface ISkill extends
    IItem,
    IHasName,
    IHasDescription,
    IHasClass,
    IHasSampleParameters,
    IHasFrequency,
    IHasDefinition
{
    public const SUBJECT = 'junkman.skill';

    public const FIELD__CAN_DAMAGE_ANOTHER = 'can_damage_another';

    /**
     * @return bool
     */
    public function canDamageAnother(): bool;
}
