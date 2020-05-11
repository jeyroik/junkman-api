<?php
namespace junkman\components\locations;

use extas\components\Item;
use extas\components\THasClass;
use junkman\interfaces\locations\ILocationAdjacent;

/**
 * Class LocationAdjacent
 *
 * @package junkman\components\locations
 * @author jeyroik@gmail.com
 */
class LocationAdjacent extends Item implements ILocationAdjacent
{
    use THasClass;
    use THasLocation;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
