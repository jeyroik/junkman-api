<?php
namespace junkman\interfaces\locations;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface ILocation
 *
 * @package junkman\interfaces\locations
 * @author jeyroik@gmail.com
 */
interface ILocation extends IItem, IHasName, IHasDescription, IHasSampleParameters
{
    public const SUBJECT = 'junkman.location';

    public const FIELD__ADJACENT_LOCATIONS = 'adjacent_locations';

    public const PARAM__FREQUENCY_MIN = 'f_min';
    public const PARAM__FREQUENCY_MAX = 'f_max';

    /**
     * @return ILocation[]
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
