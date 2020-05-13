<?php
namespace junkman\interfaces\contents;

/**
 * Interface IHasContentsItems
 *
 * @package junkman\interfaces\contents
 * @author jeyroik@gmail.com
 */
interface IHasContentsItems
{
    public const FIELD__CONTENTS_ITEMS = 'contents_items';
    public const FIELD__CONTENTS_ITEMS_MAX = 'contents_items_max';

    /**
     * @return bool
     */
    public function hasSpaceForContentsItem(): bool;

    /**
     * @param IContentsItem $item
     * @return $this
     */
    public function addContentsItem(IContentsItem $item);

    /**
     * @param array $items
     * @return $this
     */
    public function addContentsItems(array $items);

    /**
     * @param string $itemName
     * @return IContentsItem|null
     */
    public function getContentsItem(string $itemName): ?IContentsItem;

    /**
     * @return IContentsItem[]
     */
    public function getContentsItems(): array;

    /**
     * @param string $itemName
     * @return bool
     */
    public function hasContentsItem(string $itemName): bool;

    /**
     * @param string $itemName
     * @return $this
     */
    public function removeContentsItem(string $itemName);

    /**
     * @param array $itemsNames
     * @return $this
     */
    public function removeContentsItems(array $itemsNames);
}
