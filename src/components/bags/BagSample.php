<?php
namespace junkman\components\bags;

use junkman\components\contents\ContentsItem;
use junkman\interfaces\bags\IBagSample;
use junkman\interfaces\contents\IContentsItem;

/**
 * Class BagSample
 *
 * @package junkman\components\bags
 * @author jeyroik@gmail.com
 */
class BagSample extends ContentsItem implements IBagSample
{
    /**
     * @return IContentsItem
     */
    public function getContents(): IContentsItem
    {
        return new ContentsItem($this->config[static::FIELD__CONTENTS] ?? []);
    }

    /**
     * @param IContentsItem $contents
     * @return $this|BagSample
     */
    public function setContents(IContentsItem $contents)
    {
        $this->config[static::FIELD__CONTENTS] = $contents;

        return $this;
    }

    /**
     * @param IContentsItem $item
     * @return $this|BagSample
     * @throws \Exception
     */
    public function addToContents(IContentsItem $item)
    {
        if (!$this->canBeAddedToContents($item)) {
            throw new \Exception('Not enough space for "' . $item->getTitle() . '"');
        }

        $items = $this->getContentsItems();
        $items[$item->getName()] = $item->__toArray();
        $this->addToWeight($item->getWeight());

        $this->incSizeOccupied($item->getSize());
        $this->setContentsItems($items);

        return $this;
    }

    /**
     * @param string $itemName
     * @return $this|BagSample
     */
    public function removeFromContents(string $itemName)
    {
        $items = $this->getContentsItems();

        if (!isset($items[$itemName])) {
            return $this;
        }

        $item = new ContentsItem($items[$itemName]);

        unset($items[$itemName]);
        $this->setContentsItems($items);
        $this->decSizeOccupied($item->getSize());

        return $this;
    }

    /**
     * @param IContentsItem $item
     * @return bool
     */
    public function canBeAddedToContents(IContentsItem $item): bool
    {
        $current = $this->getContents();
        $currFreeWeight = $current->getParameterValue(static::PARAM__WEIGHT_MAX) - $this->getWeight();

        return $current->isBiggerThan($item) && ($currFreeWeight >= $item->getWeight());
    }

    /**
     * @return array
     */
    protected function getContentsItems(): array
    {
        return $this->getContents()->getValue();
    }

    /**
     * @param array $items
     * @return $this|IBagSample
     */
    protected function setContentsItems(array $items): IBagSample
    {
        $current = $this->getContents();
        $current->setValue($items);
        $this->setContents($current);

        return $this;
    }
}
