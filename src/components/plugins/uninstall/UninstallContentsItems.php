<?php
namespace junkman\components\plugins\uninstall;

use extas\components\plugins\uninstall\UninstallSection;
use junkman\components\contents\ContentsItem;

/**
 * Class UninstallContentsItems
 *
 * @package junkman\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallContentsItems extends UninstallSection
{
    protected string $selfSection = 'junkman_items';
    protected string $selfName = 'junkman item';
    protected string $selfRepositoryClass = 'contentsItemRepository';
    protected string $selfUID = ContentsItem::FIELD__NAME;
    protected string $selfItemClass = ContentsItem::class;
}
