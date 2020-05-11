<?php
namespace junkman\components\skills;

use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;

/**
 * Class SkillTiredness
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillTiredness extends SkillDispatcher
{
    public const NAME = 'tiredness';
    public const FIELD__COST = 'cost';

    /**
     * @param IJunkman|IExtensionHealth $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $cost = $args[static::FIELD__COST] ?? 0;
        $method = $cost > 0 ? 'incProperty' : 'decProperty';
        $junkman->$method(static::NAME, $cost);
        $currentTiredness = $junkman->getParameterValue(static::NAME, 0);

        if ($currentTiredness > 4) {
            $healthCost = round($currentTiredness/5);
            $junkman->decHealth($healthCost);
        }

        $lostHealth = $junkman->getLostHealth();
        $tiredCost = round($lostHealth/5);
        $junkman->incProperty(static::NAME, $tiredCost);
    }

    /**
     * @return int
     */
    protected function getTirednessValue(): int
    {
        return 0;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.tiredness';
    }
}
