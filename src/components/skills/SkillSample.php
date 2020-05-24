<?php
namespace junkman\components\skills;

use extas\components\samples\Sample;
use extas\components\THasClass;
use junkman\components\THasDefinition;
use junkman\components\THasFrequency;
use junkman\components\using\TCanBeUsed;
use junkman\interfaces\skills\ISkillSample;

/**
 * Class SkillSample
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillSample extends Sample implements ISkillSample
{
    use THasFrequency;
    use THasDefinition;
    use THasClass;
    use TCanBeUsed;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.sample';
    }
}
