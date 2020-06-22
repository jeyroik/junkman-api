<?php
namespace junkman\interfaces\extensions;

/**
 * Interface IHasHealth
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IHasHealth
{
    public const CHAR__NAME = 'health';

    /**
     * @return bool
     */
    public function isDead(): bool;

    /**
     * @return int
     */
    public function getCurrentHealth(): int;

    /**
     * @return int
     */
    public function getMaxHealth(): int;

    /**
     * @return int
     */
    public function getMinHealth(): int;

    /**
     * @return int
     */
    public function getLostHealth(): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incHealth(int $increment): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decHealth(int $decrement): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incMaxHealth(int $increment): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decMaxHealth(int $decrement): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incMinHealth(int $increment): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decMinHealth(int $decrement): int;
}
