<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\components\THasStories;
use junkman\interfaces\extensions\IHasLocation;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\using\ICanUse;

/**
 * Class HasLocation
 *
 * @method IRepository locationRepository()
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class HasLocation extends Extension implements IHasLocation
{
    use THasStories;

    protected array $stories = [
        'around' => [
            'Вы осмотрелись: @location.description',
            'Почему-то именно в этот момент вы осознали что* вокруг вас: @location.description'
        ]
    ];

    /**
     * @param IHasSampleParameters|null $owner
     * @return string
     */
    public function getLocationName(IHasSampleParameters $owner = null): string
    {
        return $owner->getParameterValue(static::PARAM__LOCATION_NAME, '');
    }

    /**
     * @param IHasSampleParameters|null $owner
     * @return ILocation|null
     */
    public function getLocation(IHasSampleParameters $owner = null): ?ILocation
    {
        return $this->locationRepository()->one([ILocation::FIELD__NAME => $this->getLocationName($owner)]);
    }

    /**
     * @param ILocation $location
     * @param IHasSampleParameters|null $owner
     * @return IHasSampleParameters|HasLocation
     */
    public function setLocation(ILocation $location, IHasSampleParameters &$owner = null)
    {
        if ($owner->hasParameter(static::PARAM__LOCATION_NAME)) {
            $owner->setParameterValue(static::PARAM__LOCATION_NAME, $location->getName());
        } else {
            $owner->addParameterByValue(static::PARAM__LOCATION_NAME, $location->getName());
        }

        return $owner;
    }

    /**
     * @param ILocation $location
     * @param IHasSampleParameters|null|ICanUse $owner
     * @return IHasSampleParameters|HasLocation|null
     * @throws \Exception
     */
    public function moveToLocation(ILocation $location, IHasSampleParameters &$owner = null)
    {
        $curLoc = $this->getLocation($owner);

        if (!$curLoc) {
            throw new \Exception('You are nowhere...Can not move somewhere...');
        }

        if ($curLoc->hasAdjacentLocation($location->getName())) {
            $adjacentLocation = $curLoc->getAdjacentLocation($location->getName());
            $adjacent = $adjacentLocation->buildClassWithParameters();
            $adjacent($owner, $curLoc, $location);
        }

        return $owner;
    }

    /**
     * @param ILocation $location
     * @param IHasSampleParameters|null $owner
     */
    public function lookAround(ILocation $location, IHasSampleParameters &$owner = null): void
    {
        $this->tellRandomStory('around', ['location' => $location]);
    }
}
