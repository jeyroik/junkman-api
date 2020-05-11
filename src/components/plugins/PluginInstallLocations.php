<?php
namespace junkman\components\plugins;

use extas\components\plugins\PluginInstallDefault;
use junkman\components\locations\Location;
use junkman\interfaces\locations\ILocationRepository;

/**
 * Class PluginInstallLocations
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallLocations extends PluginInstallDefault
{
    protected string $selfSection = 'junkman_locations';
    protected string $selfName = 'junkman location';
    protected string $selfRepositoryClass = ILocationRepository::class;
    protected string $selfUID = Location::FIELD__NAME;
    protected string $selfItemClass = Location::class;
}
