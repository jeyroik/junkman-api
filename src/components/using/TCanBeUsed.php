<?php
namespace junkman\components\using;

use junkman\interfaces\using\ICanUse;

/**
 * Trait TCanBeUsed
 *
 * @method hasMethod(string $name): bool
 * @method buildClassWithParameters(array $parameters = [])
 *
 * @package junkman\components\using
 * @author jeyroik@gmail.com
 */
trait TCanBeUsed
{
    /**
     * @param ICanUse $byWhom
     * @param string $action
     * @param array $args
     */
    public function useFor(ICanUse &$byWhom, string $action, array $args): void
    {
        $dispatcher = $this->buildClassWithParameters($args);
        $dispatcher->$action($this, $byWhom);
    }

    /**
     * @param mixed ...$actions
     * @return bool
     */
    public function canBeUsedFor(...$actions): bool
    {
        $can = true;

        foreach ($actions as $action) {
            if (!$this->hasMethod($action)) {
                $can = false;
                break;
            }
        }

        return $can;
    }
}
