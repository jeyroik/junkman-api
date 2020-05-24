<?php
namespace junkman\components\using;

use extas\components\repositories\Repository;
use junkman\interfaces\using\IUserRepository;

/**
 * Class UserRepository
 *
 * @package junkman\components\using
 * @author jeyroik@gmail.com
 */
class UserRepository extends Repository implements IUserRepository
{
    protected string $name = 'users';
    protected string $scope = 'junkman';
    protected string $pk = User::FIELD__ID;
    protected string $itemClass = User::class;
}
