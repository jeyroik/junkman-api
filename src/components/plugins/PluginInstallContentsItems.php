<?php
namespace junkman\components\plugins;

use extas\components\plugins\PluginInstallDefault;
use junkman\components\contents\ContentsItem;
use junkman\interfaces\contents\IContentsItemRepository;

/**
 * Class PluginInstallContentsItems
 *
 * @package junkman\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallContentsItems extends PluginInstallDefault
{
    protected string $selfSection = 'junkman_items';
    protected string $selfName = 'junkman item';
    protected string $selfRepositoryClass = IContentsItemRepository::class;
    protected string $selfUID = ContentsItem::FIELD__NAME;
    protected string $selfItemClass = ContentsItem::class;
}
