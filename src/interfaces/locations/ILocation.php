<?php
namespace junkman\interfaces\locations;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\IJunkman;

/**
 * Interface ILocation
 *
 * @package junkman\interfaces\locations
 * @author jeyroik@gmail.com
 */
interface ILocation extends IJunkman
{
    public const FIELD__ADJACENT_LOCATIONS = 'adjacent_locations';

    public const PARAM__FREQUENCY_MIN = 'f_min';
    public const PARAM__FREQUENCY_MAX = 'f_max';

    /**
     * @return ILocationAdjacent[]
     */
    public function getAdjacentLocations(): array;

    /**
     * @param string $name
     * @return ILocationAdjacent|null
     */
    public function getAdjacentLocation(string $name): ?ILocationAdjacent;

    /**
     * @param string $name
     * @return bool
     */
    public function hasAdjacentLocation(string $name): bool;
}
