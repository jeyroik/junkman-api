<?php
namespace junkman\components\contents;

use extas\components\Item;
use extas\components\players\THasPlayer;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\TDispatcherWrapper;
use extas\components\THasValue;
use junkman\components\THasDefinition;
use junkman\components\THasFrequency;
use junkman\components\THasSize;
use junkman\components\THasWeight;
use junkman\components\using\TCanBeUsed;
use junkman\components\using\TCanUse;
use junkman\interfaces\contents\IContentsItem;

/**
 * Class ContentsItem
 *
 * @jsonrpc_method create
 *
 * @method incSizeOccupied(array $size)
 * @method decSizeOccupied(array $size)
 *
 * @package junkman\components\contents
 * @author jeyroik@gmail.com
 */
class ContentsItem extends Item implements IContentsItem
{
    use TDispatcherWrapper;
    use THasSize;
    use THasWeight;
    use THasSampleParameters;
    use THasValue;
    use THasFrequency;
    use THasDefinition;
    use THasPlayer;
    use TCanUse;
    use TCanBeUsed;

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->config[static::FIELD__HASH] ?? '';
    }

    /**
     * @param string $hash
     * @return $this|IContentsItem
     */
    public function setHash(string $hash): IContentsItem
    {
        $this->config[static::FIELD__HASH] = $hash;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
