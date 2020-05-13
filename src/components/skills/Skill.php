<?php
namespace junkman\components\skills;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasClass;
use extas\components\THasDescription;
use extas\components\THasName;
use junkman\components\THasDefinition;
use junkman\components\THasFrequency;
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
class Skill extends Item implements ISkill
{
    use THasName;
    use THasDescription;
    use THasClass;
    use THasSampleParameters;
    use THasFrequency;
    use THasDefinition;

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
        return static::SUBJECT;
    }
}
