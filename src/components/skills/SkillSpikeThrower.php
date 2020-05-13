<?php
namespace junkman\components\skills;

use junkman\components\contents\items\SpikeThrower;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;

/**
 * Class SkillSpikeThrower
 *
 * @method tellStory(array $episodes)
 * @method contentsItemRepository()
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillSpikeThrower extends SkillDispatcher
{
    public const NAME = 'spike_thrower';

    protected int $tiredness = 0;
    protected array $stories = [
        'self' => [
            [
                'Вы, похоже, совсем съехали с катушек и шмальнули в себя гвоздём.',
                'Хотя в чём вас винить, да и кому?'
            ],
            'Знал я одного гвоздодрота и звали его как-то по гвоздодротски...'
        ],
        'another' => [
            'Уау! Вот это залп! Прямо в брюхо этому ублюдку!',
            'Стрелять гвоздями...Блять, да такое нарочно не придумаешь...',
            'Вы подумали: "Я стреляю гвоздями - значит я и есть гвоздомёт..."'
        ],
        'empty' => [
            'Ад мой в зад! Похоже, закончились гвозди! Или эта хреновина просто сломалась...',
            'Пиздец, а гвозди что ли кончаются?!',
            'А ещё вы мечтали про свежий картон и тёплую стекловату, ну и, конечно, чтобы остался хотя бы ещё 1 гвоздь.'
        ]
    ];

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $throwerName = $junkman->getParameterValue(SpikeThrower::NAME, '');
        $spikeThrower = $junkman->getContentsItem($throwerName);

        if ($spikeThrower) {
            $this->throwSomeSpikes($spikeThrower, $junkman, $enemy);
        }
    }

    /**
     * @param IContentsItem $thrower
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     */
    protected function throwSomeSpikes(IContentsItem $thrower, IJunkman &$junkman, ?IJunkman &$enemy): void
    {
        $spikesCount = $thrower->getValue(0);
        if ($spikesCount) {
            $this->tiredness = $damage = (12 - $spikesCount + 1);
            $enemy->decProperty($enemy::PARAM__HEALTH, $damage);
            if ($junkman->getName() == $enemy->getName()) {
                $this->tellRandomStory('self');
            } else {
                $this->tellRandomStory('another');
            }
            $thrower->setValue($spikesCount-1);
            $this->contentsItemRepository()->update($thrower);
        } else {
            $this->tellRandomStory('empty');
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
