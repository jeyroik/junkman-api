<?php
namespace junkman\components\plugins\uninstall;

use extas\components\plugins\uninstall\UninstallSection;
use junkman\components\locations\Location;

/**
 * Class UninstallLocations
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallLocations extends UninstallSection
{
    protected string $selfSection = 'junkman_locations';
    protected string $selfName = 'junkman location';
    protected string $selfRepositoryClass = 'locationRepository';
    protected string $selfUID = Location::FIELD__NAME;
    protected string $selfItemClass = Location::class;
}
