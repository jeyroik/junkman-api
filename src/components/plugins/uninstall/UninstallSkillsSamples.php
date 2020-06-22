<?php
namespace junkman\components\plugins\uninstall;

use extas\components\plugins\uninstall\UninstallSection;
use junkman\components\skills\Skill;

/**
 * Class UninstallSkillsSamples
 *
 * @package junkman\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallSkillsSamples extends UninstallSection
{
    protected string $selfSection = 'junkman_skills_samples';
    protected string $selfName = 'junkman skill sample';
    protected string $selfRepositoryClass = 'skillSampleRepository';
    protected string $selfUID = Skill::FIELD__NAME;
    protected string $selfItemClass = Skill::class;
}
