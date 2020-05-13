<?php
namespace junkman\components;

use extas\components\players\Player;
use extas\components\samples\parameters\THasSampleParameters;
use extas\interfaces\IHasClass;
use junkman\components\contents\THasContentsItems;
use junkman\components\locations\THasLocation;
use junkman\components\skills\THasSkills;
use junkman\interfaces\IJunkman;
use junkman\interfaces\stages\IStageJunkmanUse;
use junkman\interfaces\stages\IStageJunkmanUseSkill;

/**
 * Class Junkman
 *
 * @jsonrpc_field name:string
 * @jsonrpc_field title:string
 * @jsonrpc_field description:string
 *
 * @jsonrpc_method create
 * @jsonrpc_method index
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
class Junkman extends Player implements IJunkman
{
    use THasSampleParameters;
    use THasSkills;
    use THasLocation;
    use THasContentsItems;

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
     * @param string $skillName
     * @param IJunkman|null $junkman
     * @param array $args
     */
    public function useSkill(string $skillName, ?IJunkman &$junkman = null, array $args = []): void
    {
        if ($this->hasSkill($skillName)) {
            $skill = $this->getSkill($skillName);
            $this->use($skill, IStageJunkmanUseSkill::NAME__SUFFIX, $junkman, $args);

            $stage = IStageJunkmanUseSkill::NAME__PREFIX . IStageJunkmanUseSkill::NAME__SUFFIX . '.' . $skillName;
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                /**
                 * @var IStageJunkmanUseSkill $plugin
                 */
                $plugin($this, $skill, $junkman, $args);
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
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.self';
    }
}
