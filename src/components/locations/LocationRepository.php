<?php
namespace junkman\components\locations;

use extas\components\repositories\Repository;
use junkman\interfaces\locations\ILocationRepository;

/**
 * Class LocationRepository
 *
 * @package junkman\components\locations
 * @author jeyroik@gmail.com
 */
class LocationRepository extends Repository implements ILocationRepository
{
    protected string $name = 'locations';
    protected string $scope = 'junkman';
    protected string $pk = Location::FIELD__NAME;
    protected string $itemClass = Location::class;
}
