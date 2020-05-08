<?php
namespace junkman\components\skills;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasClass;
use extas\components\THasDescription;
use extas\components\THasName;
use junkman\interfaces\skills\ISkill;

/**
 * Class Skill
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class Skill extends Item implements ISkill
{
    use THasName;
    use THasDescription;
    use THasClass;
    use THasSampleParameters;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
