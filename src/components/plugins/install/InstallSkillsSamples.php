<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\skills\Skill;

/**
 * Class InstallSkillsSamples
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallSkillsSamples extends InstallSection
{
    protected string $selfSection = 'junkman_skills_samples';
    protected string $selfName = 'junkman skill sample';
    protected string $selfRepositoryClass = 'skillSampleRepository';
    protected string $selfUID = Skill::FIELD__NAME;
    protected string $selfItemClass = Skill::class;
}
