<?php
namespace junkman\components\skills;

use extas\interfaces\IHasClass;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\IHasSkills;
use junkman\interfaces\skills\ISkill;
use junkman\interfaces\stages\IStageJunkmanUseSkill;

/**
 * Trait THasSkills
 * 
 * @property array $config
 *
 * @method getPluginsByStage(string $stage)
 * @method getSubjectForExtension(): string
 * @method use(IHasClass $subject, string $stageSuffix, ...$args): void
 * 
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
trait THasSkills
{
    /**
     * @param ISkill $skill
     * @return $this
     */
    public function addSkill(ISkill $skill)
    {
        $this->config[IHasSkills::FIELD__SKILLS] = $this->config[IHasSkills::FIELD__SKILLS] ?? [];
        $skill[ISkill::FIELD__FREQUENCY] = [];
        $this->config[IHasSkills::FIELD__SKILLS][$skill->getName()] = $skill->__toArray();

        foreach ($this->getPluginsByStage($this->getSubjectForExtension() . '.skill.added') as $plugin) {
            $plugin($this, $skill);
        }

        return $this;
    }

    public function getSkill(string $skillName): ?ISkill
    {
        if ($this->hasSkill($skillName)) {
            return new Skill($this->config[IHasSkills::FIELD__SKILLS][$skillName]);
        }

        return null;
    }

    /**
     * @param array $skills
     * @return $this
     */
    public function addSkills(array $skills)
    {
        foreach ($skills as $skill) {
            $this->addSkill($skill);
        }

        return $this;
    }

    /**
     * @param string $skillName
     * @return bool
     */
    public function hasSkill(string $skillName): bool
    {
        $skills = $this->config[IHasSkills::FIELD__SKILLS] ?? [];

        return isset($skills[$skillName]);
    }

    /**
     * @param string $skillName
     * @return $this
     */
    public function removeSkill(string $skillName)
    {
        if ($this->hasSkill($skillName)) {
            unset($this->config[IHasSkills::FIELD__SKILLS][$skillName]);

            $stage = $this->getSubjectForExtension() . '.skill.removed';
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($this, $skillName);
            }

            $stage = $this->getSubjectForExtension() . '.skill.removed.' . $skillName;
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($this, $skillName);
            }
        }

        return $this;
    }

    /**
     * @param array $skillsNames
     * @return $this
     */
    public function removeSkills(array $skillsNames)
    {
        foreach ($skillsNames as $skillName) {
            $this->removeSkill($skillName);
        }

        return $this;
    }
}
