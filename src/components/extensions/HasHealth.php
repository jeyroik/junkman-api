<?php
namespace junkman\components\extensions;

use junkman\components\exceptions\ExceptionMissedCharacteristic;
use junkman\interfaces\characteristics\IHasCharacteristics;
use junkman\interfaces\extensions\IHasHealth;

/**
 * Class HasHealth
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class HasHealth extends ExtensionCharacteristic implements IHasHealth
{
    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getCurrentHealth(IHasCharacteristics $owner = null): int
    {
        return $this->getCurrent($owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getMaxHealth(IHasCharacteristics $owner = null): int
    {
        return $this->getMax($owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getMinHealth(IHasCharacteristics $owner = null): int
    {
        return $this->getMin($owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getLostHealth(IHasCharacteristics $owner = null): int
    {
        return $this->getLost($owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incHealth(int $increment, IHasCharacteristics $owner = null): int
    {
        return $this->incValue($increment, $owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incMinHealth(int $increment, IHasCharacteristics $owner = null): int
    {
        return $this->incMin($increment, $owner);
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decHealth(int $decrement, IHasCharacteristics $owner = null): int
    {
        return $this->decValue($decrement, $owner);
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decMinHealth(int $decrement, IHasCharacteristics $owner = null): int
    {
        return $this->decMin($decrement, $owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incMaxHealth(int $increment, IHasCharacteristics $owner = null): int
    {
        return $this->incMax($increment, $owner);
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decMaxHealth(int $decrement, IHasCharacteristics $owner = null): int
    {
        return $this->decMax($decrement, $owner);
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return bool
     * @throws ExceptionMissedCharacteristic
     */
    public function isDead(IHasCharacteristics $owner = null): bool
    {
        $health = $this->getCharacteristic($owner);
        return $health->getValue() == $health->getMin();
    }
}
