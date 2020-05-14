<?php
namespace junkman\interfaces\extensions\actions;

use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;

/**
 * Interface IActionJunkmanTake
 *
 * @package junkman\interfaces\extensions\actions
 * @author jeyroik@gmail.com
 */
interface IActionJunkmanTake
{
    /**
     * @param IContentsItem $item
     * @param IJunkman $from
     */
    public function take(IContentsItem $item, IJunkman $from): void;

    /**
     * @param IContentsItem $item
     * @param IJunkman $from
     */
    public function throw(IContentsItem $item, IJunkman $from): void;
}
