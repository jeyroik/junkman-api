<?php
namespace junkman\interfaces\locations;

/**
 * Interface IHasLocation
 *
 * @package junkman\interfaces\locations
 * @author jeyroik@gmail.com
 */
interface IHasLocation
{
    public const FIELD__LOCATION_NAME = 'location_name';

    /**
     * @return ILocation|null
     */
    public function getLocation(): ?ILocation;

    /**
     * @param ILocation $location
     * @return $this
     */
    public function setLocation(ILocation $location);
}
