<?php
namespace junkman\components\plugins\uninstall;

use extas\components\plugins\uninstall\UninstallSection;
use junkman\components\skills\Skill;

/**
 * Class UninstallSkills
 *
 * @package junkman\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallSkills extends UninstallSection
{
    protected string $selfSection = 'junkman_skills';
    protected string $selfName = 'junkman skill';
    protected string $selfRepositoryClass = 'skillRepository';
    protected string $selfUID = Skill::FIELD__NAME;
    protected string $selfItemClass = Skill::class;
}
