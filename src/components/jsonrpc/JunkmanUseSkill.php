<?php
namespace junkman\components\jsonrpc;

use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

/**
 * Class JunkmanUseSkill
 *
 * params:
 *  junkman_name
 *  skill_name
 *
 * @method junkmanRepository()
 * @method skillRepository()
 *
 * @package junkman\components\jsonrpc
 * @author jeyroik@gmail.com
 */
class JunkmanUseSkill extends JunkmanAddSkill
{
    /**
     * @param IJunkman $junkman
     * @param ISkill $skill
     */
    protected function doAction(IJunkman &$junkman, ISkill $skill)
    {
        $junkman->useSkill($skill->getName(), $junkman, []);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.operation.junkman.use.skill';
    }
}
