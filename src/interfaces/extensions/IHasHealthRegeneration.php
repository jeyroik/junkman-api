<?php
namespace junkman\interfaces\extensions;

/**
 * Interface IHasHealthRegeneration
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IHasHealthRegeneration
{
    public const CHAR__NAME = 'health_regeneration';

    /**
     * @return int
     */
    public function getCurrentHealthRegeneration(): int;

    /**
     * @return int
     */
    public function getMaxHealthRegeneration(): int;

    /**
     * @return int
     */
    public function getMinHealthRegeneration(): int;

    /**
     * @return int
     */
    public function getLostHealthRegeneration(): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incHealthRegeneration(int $increment): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decHealthRegeneration(int $decrement): int;

    /**
     * @param int $increment
     * @return int current value
     */
    public function incMaxHealthRegeneration(int $increment): int;

    /**
     * @param int $decrement
     * @return int current value
     */
    public function decMaxHealthRegeneration(int $decrement): int;
}
