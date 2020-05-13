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
            $this->tellStory([
                'Вы и так в полном порядке, хватит нежиться и тащите свой зад на поиски.'
            ]);
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
            $this->tellStory([
                'Вы отлично отдохнули (а как иначе в погибшем мире?) и полностью восстановили свои силы.'
            ]);
        } else {
            $junkman->incProperty($junkman::PARAM__HEALTH, $regen);
            $this->tellStory([
                'Вы немного отдохнули и как будто бы стало чуть легче дышать этим грязным воздухом.'
            ]);
        }

        if ($junkman->getParameterValue(SkillTiredness::NAME) < $regen) {
            $junkman->setParameterValue(SkillTiredness::NAME, 0);
            $this->tellStory(['Вся утсалость прошла, можно двигаться вперёд! Приключения впереди и бла-бла-бла.']);
        } else {
            $junkman->decProperty(SkillTiredness::NAME, $regen);
            $this->tellStory(['Да и усталость чуть отступила, как путник от долгожданного источника.']);
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
