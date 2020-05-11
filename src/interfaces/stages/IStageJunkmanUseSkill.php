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
interface IStageJunkmanUseSkill extends IStageJunkmanUse
{
    public const NAME__SUFFIX = 'skill';

    /**
     * @param IJunkman $owner
     * @param ISkill $skill
     * @param IJunkman|null $enemy
     * @param array $args
     */
    public function __invoke(IJunkman &$owner, ISkill $skill, ?IJunkman &$enemy, array $args = []): void;
}
