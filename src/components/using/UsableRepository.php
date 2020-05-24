<?php
namespace junkman\components\using;

use extas\components\repositories\Repository;
use junkman\interfaces\using\IUsableRepository;

/**
 * Class UsableRepository
 *
 * @package junkman\components\using
 * @author jeyroik@gmail.com
 */
class UsableRepository extends Repository implements IUsableRepository
{
    protected string $name = 'usable';
    protected string $scope = 'junkman';
    protected string $pk = Usable::FIELD__ID;
    protected string $itemClass = Usable::class;
}
