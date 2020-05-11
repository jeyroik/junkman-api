<?php
namespace junkman\interfaces\stages;

use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

/**
 * Interface IStageJunkmanUseSkill
 *
 * @package junkman\interfaces\stages
 * @author jeyroik@gmail.com
 */
interface IStageJunkmanUseSkill
{
    public const NAME = 'junkman.use.skill';

    /**
     * @param IJunkman $owner
     * @param IJunkman $enemy
     * @param ISkill $skill
     */
    public function __invoke(IJunkman &$owner, ?IJunkman &$enemy, ISkill $skill): void;
}
