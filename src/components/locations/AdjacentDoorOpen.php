<?php
namespace junkman\components\locations;

use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\locations\ILocationAdjacent;

/**
 * Class AdjacentDoorOpen
 *
 * @method junkmanRepository()
 *
 * @package junkman\components\locations
 * @author jeyroik@gmail.com
 */
class AdjacentDoorOpen
{
    public function __invoke(IJunkman &$junkman, ILocationAdjacent $adjacent, ILocation $currentLocation): void
    {
        $junkman->setLocation($adjacent->getLocation());
        $this->junkmanRepository()->update($junkman);
    }
}
