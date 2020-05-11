<?php
namespace junkman\components;

use extas\components\players\Player;
use extas\components\samples\parameters\THasSampleParameters;
use junkman\components\skills\Skill;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;
use junkman\interfaces\skills\ISkillDispatcher;
use junkman\interfaces\stages\IStageJunkmanUseSkill;

/**
 * Class Junkman
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
class Junkman extends Player implements IJunkman
{
    use THasSampleParameters;

    /**
     * @param ISkill $skill
     * @return $this
     */
    public function addSkill(ISkill $skill): IJunkman
    {
        $this->config[static::FIELD__SKILLS] = $this->config[static::FIELD__SKILLS] ?? [];
        $this->config[static::FIELD__SKILLS][$skill->getName()] = $skill->__toArray();

        foreach ($this->getPluginsByStage('junkman.skill.added') as $plugin) {
            $plugin($this, $skill);
        }

        return $this;
    }

    public function getSkill(string $skillName): ?ISkill
    {
        if ($this->hasSkill($skillName)) {
            return new Skill($this->config[static::FIELD__SKILLS][$skillName]);
        }

        return null;
    }

    /**
     * @param array $skills
     * @return $this
     */
    public function addSkills(array $skills): IJunkman
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
        $skills = $this->config[static::FIELD__SKILLS] ?? [];

        return isset($skills[$skillName]);
    }

    /**
     * @param string $skillName
     * @return $this
     */
    public function removeSkill(string $skillName): IJunkman
    {
        if ($this->hasSkill($skillName)) {
            unset($this->config[static::FIELD__SKILLS][$skillName]);

            foreach ($this->getPluginsByStage('junkman.skill.removed') as $plugin) {
                $plugin($this, $skillName);
            }

            foreach ($this->getPluginsByStage('junkman.skill.removed.' . $skillName) as $plugin) {
                $plugin($this, $skillName);
            }
        }

        return $this;
    }

    /**
     * @param array $skillsNames
     * @return $this
     */
    public function removeSkills(array $skillsNames): IJunkman
    {
        foreach ($skillsNames as $skillName) {
            $this->removeSkill($skillName);
        }

        return $this;
    }

    /**
     * @param string $skillName
     * @param IJunkman|null $junkman
     * @param array $args
     */
    public function useSkill(string $skillName, ?IJunkman &$junkman = null, array $args = []): void
    {
        if ($this->hasSkill($skillName)) {
            $skill = new Skill($this->config[static::FIELD__SKILLS][$skillName]);
            /**
             * @var ISkillDispatcher $dispatcher
             */
            $dispatcher = $skill->buildClassWithParameters($skill->getParametersValues());
            $dispatcher($this, $junkman, $args);

            foreach ($this->getPluginsByStage(IStageJunkmanUseSkill::NAME) as $plugin) {
                /**
                 * @var IStageJunkmanUseSkill $plugin
                 */
                $plugin($this, $junkman, $skill);
            }

            foreach ($this->getPluginsByStage(IStageJunkmanUseSkill::NAME . '.' . $skillName) as $plugin) {
                /**
                 * @var IStageJunkmanUseSkill $plugin
                 */
                $plugin($this, $junkman, $skill);
            }
        }
    }

    /**
     * @param string $name
     * @param int $increment
     * @param mixed $default
     * @return $this
     * @throws \Exception
     */
    public function incProperty(string $name, int $increment, $default = null): IJunkman
    {
        $val = $this->getParameterValue($name, $default);
        $val += $increment;

        $this->setParameterValue($name, $val);

        foreach ($this->getPluginsByStage('junkman.property.inc') as $plugin) {
            $plugin($this, $increment);
        }

        foreach ($this->getPluginsByStage('junkman.property.inc.'. $name) as $plugin) {
            $plugin($this, $increment);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param int $decrement
     * @param mixed $default
     * @return $this
     * @throws \Exception
     */
    public function decProperty(string $name, int $decrement, $default = null): IJunkman
    {
        $val = $this->getParameterValue($name, $default);
        $val -= $decrement;

        if ($val < 0) {
            $val = 0;
        }

        $this->setParameterValue($name, $val);

        foreach ($this->getPluginsByStage('junkman.property.dec') as $plugin) {
            $plugin($this, $decrement);
        }

        foreach ($this->getPluginsByStage('junkman.property.dec.'. $name) as $plugin) {
            $plugin($this, $decrement);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->getParameterValue(static::FIELD__HEALTH) == 0;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.self';
    }
}
