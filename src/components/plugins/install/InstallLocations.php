<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\locations\Location;

/**
 * Class InstallLocations
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallLocations extends InstallSection
{
    protected string $selfSection = 'junkman_locations';
    protected string $selfName = 'junkman location';
    protected string $selfRepositoryClass = 'locationRepository';
    protected string $selfUID = Location::FIELD__NAME;
    protected string $selfItemClass = Location::class;
}
