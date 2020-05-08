<?php
namespace junkman\interfaces\skills;

use extas\interfaces\IHasClass;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface ISkill
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface ISkill extends IItem, IHasName, IHasDescription, IHasClass, IHasSampleParameters
{
    public const SUBJECT = 'junkman.skill';
}
