<?php
namespace junkman\components\contents\items;

use extas\components\Item;
use junkman\components\THasStories;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\contents\items\IItemDispatcher;
use junkman\interfaces\IJunkman;

/**
 * Class ItemDispatcher
 *
 * @method junkmanRepository()
 * @method contentsItemRepository()
 *
 * @package junkman\components\contents\items
 * @author jeyroik@gmail.com
 */
abstract class ItemDispatcher extends Item implements IItemDispatcher
{
    use THasStories;

    /**
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $args
     */
    public function __invoke(IJunkman &$junkman, IContentsItem $item, array $args = []): void
    {
        $action = $args['action'] ?? 'dispatch';
        if (method_exists($this, $action)) {
            $this->$action($junkman, $item, $args);
        }
        $this->junkmanRepository()->update($junkman);
        $this->contentsItemRepository()->update($item);
    }

    /**
     * Unknown/Default action
     *
     * @param IJunkman $junkman
     * @param IContentsItem $item
     * @param array $args
     */
    abstract protected function dispatch(IJunkman &$junkman, IContentsItem &$item, array $args = []): void;
}
