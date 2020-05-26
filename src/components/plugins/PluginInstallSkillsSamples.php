<?php
namespace junkman\components\plugins;

use extas\components\plugins\PluginInstallDefault;
use junkman\components\skills\SkillSample;
use junkman\interfaces\skills\ISkillSampleRepository;

/**
 * Class PluginInstallSkillsSamples
 *
 * @package junkman\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallSkillsSamples extends PluginInstallDefault
{
    protected string $selfSection = 'junkman_skills_samples';
    protected string $selfName = 'junkman skill sample';
    protected string $selfRepositoryClass = ISkillSampleRepository::class;
    protected string $selfUID = SkillSample::FIELD__NAME;
    protected string $selfItemClass = SkillSample::class;
}
