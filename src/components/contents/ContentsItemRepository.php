<?php
namespace junkman\components\contents;

use extas\components\repositories\Repository;
use junkman\interfaces\contents\IContentsItemRepository;

/**
 * Class ContentsItemRepository
 *
 * @package junkman\components\contents
 * @author jeyroik@gmail.com
 */
class ContentsItemRepository extends Repository implements IContentsItemRepository
{
    protected string $name = 'contents_items';
    protected string $scope = 'junkman';
    protected string $pk = ContentsItem::FIELD__NAME;
    protected string $itemClass = ContentsItem::class;
}
