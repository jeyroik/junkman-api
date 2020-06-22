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
 * @method getName()
 * @method skillRepository()
 * @method skillSampleRepository()
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
        if ($this->hasSkill($skill->getName())) {
            return $this;
        }

        foreach ($this->getPluginsByStage($this->getSubjectForExtension() . '.skill.added') as $plugin) {
            $plugin($this, $skill);
        }

        $this->skillRepository()->create($skill);

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
        return $this->skillRepository()->all([ISkill::FIELD__PLAYER_NAME => $this->getName()]);
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
        return $this->skillRepository()->one([ISkill::FIELD__NAME => $skillName]) ? true : false;
    }

    /**
     * @param string $skillName
     * @return $this
     */
    public function removeSkill(string $skillName)
    {
        if ($this->hasSkill($skillName)) {
            $skill = $this->getSkill($skillName);
            $this->skillRepository()->delete([ISkill::FIELD__NAME => $skillName]);

            $stage = $this->getSubjectForExtension() . '.skill.removed';
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($this, $skill);
            }

            $stage = $this->getSubjectForExtension() . '.skill.removed.' . $skill->getSampleName();
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($this, $skill);
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
