<?php
namespace junkman\components\jsonrpc;

use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkill;

/**
 * Class JunkmanRemoveSkill
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
class JunkmanRemoveSkill extends JunkmanAddSkill
{
    /**
     * @param IJunkman $junkman
     * @param ISkill $skill
     */
    protected function doAction(IJunkman &$junkman, ISkill $skill)
    {
        $junkman->removeSkill($skill->getName());
        $this->tellStory([
            'Какая к чёрту история!? Вы просто лишили какого-то бродягу ещё одного навыка.',
            'Теперь ему будет проще гнить в этом забытом всеми богами месте.'
        ]);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.operation.junkman.add.skill';
    }
}
