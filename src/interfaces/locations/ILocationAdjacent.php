<?php
namespace junkman\interfaces\locations;

use extas\interfaces\IHasClass;
use extas\interfaces\IItem;

/**
 * Interface ILocationAdjacent
 *
 * @package junkman\interfaces\locations
 * @author jeyroik@gmail.com
 */
interface ILocationAdjacent extends IItem, IHasLocation, IHasClass
{
    public const SUBJECT = 'junkman.location.adjacent';
}
