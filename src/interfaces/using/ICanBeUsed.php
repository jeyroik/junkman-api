<?php
namespace junkman\interfaces\using;

/**
 * Interface ICanBeUsed
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface ICanBeUsed
{
    /**
     * @param ICanUse $byWhom
     * @param string $action
     * @param array $args
     */
    public function useFor(ICanUse &$byWhom, string $action, array $args): void;

    /**
     * @param mixed ...$actions
     * @return bool
     */
    public function canBeUsedFor(...$actions): bool;
}
