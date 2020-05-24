<?php
namespace junkman\components\contents\items;

use extas\components\plugins\Plugin;
use junkman\components\skills\Skill;
use junkman\components\skills\SkillSpikeThrower;
use junkman\components\THasStories;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use junkman\interfaces\using\ICanUse;

/**
 * Class SpikeThrower
 *
 * @method contentsItemRepository()
 *
 * @package junkman\components\contents\items
 * @author jeyroik@gmail.com
 */
class SpikeThrower extends Plugin
{
    use THasStories;

    public const NAME = 'spike_thrower';
    public const PARAM__TINY_AS_A_SPIKE = 'tiny_as_a_spike';

    public const ARG__SPIKE = 'spike';

    protected array $stories = [
        'throw' => [
            'Наконец-то вы избавились от хлама.',
            'Гвоздомёт выпал из ваших рук и вы почувствовали большое облегчение, пальцы перестали зудеть.',
            '@junkman молча выбросил гвоздомёт на пол.'
        ],
        'take' => [
            'Вы обоими руками обхватили ручки гвоздомёта. В нём чувствуется мощь и бесполезность.'
        ],
        'missed_spike' => [
            'А что заряжать-то будем? [Передайте в args в параметре ' . self::ARG__SPIKE . ' name гвоздя]'
        ],
        'too_big' => [
            'Это слишком крупная фигня, попробуйте найти что-нибудь по-меньше. [Ищите вещи с параметром '
            . self::PARAM__TINY_AS_A_SPIKE . ']'
        ]
    ];

    /**
     * @param IContentsItem $spikeThrower
     * @param ICanUse $owner
     */
    public function forTake(IContentsItem &$spikeThrower, ICanUse &$owner): void
    {
        if ($owner instanceof IJunkman) {
            $owner->addSkill(new Skill([Skill::FIELD__NAME => SkillSpikeThrower::NAME]));
            $this->tellRandomStory('take');
        }
    }

    /**
     * @param IContentsItem $spikeThrower
     * @param ICanUse $owner
     */
    public function load(IContentsItem &$spikeThrower, ICanUse &$owner): void
    {
        $spike = $this->getSpike();

        if (!$spike) {
            $this->tellRandomStory('missed_spike');
        } else {
            $tinyAsASpike = $spike->getParameterValue(static::PARAM__TINY_AS_A_SPIKE, false);
            if ($tinyAsASpike) {
                $spikeThrower->setValue($spikeThrower->getValue() + 1);
                $this->contentsItemRepository()->delete([IContentsItem::FIELD__NAME => $spike->getName()]);
            }
        }
    }

    /**
     * @return IContentsItem|null
     */
    protected function getSpike(): ?IContentsItem
    {
        $spike = $this->config[static::ARG__SPIKE] ?? '';
        if ($spike) {
            return $this->contentsItemRepository()->one([IContentsItem::FIELD__NAME => $spike]);
        }

        return null;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.item.spike.thrower';
    }
}
