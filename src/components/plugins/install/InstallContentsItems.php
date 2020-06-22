<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\contents\ContentsItem;

/**
 * Class InstallContentsItems
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallContentsItems extends InstallSection
{
    protected string $selfSection = 'junkman_items';
    protected string $selfName = 'junkman item';
    protected string $selfRepositoryClass = 'contentsItemRepository';
    protected string $selfUID = ContentsItem::FIELD__NAME;
    protected string $selfItemClass = ContentsItem::class;
}
