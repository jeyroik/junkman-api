<?php
namespace junkman\components\skills;

use extas\components\repositories\Repository;
use junkman\interfaces\skills\ISkillRepository;

/**
 * Class SkillRepository
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillRepository extends Repository implements ISkillRepository
{
    protected string $name = 'skills';
    protected string $scope = 'junkman';
    protected string $pk = Skill::FIELD__NAME;
    protected string $itemClass = Skill::class;
}
