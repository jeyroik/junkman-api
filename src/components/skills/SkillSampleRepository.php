<?php
namespace junkman\components\skills;

use extas\components\repositories\Repository;
use junkman\interfaces\skills\ISkillSampleRepository;

/**
 * Class SkillSampleRepository
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillSampleRepository extends Repository implements ISkillSampleRepository
{
    protected string $name = 'skills_samples';
    protected string $scope = 'junkman';
    protected string $pk = SkillSample::FIELD__NAME;
    protected string $itemClass = SkillSample::class;
}
