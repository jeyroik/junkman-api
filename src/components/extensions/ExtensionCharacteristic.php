<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use junkman\components\exceptions\ExceptionMissedCharacteristic;
use junkman\interfaces\characteristics\ICharacteristic;
use junkman\interfaces\characteristics\IHasCharacteristics;

/**
 * Class ExtensionCharacteristic
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionCharacteristic extends Extension
{
    protected string $charName = '';

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    protected function getCurrent(IHasCharacteristics $owner = null): int
    {
        return $this->getCharacteristic($owner)->getValue();
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    protected function getMax(IHasCharacteristics $owner = null): int
    {
        return $this->getCharacteristic($owner)->getMax();
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getMin(IHasCharacteristics $owner = null): int
    {
        return $this->getCharacteristic($owner)->getMin();
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getLost(IHasCharacteristics $owner = null): int
    {
        return $this->getMax($owner) - $this->getCurrent($owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incValue(int $increment, IHasCharacteristics $owner = null): int
    {
        $char = $this->getCharacteristic($owner);
        $char->incValue($increment);
        $owner->updateCharacteristic($char);

        return $char->getValue();
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incMin(int $increment, IHasCharacteristics $owner = null): int
    {
        $char = $this->getCharacteristic($owner);
        $char->incMin($increment);
        $owner->updateCharacteristic($char);

        return $char->getValue();
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decValue(int $decrement, IHasCharacteristics $owner = null): int
    {
        $char = $this->getCharacteristic($owner);
        $char->decValue($decrement);
        $owner->updateCharacteristic($char);

        return $char->getValue();
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decMin(int $decrement, IHasCharacteristics $owner = null): int
    {
        $char = $this->getCharacteristic($owner);
        $char->decMin($decrement);
        $owner->updateCharacteristic($char);

        return $char->getValue();
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incMax(int $increment, IHasCharacteristics $owner = null): int
    {
        $char = $this->getCharacteristic($owner);
        $char->incMax($increment);
        $owner->updateCharacteristic($char);

        return $char->getValue();
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decMax(int $decrement, IHasCharacteristics $owner = null): int
    {
        $char = $this->getCharacteristic($owner);
        $char->decMax($decrement);
        $owner->updateCharacteristic($char);

        return $char->getValue();
    }

    /**
     * @param IHasCharacteristics|null $owner
     * @return ICharacteristic
     * @throws ExceptionMissedCharacteristic
     */
    protected function getCharacteristic(IHasCharacteristics $owner = null): ICharacteristic
    {
        $char = $owner->getCharacteristic($this->charName);

        if (!$char) {
            throw new ExceptionMissedCharacteristic($this->charName);
        }

        return $char;
    }
}
