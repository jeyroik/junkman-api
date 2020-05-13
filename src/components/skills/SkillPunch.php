<?php
namespace junkman\components\skills;

use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

/**
 * Class SkillPunch
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillPunch extends SkillDispatcher
{
    public const NAME = 'punch';

    protected int $tiredness = 0;
    protected array $stories = [
        'self' => [
            [
                'В бешенстве вы заколотили по своей башке кулаками.',
                'Злость и отчаяние никуда не делись, зато усталости прибавилось.'
            ],
            [
                'То ли от усталости, то ли от безделья, но вы шарахнули себя по лбу.',
                'Наконец-то очнувшись, вы вновь огляделись и что-то ёкнуло внутри.'
            ]
        ],
        'another' => [
            'С размаху вы заехали сопернику по уху ... или что там у него торчит из башки...',
            'Кулак угодил бедняге прямо между глаз...искр посыпалось столько, что хватило бы, чтобы спалить этот мир.',
            'Кулак по касательной прошёл по брови соперника, из которой потекла кровь. Кровь ли это?',
            [
                'Удар пришёлся по животу, от чего бедняга согнулся пополам.',
                'Прямо как вы позавчера после обеда консервами.'
            ]
        ]
    ];

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $skill = $junkman->getSkill(static::NAME);

        if ($skill) {
            $this->do($skill, $junkman, $enemy);
        }
    }

    /**
     * @param ISkill $skill
     * @param IJunkman $junkman
     * @param IJunkman|null|IExtensionHealth $enemy
     */
    protected function do(ISkill $skill, IJunkman &$junkman, ?IJunkman &$enemy): void
    {
        $this->tiredness = $damage = $junkman->getParameterValue($junkman::PARAM__ATTACK, 1);
        $enemy->decHealth($damage);
        if ($junkman->getName() == $enemy->getName()) {
            $this->tellRandomStory('self');
        } else {
            $this->tellRandomStory('another');
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
        return 'junkman.skill.punch';
    }
}
