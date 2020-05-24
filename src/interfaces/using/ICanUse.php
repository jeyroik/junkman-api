<?php
namespace junkman\interfaces\using;

/**
 * Interface ICanUse
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface ICanUse
{
    /**
     * @param ICanBeUsed $canBeUsed
     * @param mixed ...$actions
     * @return bool
     */
    public function canUse(ICanBeUsed $canBeUsed, ...$actions): bool;

    /**
     * @param ICanBeUsed $canBeUsed
     * @param string $action
     * @param array $args
     */
    public function useThis(ICanBeUsed &$canBeUsed, string $action, array $args): void;
}
