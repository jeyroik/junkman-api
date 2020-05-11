<?php
namespace junkman\components\skills;

use junkman\interfaces\IJunkman;

/**
 * Class SkillRest
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillRest extends SkillDispatcher
{
    public const NAME = 'rest';
    public const FIELD__DEFAULT_REGENERATION = 'default_health_regen';

    protected IJunkman $junkman;

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $maxHp = $junkman->getParameterValue($junkman::PARAM__HEALTH_MAX, 0);
        $curHp = $junkman->getParameterValue($junkman::PARAM__HEALTH, 0);

        if ($curHp < $maxHp) {
            $regen = $junkman->getParameterValue(
                $junkman::PARAM__HEALTH_REGENERATION,
                $this->getDefaultRegeneration()
            );
            $this->regeneration($junkman, $maxHp, $curHp, $regen);
        }

        $this->junkman = $junkman;
    }

    /**
     * @return int
     */
    protected function getTirednessValue(): int
    {
        return -$this->junkman->getParameterValue(
            $this->junkman::PARAM__HEALTH_REGENERATION,
            $this->getDefaultRegeneration()
        );
    }

    /**
     * @return int
     */
    protected function getDefaultRegeneration(): int
    {
        return $this->config[static::FIELD__DEFAULT_REGENERATION] ?? 1;
    }

    /**
     * @param IJunkman $junkman
     * @param int $maxHp
     * @param int $curHp
     * @param int $regen
     */
    protected function regeneration(IJunkman &$junkman, int $maxHp, int $curHp, int $regen): void
    {
        if ($regen > ($maxHp - $curHp)) {
            $curHp = $maxHp;
            $junkman->setParameterValue($junkman::PARAM__HEALTH, $curHp);
        } else {
            $junkman->incProperty($junkman::PARAM__HEALTH, $regen);
        }
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.rest';
    }
}
