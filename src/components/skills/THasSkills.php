<?php
namespace junkman\components\skills;

use extas\interfaces\IHasClass;
use junkman\interfaces\skills\IHasSkills;
use junkman\interfaces\skills\ISkill;

/**
 * Trait THasSkills
 * 
 * @property array $config
 *
 * @method skillRepository()
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
        $this->config[IHasSkills::FIELD__SKILLS][] = $skill->getName();

        foreach ($this->getPluginsByStage($this->getSubjectForExtension() . '.skill.added') as $plugin) {
            $plugin($this, $skill);
        }

        return $this;
    }

    public function getSkill(string $skillName): ?ISkill
    {
        if ($this->hasSkill($skillName)) {
            return $this->skillRepository()->one([ISkill::FIELD__NAME => $skillName]);
        }

        return null;
    }

    /**
     * @return ISkill[]
     */
    public function getSkills(): array
    {
        $skillsNames = $this->config[IHasSkills::FIELD__SKILLS] ?? [];
        return $this->skillRepository()->all([ISkill::FIELD__NAME => $skillsNames]);
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

        return in_array($skillName, $skills);
    }

    /**
     * @param string $skillName
     * @return $this
     */
    public function removeSkill(string $skillName)
    {
        if ($this->hasSkill($skillName)) {
            $skills = $this->config[IHasSkills::FIELD__SKILLS] ?? [];
            $byName = array_flip($skills);
            unset($byName[$skillName]);
            $this->config[IHasSkills::FIELD__SKILLS] = array_keys($byName);

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
