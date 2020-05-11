<?php
namespace junkman\components\locations;

use extas\components\Item;
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
class AdjacentDoorOpen extends Item
{
    /**
     * @param IJunkman $junkman
     * @param ILocationAdjacent $adjacent
     * @param ILocation $currentLocation
     */
    public function __invoke(IJunkman &$junkman, ILocationAdjacent $adjacent, ILocation $currentLocation): void
    {
        $junkman->setLocation($adjacent->getLocation());
        $this->junkmanRepository()->update($junkman);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.location.adjacent.door.open';
    }
}
