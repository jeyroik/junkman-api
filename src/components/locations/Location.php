<?php
namespace junkman\components\locations;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasDescription;
use extas\components\THasName;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\locations\ILocationAdjacent;

/**
 * Class Location
 *
 * @jsonrpc_method create
 * @jsonrpc_method index
 *
 * @package junkman\components\locations
 * @author jeyroik@gmail.com
 */
class Location extends Item implements ILocation
{
    use THasName;
    use THasDescription;
    use THasSampleParameters;

    /**
     * @return ILocationAdjacent[]
     */
    public function getAdjacentLocations(): array
    {
        $locationsData = $this->config[static::FIELD__ADJACENT_LOCATIONS] ?? [];
        $locations = [];
        foreach ($locationsData as $name => $datum) {
            $locations[] = $this->getAdjacentLocation($name);
        }

        return $locations;
    }

    /**
     * @param string $name
     * @return ILocationAdjacent|null
     */
    public function getAdjacentLocation(string $name): ?ILocationAdjacent
    {
        if ($this->hasAdjacentLocation($name)) {
            return new LocationAdjacent($this->config[static::FIELD__ADJACENT_LOCATIONS][$name]);
        }

        return null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasAdjacentLocation(string $name): bool
    {
        $locations = $this->config[static::FIELD__ADJACENT_LOCATIONS] ?? [];

        return isset($locations[$name]);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
