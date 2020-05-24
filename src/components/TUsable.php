<?php
namespace junkman\components;

use junkman\interfaces\IJunkman;

/**
 * Trait TUsable
 *
 * @method buildClassWithParameters(array $parameters = [])
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
trait TUsable
{
    /**
     * @param IJunkman $junkman
     * @param string $action
     * @param mixed ...$args
     */
    public function usedBy(IJunkman &$junkman, string $action, ...$args): void
    {
        $dispatcher = $this->buildClassWithParameters();

        if (method_exists($dispatcher, $action)) {
            $dispatcher->$action($junkman, $this, ...$args);
        }
    }

    /**
     * @param mixed ...$actions
     * @return bool
     */
    public function canBeUsedBy(...$actions): bool
    {
        $dispatcher = $this->buildClassWithParameters();
        $can = true;

        foreach ($actions as $action) {
            if (!method_exists($dispatcher, $action)) {
                $can = false;
                break;
            }
        }

        return $can;
    }
}
