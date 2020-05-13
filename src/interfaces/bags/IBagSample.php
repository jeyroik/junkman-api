<?php
namespace junkman\interfaces\bags;

use junkman\interfaces\contents\IContentsItem;

/**
 * Interface IBagSample
 *
 * @package junkman\interfaces\bags
 * @author jeyroik@gmail.com
 */
interface IBagSample extends IContentsItem
{
    public const FIELD__CONTENTS = 'contents';

    public const PARAM__WEIGHT_MAX = 'weight_max';

    public const PARAM__WEARING_METHOD = 'wearing_method';

    /**
     * @return IContentsItem
     */
    public function getContents(): IContentsItem;

    /**
     * @param IContentsItem $contents
     * @return $this
     */
    public function setContents(IContentsItem $contents);

    /**
     * @param IContentsItem $item
     * @return $this
     */
    public function addToContents(IContentsItem $item);

    /**
     * @param string $itemName
     * @return $this
     */
    public function removeFromContents(string $itemName);

    /**
     * @param IContentsItem $item
     * @return bool
     */
    public function canBeAddedToContents(IContentsItem $item): bool;
}
