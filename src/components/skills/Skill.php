<?php
namespace junkman\components\skills;

use extas\components\players\THasPlayer;
use extas\components\samples\THasSample;
use junkman\components\using\TCanUse;
use junkman\interfaces\skills\ISkill;

/**
 * Class Skill
 *
 * @jsonrpc_method create
 * @jsonrpc_method index
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class Skill extends SkillSample implements ISkill
{
    use THasSample;
    use TCanUse;
    use THasPlayer;

    /**
     * @return string
     */
    public function getDefinition(): string
    {
        return $this->config[static::FIELD__DEFINITION] ?? '';
    }

    /**
     * @return array
     */
    public function getFrequency(): array
    {
        return $this->config[static::FIELD__FREQUENCY] ?? [];
    }

    /**
     * @return bool
     */
    public function canDamageAnother(): bool
    {
        return $this->config[static::FIELD__CAN_DAMAGE_ANOTHER] ?? false;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill';
    }
}
