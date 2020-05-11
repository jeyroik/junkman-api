<?php
namespace junkman\interfaces\skills;

use extas\interfaces\IItem;
use junkman\interfaces\IJunkman;

/**
 * Interface ISkillDispatcher
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface ISkillDispatcher extends IItem
{
    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    public function __invoke(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void;
}
