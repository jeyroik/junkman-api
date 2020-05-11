<?php
namespace junkman\components;

use extas\components\players\Player;
use extas\components\samples\parameters\THasSampleParameters;
use extas\interfaces\IHasClass;
use junkman\components\locations\THasLocation;
use junkman\components\skills\THasSkills;
use junkman\interfaces\IJunkman;
use junkman\interfaces\stages\IStageJunkmanUse;

/**
 * Class Junkman
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
class Junkman extends Player implements IJunkman
{
    use THasSampleParameters;
    use THasSkills;
    use THasLocation;

    /**
     * @param IHasClass $subject
     * @param string $stageSuffix
     * @param mixed ...$args
     */
    public function use(IHasClass $subject, string $stageSuffix, ...$args): void
    {
        $dispatcher = $subject->buildClassWithParameters();
        $dispatcher($this, $subject, ...$args);

        foreach ($this->getPluginsByStage(IStageJunkmanUse::NAME__PREFIX. $stageSuffix) as $plugin) {
            $plugin($this, $subject, ...$args);
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
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.self';
    }
}
