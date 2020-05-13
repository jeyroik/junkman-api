<?php
namespace junkman\components\skills;

use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;

/**
 * Class SkillRest
 *
 * @method tellStory(array $episodes)
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillRest extends SkillDispatcher
{
    public const NAME = 'rest';
    public const FIELD__DEFAULT_REGENERATION = 'default_health_regen';

    protected IJunkman $junkman;
    protected array $stories = [
        '100%' => [
            'Вы и так в полном порядке, хватит нежиться и тащите свой зад на поиски.',
            'Как хорошо ничего не делать и ещё немного отдохнуть.'
        ],
        'now 100%' => [
            'Вы отлично отдохнули (а как иначе в погибшем мире?) и полностью восстановили свои силы.',
            'Полностью здоровы! Насколько это возможно в гниющем мире.'
        ],
        '%' => [
            'Вы немного отдохнули и как будто бы стало чуть легче дышать этим грязным воздухом.',
            'Давление нормализовалось, можно и побегать...тут же так весело бегать по кладбищу цивилизации.'
        ],
        '0 tiredness' => [
            'Вся усталость прошла, можно двигаться вперёд! Приключения впереди и бла-бла-бла.',
            'Теперь можно и горы свернуть! Если б в этом мире ещё оставались горы...а может они и есть где-то?'
        ],
        '% tiredness' => [
            'Да и усталость чуть отступила, как путник от долгожданного источника.',
            'Появились силы встать и пойти дальше...в светлое будущее мрачного мира.'
        ]
    ];

    /**
     * @param IJunkman|IExtensionHealth $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $maxHp = $junkman->getParameterValue($junkman::PARAM__HEALTH_MAX, 0);
        $curHp = $junkman->getParameterValue($junkman::PARAM__HEALTH, 0);

        if (($curHp < $maxHp) || ($junkman->getParameterValue(SkillTiredness::NAME))) {
            $regen = $junkman->getCurrentHealthRegeneration();
            $this->regeneration($junkman, $maxHp, $curHp, $regen);
        } else {
            $this->tellRandomStory('100%');
        }

        $this->junkman = $junkman;
    }

    /**
     * @return int
     */
    protected function getTirednessValue(): int
    {
        return 0;
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
            $this->tellRandomStory('now 100%');
        } else {
            $junkman->incProperty($junkman::PARAM__HEALTH, $regen);
            $this->tellRandomStory('%');
        }

        if ($junkman->getParameterValue(SkillTiredness::NAME) < $regen) {
            $junkman->setParameterValue(SkillTiredness::NAME, 0);
            $this->tellRandomStory('0 tiredness');
        } else {
            $junkman->decProperty(SkillTiredness::NAME, $regen);
            $this->tellRandomStory('% tiredness');
        }

        $this->junkmanRepository()->update($junkman);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.rest';
    }
}
