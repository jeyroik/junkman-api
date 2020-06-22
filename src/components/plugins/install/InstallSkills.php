<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\skills\Skill;

/**
 * Class InstallSkills
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallSkills extends InstallSection
{
    protected string $selfSection = 'junkman_skills';
    protected string $selfName = 'junkman skill';
    protected string $selfRepositoryClass = 'skillRepository';
    protected string $selfUID = Skill::FIELD__NAME;
    protected string $selfItemClass = Skill::class;
}
