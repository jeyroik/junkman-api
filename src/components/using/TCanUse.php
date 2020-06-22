<?php
namespace junkman\components\using;

use extas\interfaces\IItem;
use junkman\interfaces\using\ICanBeUsed;

/**
 * Trait TCanUse
 *
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

        /**
         * @var IItem $dispatcher
         */
        $dispatcher = $this->buildClassWithParameters();

        foreach ($actions as $action) {
            if (!$dispatcher->hasMethod($action) || !$canBeUsed->canBeUsedFor($this->getForAction($action))) {
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
     * @throws \Exception
     */
    public function useThis(ICanBeUsed &$canBeUsed, string $action, array $args): void
    {
        if ($this->hasMethod($action)) {
            $this->$action($canBeUsed, ...$args);
            $canBeUsed->useFor($this, $this->getForAction($action), $args);
        } else {
            throw new \Exception($this->getName() . ' can not ' . $action);
        }
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
