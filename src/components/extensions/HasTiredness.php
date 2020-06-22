<?php
namespace junkman\components\extensions;

use junkman\components\exceptions\ExceptionMissedCharacteristic;
use junkman\interfaces\characteristics\IHasCharacteristics;
use junkman\interfaces\extensions\IHasTiredness;

/**
 * Class HasTiredness
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class HasTiredness extends ExtensionCharacteristic implements IHasTiredness
{
    protected string $charName = self::CHAR__NAME;

    /**
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function getCurrentTiredness(IHasCharacteristics $owner = null): int
    {
        return $this->getCurrent($owner);
    }

    /**
     * @param int $increment
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function incTiredness(int $increment, IHasCharacteristics $owner = null): int
    {
        return $this->incValue($increment, $owner);
    }

    /**
     * @param int $decrement
     * @param IHasCharacteristics|null $owner
     * @return int
     * @throws ExceptionMissedCharacteristic
     */
    public function decTiredness(int $decrement, IHasCharacteristics $owner = null): int
    {
        return $this->decValue($decrement, $owner);
    }
}
