<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use junkman\interfaces\extensions\IExtensionMoveToLocation;
use junkman\interfaces\IJunkman;
use junkman\interfaces\stages\IStageJunkmanUseLocationAdjacent;

/**
 * Class ExtensionMoveToLocation
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionMoveToLocation extends Extension implements IExtensionMoveToLocation
{
    /**
     * @param string $locationName
     * @param IJunkman|null $junkman
     * @return IJunkman
     * @throws \Exception
     */
    public function moveToLocation(string $locationName, IJunkman &$junkman = null): IJunkman
    {
        $curLoc = $junkman->getLocation();
        if (!$curLoc) {
            throw new \Exception('You are nowhere...Can not move somewhere...');
        }

        if ($curLoc->hasAdjacentLocation($locationName)) {
            $adjacent = $curLoc->getAdjacentLocation($locationName);
            $junkman->use($adjacent, IStageJunkmanUseLocationAdjacent::NAME__SUFFIX, $curLoc);
        }

        return $junkman;
    }
}
