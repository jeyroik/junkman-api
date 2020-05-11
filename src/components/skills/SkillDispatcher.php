<?php
namespace junkman\components\skills;

use extas\components\Item;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\ISkillDispatcher;

/**
 * Class SkillDispatcher
 *
 * @method junkmanRepository()
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
abstract class SkillDispatcher extends Item implements ISkillDispatcher
{
    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    public function __invoke(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $this->dispatch($junkman, $enemy, $args);
        $this->setTiredness($junkman);
    }

    /**
     * @param IJunkman $junkman
     */
    protected function setTiredness(IJunkman &$junkman): void
    {
        if (!$this instanceof SkillTiredness) {
            $skill = new SkillTiredness();
            $skill->dispatch(
                $junkman,
                $junkman,
                [SkillTiredness::FIELD__COST => $this->getTirednessValue()]
            );
            $this->junkmanRepository()->update($junkman);
        }
    }

    /**
     * @return int
     */
    abstract protected function getTirednessValue(): int;

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    abstract protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void;
}
