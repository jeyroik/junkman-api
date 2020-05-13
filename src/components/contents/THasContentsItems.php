<?php
namespace junkman\components\contents;

use extas\interfaces\IHasClass;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\contents\IHasContentsItems as I;

/**
 * Trait THasContentsItems
 * 
 * @property array $config
 * @method contentsItemRepository()
 * @method getPluginsByStage(string $stage)
 * @method getSubjectForExtension(): string
 * @method use(IHasClass $subject, string $stageSuffix, ...$args): void
 * 
 * @package junkman\components\contents
 * @author jeyroik@gmail.com
 */
trait THasContentsItems
{
    /**
     * @return bool
     */
    public function hasSpaceForContentsItem(): bool
    {
        $items = $this->config[I::FIELD__CONTENTS_ITEMS] ?? [];
        $max = $this->config[I::FIELD__CONTENTS_ITEMS_MAX] ?? 0;

        return $max > count($items);
    }

    /**
     * @param IContentsItem $item
     * @return $this
     */
    public function addContentsItem(IContentsItem $item)
    {
        $this->config[I::FIELD__CONTENTS_ITEMS] = $this->config[I::FIELD__CONTENTS_ITEMS] ?? [];
        $this->config[I::FIELD__CONTENTS_ITEMS][] = $item->getName();

        foreach ($this->getPluginsByStage($this->getSubjectForExtension() . '.contents.item.added') as $plugin) {
            $plugin($this, $item);
        }

        return $this;
    }

    public function getContentsItem(string $itemName): ?IContentsItem
    {
        if ($this->hasContentsItem($itemName)) {
            return $this->contentsItemRepository()->one([IContentsItem::FIELD__NAME => $itemName]);
        }

        return null;
    }

    /**
     * @return IContentsItem[]
     */
    public function getContentsItems(): array
    {
        $itemsNames = $this->config[I::FIELD__CONTENTS_ITEMS] ?? [];
        return $this->contentsItemRepository()->all([IContentsItem::FIELD__NAME => $itemsNames]);
    }

    /**
     * @param array $items
     * @return $this
     */
    public function addContentsItems(array $items)
    {
        foreach ($items as $item) {
            $this->addContentsItem($item);
        }

        return $this;
    }

    /**
     * @param string $itemName
     * @return bool
     */
    public function hasContentsItem(string $itemName): bool
    {
        $items = $this->config[I::FIELD__CONTENTS_ITEMS] ?? [];

        return in_array($itemName, $items);
    }

    /**
     * @param string $itemName
     * @return $this
     */
    public function removeContentsItem(string $itemName)
    {
        if ($this->hasContentsItem($itemName)) {
            $items = $this->config[I::FIELD__CONTENTS_ITEMS] ?? [];
            $byName = array_flip($items);
            unset($byName[$itemName]);
            $this->config[I::FIELD__CONTENTS_ITEMS] = array_keys($byName);

            $stage = $this->getSubjectForExtension() . '.contents.item.removed';
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($this, $itemName);
            }

            $stage = $this->getSubjectForExtension() . '.contents.item.removed.' . $itemName;
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                $plugin($this, $itemName);
            }
        }

        return $this;
    }

    /**
     * @param array $itemsNames
     * @return $this
     */
    public function removeContentsItems(array $itemsNames)
    {
        foreach ($itemsNames as $itemName) {
            $this->removeContentsItem($itemName);
        }

        return $this;
    }
}
