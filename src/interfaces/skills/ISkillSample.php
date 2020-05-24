<?php
namespace junkman\interfaces\skills;

use extas\interfaces\IHasClass;
use extas\interfaces\samples\ISample;
use junkman\interfaces\IHasDefinition;
use junkman\interfaces\IHasFrequency;
use junkman\interfaces\using\ICanBeUsed;

/**
 * Interface ISkillSample
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface ISkillSample extends ISample, IHasFrequency, IHasDefinition, IHasClass, ICanBeUsed
{

}
