<?php
namespace junkman\interfaces\stages;

use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\locations\ILocationAdjacent;

/**
 * Interface IStageJunkmanUseLocationAdjacent
 *
 * @package junkman\interfaces\stages
 * @author jeyroik@gmail.com
 */
interface IStageJunkmanUseLocationAdjacent extends IStageJunkmanUse
{
    public const NAME__SUFFIX = 'location.adjacent';

    /**
     * @param IJunkman $junkman
     * @param ILocationAdjacent $adjacent
     * @param ILocation $currentLocation
     */
    public function __invoke(IJunkman $junkman, ILocationAdjacent $adjacent, ILocation $currentLocation): void;
}
