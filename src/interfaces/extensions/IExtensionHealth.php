<?php
namespace junkman\interfaces\extensions;

use junkman\interfaces\IJunkman;

/**
 * Interface IExtensionIsDead
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IExtensionHealth
{
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
    public function getCurrentHealthRegeneration(): int;

    /**
     * @return int
     */
    public function getLostHealth(): int;

    /**
     * @param int $increment
     * @return IJunkman
     */
    public function incHealth(int $increment): IJunkman;

    /**
     * @param int $decrement
     * @return IJunkman
     */
    public function decHealth(int $decrement): IJunkman;

    /**
     * @param int $increment
     * @return IJunkman
     */
    public function incMaxHealth(int $increment): IJunkman;

    /**
     * @param int $decrement
     * @return IJunkman
     */
    public function decMaxHealth(int $decrement): IJunkman;

    /**
     * @param int $increment
     * @return IJunkman
     */
    public function incHealthRegeneration(int $increment): IJunkman;

    /**
     * @param int $decrement
     * @return IJunkman
     */
    public function decHealthRegeneration(int $decrement): IJunkman;
}
