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
    public const NAME = 'spike_thrower';
    public const PARAM__TINY_AS_A_SPIKE = 'tiny_as_a_spike';
    protected array $stories = [
        'throw' => [
            'Наконец-то вы избавились от хлама.',
            'Гвоздомёт выпал из ваших рук и вы почувствовали большое облегчение, пальцы перестали зудеть.',
            '@junkman молча выбросил гвоздомёт на пол.'
        ],
        'take' => [
            'Вы обоими руками обхватили ручки гвоздомёта. В нём чувствуется мощь и бесполезность.'
        ]
    ];

    /**
     * Неизвестное действие или действие по умолчанию
     *
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, IContentsItem &$item, array $args = []): void
    {
        $this->takenBy($junkman, $item, $args);
    }

    /**
     * Старьёвщик берёт гвоздомёт себе.
     *
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $args
     */
    public function takenBy(IJunkman &$junkman, IContentsItem &$item, array $args = []): void
    {
        $junkman->addContentsItem($item);
        $junkman->addSkill(new Skill([Skill::FIELD__NAME => SkillSpikeThrower::NAME]));
    }

    /**
     * Старьёвщик выкинул гвоздомёт.
     *
     * @param IJunkman $from
     * @param IContentsItem $spikeThrower
     * @param array $args
     */
    public function thrownBy(IJunkman &$from, IContentsItem &$spikeThrower, array $args = []): void
    {
        $from->removeContentsItem($spikeThrower->getName());
        $from->removeSkill(SkillSpikeThrower::NAME);
        $this->tellRandomStory('throw', ['junkman' => $from->getTitle()]);
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
