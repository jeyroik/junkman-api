<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\characteristics\Characteristic;

/**
 * Class InstallCharacteristics
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallCharacteristics extends InstallSection
{
    protected string $selfSection = 'junkman_characteristics';
    protected string $selfName = 'junkman characteristic';
    protected string $selfRepositoryClass = 'characteristicRepository';
    protected string $selfUID = Characteristic::FIELD__NAME;
    protected string $selfItemClass = Characteristic::class;
}
