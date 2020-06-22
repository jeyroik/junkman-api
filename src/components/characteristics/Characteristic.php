<?php
namespace junkman\components\characteristics;

use extas\components\players\THasPlayer;
use extas\components\samples\THasSample;
use junkman\interfaces\characteristics\ICharacteristic;

/**
 * Class Characteristic
 *
 * @package junkman\components\characteristics
 * @author jeyroik@gmail.com
 */
class Characteristic extends CharacteristicSample implements ICharacteristic
{
    use THasSample;
    use THasPlayer;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.characteristic';
    }
}
