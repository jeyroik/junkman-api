<?php
namespace junkman\interfaces\locations;

/**
 * Interface ILocation
 *
 * @package junkman\interfaces\locations
 * @author jeyroik@gmail.com
 */
interface ILocation extends ILocationSample
{
    public const FIELD__ADJACENT_LOCATIONS = 'adjacent_locations';

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
