<?php
namespace junkman\components\locations;

use junkman\interfaces\locations\IHasLocation;
use junkman\interfaces\locations\ILocation;

/**
 * Trait THasLocation
 *
 * @property array $config
 * @method locationRepository()
 *
 * @package junkman\components\locations
 * @author jeyroik@gmail.com
 */
trait THasLocation
{
    /**
     * @return ILocation|null
     */
    public function getLocation(): ?ILocation
    {
        $locationName = $this->config[IHasLocation::FIELD__LOCATION_NAME] ?? '';

        return $this->locationRepository()->one([ILocation::FIELD__NAME => $locationName]);
    }

    /**
     * @param ILocation $location
     * @return $this
     */
    public function setLocation(ILocation $location)
    {
        $this->config[IHasLocation::FIELD__LOCATION_NAME] = $location->getName();

        return $this;
    }
}
