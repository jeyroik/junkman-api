<?php
namespace junkman\interfaces\characteristics;

use extas\interfaces\players\IHasPlayer;
use extas\interfaces\samples\IHasSample;

/**
 * Interface ICharacteristic
 *
 * @package junkman\interfaces\characteristics
 * @author jeyroik@gmail.com
 */
interface ICharacteristic extends ICharacteristicSample, IHasSample, IHasPlayer
{

}
