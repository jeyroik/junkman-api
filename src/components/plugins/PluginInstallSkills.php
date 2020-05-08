<?php
namespace junkman\components\plugins;

use extas\components\plugins\PluginInstallDefault;
use junkman\components\skills\Skill;
use junkman\interfaces\skills\ISkillRepository;

/**
 * Class PluginInstallSkills
 *
 * @package junkman\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallSkills extends PluginInstallDefault
{
    protected string $selfSection = 'junkman_skills';
    protected string $selfName = 'junkman skill';
    protected string $selfRepositoryClass = ISkillRepository::class;
    protected string $selfUID = Skill::FIELD__NAME;
    protected string $selfItemClass = Skill::class;
}
