<?php
namespace junkman\components\skills;

use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

/**
 * Class SkillSpikeThrower
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillSpikeThrower extends SkillDispatcher
{
    public const NAME = 'spike_thrower';

    protected int $tiredness = 0;

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $spikeThrower = $junkman->getSkill(static::NAME);

        if ($spikeThrower) {
            $this->throwSomeSpikes($spikeThrower, $junkman, $enemy);
        }
    }

    /**
     * @param ISkill $thrower
     * @param IJunkman|null $enemy
     */
    protected function throwSomeSpikes(ISkill $thrower, IJunkman &$junkman, ?IJunkman &$enemy): void
    {
        $spikesCount = $thrower->getParameterValue('resource', 0);
        if ($spikesCount) {
            $this->tiredness = $damage = (12 - $spikesCount + 1);
            $enemy->decProperty($enemy::FIELD__HEALTH, $damage);
            $thrower->setParameterValue('resource', $spikesCount-1);
            $junkman->removeSkill(static::NAME);
            $junkman->addSkill($thrower);
        }
    }

    /**
     * @return int
     */
    protected function getTirednessValue(): int
    {
        return $this->tiredness;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.spike.thrower';
    }
}
