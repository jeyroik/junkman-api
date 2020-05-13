<?php
namespace junkman\components\contents\items;

use junkman\components\skills\Skill;
use junkman\components\skills\SkillSpikeThrower;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;

/**
 * Class SpikeThrower
 *
 * @package junkman\components\contents\items
 * @author jeyroik@gmail.com
 */
class SpikeThrower extends ItemDispatcher
{
    public const NAME = 'spike.thrower';
    public const PARAM__TINY_AS_A_SPIKE = 'tiny_as_a_spike';

    /**
     * Старьёвщик берёт гвоздомёт себе.
     *
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, IContentsItem &$item, array $args = []): void
    {
        $junkman->setParameterValue(static::NAME, $item->getName());
        $junkman->addSkill(new Skill([Skill::FIELD__NAME => SkillSpikeThrower::NAME]));
    }

    /**
     * Старьёвщик пытается что-то зарядить в гвоздомёт.
     *
     * @param IJunkman $junkman
     * @param IContentsItem $thrower
     * @param IContentsItem $item
     */
    public function load(IJunkman &$junkman, IContentsItem $thrower, IContentsItem $item)
    {
        $tinyAsASpike = $item->getParameterValue(static::PARAM__TINY_AS_A_SPIKE, false);
        if ($tinyAsASpike) {
            $thrower->setValue($thrower->getValue() + 1);
            $junkman->removeContentsItem($item->getName());
        }
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.item.spike.thrower';
    }
}
