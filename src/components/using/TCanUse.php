<?php
namespace junkman\components\using;

use junkman\interfaces\using\ICanBeUsed;

/**
 * Trait TCanUse
 *
 * @method hasMethod(string $name): bool
 * @method buildClassWithParameters(array $parameters = [])
 *
 * @package junkman\components\using
 * @author jeyroik@gmail.com
 */
trait TCanUse
{
    /**
     * @param ICanBeUsed $canBeUsed
     * @param mixed ...$actions
     * @return bool
     */
    public function canUse(ICanBeUsed $canBeUsed, ...$actions): bool
    {
        $can = true;

        foreach ($actions as $action) {
            if (!$this->hasMethod($action) || !$canBeUsed->canBeUsedFor($this->getForAction($action))) {
                $can = false;
                break;
            }
        }

        return $can;
    }

    /**
     * @param ICanBeUsed $canBeUsed
     * @param string $action
     * @param array $args
     */
    public function useThis(ICanBeUsed &$canBeUsed, string $action, array $args): void
    {
        $dispatcher = $this->buildClassWithParameters($args);
        $dispatcher->$action($this, $canBeUsed);
        $canBeUsed->useFor($this, $this->getForAction($action), $args);
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getForAction(string $action): string
    {
        return 'for' . ucfirst($action);
    }
}