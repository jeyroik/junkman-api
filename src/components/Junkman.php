<?php
namespace junkman\components;

use extas\components\players\Player;
use extas\components\samples\parameters\THasSampleParameters;
use junkman\components\skills\Skill;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

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
    public function addSkill(ISkill $skill)
    {
        $this->config[static::FIELD__SKILLS] = $this->config[static::FIELD__SKILLS] ?? [];
        $this->config[static::FIELD__SKILLS][$skill->getName()] = $skill->__toArray();

        foreach ($this->getPluginsByStage('junkman.skill.added') as $plugin) {
            $plugin($this, $skill);
        }

        return $this;
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
    public function hasSkill(string $skillName)
    {
        $skills = $this->config[static::FIELD__SKILLS] ?? [];

        return isset($skills[$skillName]);
    }

    /**
     * @param string $skillName
     * @return $this
     */
    public function removeSkill(string $skillName)
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
    public function removeSkills(array $skillsNames)
    {
        foreach ($skillsNames as $skillName) {
            $this->removeSkill($skillName);
        }

        return $this;
    }

    /**
     * @param string $skillName
     * @param array $args
     * @param IJunkman|null $junkman
     * @return $this
     */
    public function useSkill(string $skillName, array $args, IJunkman &$junkman = null)
    {
        if ($this->hasSkill($skillName)) {
            $skill = new Skill($this->config[static::FIELD__SKILLS][$skillName]);
            $dispatcher = $skill->buildClassWithParameters($args);
            $dispatcher($this, $junkman);

            foreach ($this->getPluginsByStage('junkman.use.skill') as $plugin) {
                $plugin($this, $junkman, $skill);
            }

            foreach ($this->getPluginsByStage('junkman.use.skill.' . $skillName) as $plugin) {
                $plugin($this, $junkman, $skill);
            }
        }

        return $this;
    }

    /**
     * @param string $name
     * @param int $increment
     * @return $this
     * @throws \Exception
     */
    public function incProperty(string $name, int $increment)
    {
        $val = $this->getParameterValue($name);
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
     * @return $this
     * @throws \Exception
     */
    public function decProperty(string $name, int $decrement)
    {
        $val = $this->getParameterValue($name);
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
}
