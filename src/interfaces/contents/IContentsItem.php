<?php
namespace junkman\interfaces\contents;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IHasValue;
use extas\interfaces\IItem;
use extas\interfaces\players\IHasPlayer;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\IHasDefinition;
use junkman\interfaces\IHasFrequency;
use junkman\interfaces\IHasShape;
use junkman\interfaces\using\ICanBeUsed;
use junkman\interfaces\using\ICanUse;

/**
 * Interface IContentsItem
 *
 * @package junkman\interfaces\contents
 * @author jeyroik@gmail.com
 */
interface IContentsItem extends
    IItem,
    IDispatcherWrapper,
    IHasSampleParameters,
    IHasShape,
    IHasValue,
    IHasFrequency,
    IHasDefinition,
    IHasPlayer,
    ICanBeUsed,
    ICanUse
{
    public const SUBJECT = 'junkman.contents.item';

    public const FIELD__HASH = 'hash';

    /**
     * @return string
     */
    public function getHash(): string;

    /**
     * @param string $hash
     * @return IContentsItem
     */
    public function setHash(string $hash): IContentsItem;
}
