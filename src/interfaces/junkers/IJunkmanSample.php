<?php
namespace junkman\interfaces\junkers;

use extas\interfaces\IHasClass;
use extas\interfaces\samples\ISample;
use junkman\interfaces\characteristics\IHasCharacteristics;
use junkman\interfaces\contents\IHasContentsItems;
use junkman\interfaces\skills\IHasSkills;

/**
 * Interface IJunkmanSample
 * @package junkman\interfaces\junkers
 * @author jeyroik@gmail.com
 */
interface IJunkmanSample extends ISample, IHasClass, IHasSkills, IHasContentsItems, IHasCharacteristics
{

}
