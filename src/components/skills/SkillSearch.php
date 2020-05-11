<?php
namespace junkman\components\skills;

use junkman\interfaces\IJunkman;

/**
 * Class SkillSearch
 *
 * @method skillRepository()
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillSearch extends SkillDispatcher
{
    public const NAME = 'search';

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $rand = mt_rand(0, 100);
        $skills = $this->skillRepository()->all(['frequency' => $rand]);
        foreach ($skills as $skill) {
            if (!$junkman->hasSkill($skill->getName())) {
                $junkman->addSkill($skill);
                break;
            }
        }
    }

    /**
     * @return int
     */
    protected function getTirednessValue(): int
    {
        return 3;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.search';
    }
}
