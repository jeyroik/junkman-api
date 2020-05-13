<?php
namespace junkman\components\skills;

use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

/**
 * Class SkillKick
 *
 * @method tellStory(array $episodes)
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillKick extends SkillPunch
{
    public const NAME = 'kick';

    protected int $tiredness = 0;
    protected array $stories = [
        'self' => [
            'Хрен разберёшь как вы умудрились, но заехали себе по уху ногой',
            'Вы наклонились, приметив что-то на полу, но ударились башкой об своё колено.'
        ],
        'another' => [
            'Словно ниндзя из старых сказок, вы с размаху заехали сопернику по башке...это ведь была башка?',
            'Нога угодила бедняге прямо между глаз...искр посыпалось столько, что хватило бы, чтобы спалить этот мир.',
            [
                'Удар пришёлся по животу, от чего бедняга согнулся пополам.',
                'Прямо как вы на днях после завтрака печенькой.'
            ]
        ]
    ];

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.kick';
    }
}
