<?php
namespace junkman\interfaces\skills;

use extas\interfaces\IItem;
use junkman\interfaces\IHasStories;
use junkman\interfaces\IJunkman;

/**
 * Interface ISkillDispatcher
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface ISkillDispatcher extends IItem, IHasStories
{
    /**
     * @param IJunkman $junkman
     * @param ISkill $skill
     * @param IJunkman|null $enemy
     * @param array $args
     */
    public function __invoke(IJunkman &$junkman, ISkill $skill, ?IJunkman &$enemy, array $args = []): void;
}
