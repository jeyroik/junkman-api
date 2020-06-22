<?php
namespace junkman\components\locations;

use extas\components\Item;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\extensions\IHasLocation;
use junkman\interfaces\locations\ILocation;

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
     * @param IHasSampleParameters|IHasLocation $subject
     * @param ILocation $currentLocation
     * @param ILocation $adjacent
     */
    public function __invoke(IHasSampleParameters &$subject, ILocation $currentLocation, ILocation $adjacent): void
    {
        $subject->setLocation($adjacent);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.location.adjacent.door.open';
    }
}
