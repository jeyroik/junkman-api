<?php
namespace junkman\components\contents;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasClass;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasValue;
use junkman\components\THasDefinition;
use junkman\components\THasFrequency;
use junkman\components\THasSize;
use junkman\components\THasWeight;
use junkman\interfaces\contents\IContentsItem;

/**
 * Class ContentsItem
 *
 * @jsonrpc_method create
 * @jsonrpc_method index
 *
 * @method incSizeOccupied(array $size)
 * @method decSizeOccupied(array $size)
 *
 * @package junkman\components\contents
 * @author jeyroik@gmail.com
 */
class ContentsItem extends Item implements IContentsItem
{
    use THasName;
    use THasClass;
    use THasDescription;
    use THasSize;
    use THasWeight;
    use THasSampleParameters;
    use THasValue;
    use THasFrequency;
    use THasDefinition;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
