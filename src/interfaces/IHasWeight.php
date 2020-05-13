<?php
namespace junkman\interfaces;

/**
 * Interface IHasWeight
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasWeight
{
    public const FIELD__WEIGHT = 'weight';

    /**
     * @return int
     */
    public function getWeight(): int;

    /**
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight);

    /**
     * @param int $weight
     * @return $this
     */
    public function addToWeight(int $weight);

    /**
     * @param int $weight
     * @return $this
     */
    public function removeFromWeight(int $weight);

    /**
     * @param IHasWeight $item
     * @return bool
     */
    public function isWeighsMoreThan(IHasWeight $item): bool;

    /**
     * @param IHasWeight $item
     * @return bool
     */
    public function isWeighsLessThan(IHasWeight $item): bool;

    /**
     * @param int $weight
     * @return int -1 less than $weight, 0 equals, 1 bigger than $weight
     */
    public function compareWeightWith(int $weight): int;
}
