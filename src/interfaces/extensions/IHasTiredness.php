<?php
namespace junkman\interfaces\extensions;

/**
 * Interface IHasTiredness
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IHasTiredness
{
    public const CHAR__NAME = 'tiredness';

    /**
     * @return int
     */
    public function getCurrentTiredness(): int;

    /**
     * @param int $increment
     * @return int
     */
    public function incTiredness(int $increment): int;

    /**
     * @param int $decrement
     * @return int
     */
    public function decTiredness(int $decrement): int;
}
