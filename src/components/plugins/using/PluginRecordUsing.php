<?php
namespace junkman\components\plugins\using;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\stages\IStageCreateAfter;
use junkman\components\using\User;
use junkman\interfaces\using\ICanBeUsed;
use junkman\interfaces\using\ICanUse;

/**
 * Class PluginRecordUsing
 *
 * @method junkmanUsableRepository()
 * @method junkmanUserRepository()
 *
 * @package junkman\components\plugins\using
 * @author jeyroik@gmail.com
 */
class PluginRecordUsing extends Plugin implements IStageCreateAfter
{
    /**
     * @param IItem $createdItem
     * @param IItem $sourceItem
     * @param IRepository|null $repository
     */
    public function __invoke(IItem &$createdItem, IItem $sourceItem, IRepository $repository = null): void
    {
        if ($createdItem instanceof ICanUse) {
            $this->createICanUse($createdItem, $repository);
        }

        if ($createdItem instanceof ICanBeUsed) {
            $this->createICanBeUsed($createdItem, $repository);
        }
    }

    /**
     * @param IItem $createdItem
     * @param IRepository|null $repository
     */
    protected function createICanUse(IItem &$createdItem, IRepository $repository = null): void
    {
        $this->create($this->junkmanUserRepository(), $createdItem, $repository);
    }

    /**
     * @param IItem $createdItem
     * @param IRepository|null $repository
     */
    protected function createICanBeUsed(IItem &$createdItem, IRepository $repository = null): void
    {
        $this->create($this->junkmanUsableRepository(), $createdItem, $repository);
    }

    /**
     * @param IRepository $store
     * @param IItem $item
     * @param IRepository $itemRepository
     */
    protected function create(IRepository $store, IItem $item, IRepository $itemRepository): void
    {
        $store->create(new User([
            User::FIELD__ID => '@uuid6',
            User::FIELD__NAME => $item->getName(),
            User::FIELD__REPOSITORY_CLASS => get_class($itemRepository)
        ]));
    }
}