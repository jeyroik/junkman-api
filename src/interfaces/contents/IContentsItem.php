<?php
namespace junkman\interfaces\contents;

use extas\interfaces\IHasClass;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IHasValue;
use extas\interfaces\IItem;
use extas\interfaces\players\IHasPlayer;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\IHasDefinition;
use junkman\interfaces\IHasFrequency;
use junkman\interfaces\IHasSize;
use junkman\interfaces\IHasWeight;

/**
 * Interface IContentsItem
 *
 * @package junkman\interfaces\contents
 * @author jeyroik@gmail.com
 */
interface IContentsItem extends
    IItem,
    IHasDescription,
    IHasName,
    IHasClass,
    IHasSampleParameters,
    IHasSize,
    IHasWeight,
    IHasValue,
    IHasFrequency,
    IHasDefinition,
    IHasPlayer
{
    public const SUBJECT = 'junkman.contents.item';
}
