<?php
namespace junkman\interfaces\characteristics;

use extas\interfaces\IHasTags;
use extas\interfaces\IHasValue;
use extas\interfaces\samples\ISample;

/**
 * Interface ICharacteristicSample
 *
 * @package junkman\interfaces\characteristics
 * @author jeyroik@gmail.com
 */
interface ICharacteristicSample extends ISample, IHasTags, IHasValue
{
    public const FIELD__MAX = 'max';
    public const FIELD__MIN = 'min';

    /**
     * @return int
     */
    public function getMax(): int;

    /**
     * @return int
     */
    public function getMin(): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incMax(int $increment): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incMin(int $increment): int;

    /**
     * @param int $increment
     * @return int
     */
    public function incValue(int $increment): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decMax(int $decrement): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decMin(int $decrement): int;

    /**
     * @param int $decrement
     * @return int
     */
    public function decValue(int $decrement): int;

    /**
     * @param int $max
     * @return $this
     */
    public function setMax(int $max);

    /**
     * @param int $min
     * @return $this
     */
    public function setMin(int $min);
}
