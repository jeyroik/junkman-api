<?php
namespace junkman\components\extensions;

use junkman\components\exceptions\ExceptionMissedCharacteristic;
use junkman\interfaces\characteristics\IHasCharacteristics;
use junkman\interfaces\extensions\IHasHealthRegeneration;

/**
 * Class HasHealthRegeneration
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class HasHealthRegeneration extends ExtensionCharacteristic implements IHasHealthRegeneration
{
    protected string $charName = self::CHAR__NAME;

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getCurrentHealthRegeneration(IHasCharacteristics $owner = null): int
    {
        return $this->getCurrent($owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incHealthRegeneration(int $increment, IHasCharacteristics $owner = null): int
    {
        return $this->incValue($increment, $owner);
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decHealthRegeneration(int $decrement, IHasCharacteristics $owner = null): int
    {
        return $this->decValue($decrement, $owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incMaxHealthRegeneration(int $increment, IHasCharacteristics $owner = null): int
    {
        return $this->incMax($increment, $owner);
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decMaxHealthRegeneration(int $decrement, IHasCharacteristics $owner = null): int
    {
        return $this->decMax($decrement, $owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getMaxHealthRegeneration(IHasCharacteristics $owner = null): int
    {
        return $this->getMax($owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getMinHealthRegeneration(IHasCharacteristics $owner = null): int
    {
        return $this->getMin($owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getLostHealthRegeneration(IHasCharacteristics $owner = null): int
    {
        return $this->getLost($owner);
    }
}
