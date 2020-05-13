<?php
namespace junkman\interfaces\contents\items;

use extas\interfaces\IItem;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IHasStories;
use junkman\interfaces\IJunkman;

/**
 * Interface IItemDispatcher
 *
 * @package junkman\interfaces\contents\items
 * @author jeyroik@gmail.com
 */
interface IItemDispatcher extends IItem, IHasStories
{
    /**
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $args
     */
    public function __invoke(IJunkman &$junkman, IContentsItem $item, array $args = []): void;
}
