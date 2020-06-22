<?php
namespace junkman\interfaces\extensions;

use junkman\interfaces\locations\ILocation;

/**
 * Interface IHasLocation
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IHasLocation
{
    public const PARAM__LOCATION_NAME = 'location_name';

    /**
     * @return string
     */
    public function getLocationName(): string;

    /**
     * @return ILocation|null
     */
    public function getLocation(): ?ILocation;

    /**
     * @param ILocation $location
     * @return $this
     */
    public function setLocation(ILocation $location);

    /**
     * @param ILocation $location
     * @return $this
     */
    public function moveToLocation(ILocation $location);

    /**
     * @param ILocation $location
     * @return void
     */
    public function lookAround(ILocation $location);
}
