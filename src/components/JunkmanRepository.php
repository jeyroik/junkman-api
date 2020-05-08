<?php
namespace junkman\components;

use extas\components\repositories\Repository;
use junkman\interfaces\IJunkmanRepository;

/**
 * Class JunkmanRepository
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
class JunkmanRepository extends Repository implements IJunkmanRepository
{
    protected string $name = 'junkmen';
    protected string $scope = 'junkman';
    protected string $pk = Junkman::FIELD__NAME;
    protected string $itemClass = Junkman::class;
}
