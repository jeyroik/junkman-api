<?php
namespace junkman\components\plugins\uninstall;

use extas\components\plugins\uninstall\UninstallSection;
use junkman\components\characteristics\Characteristic;

/**
 * Class UninstallCharacteristics
 *
 * @package junkman\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallCharacteristics extends UninstallSection
{
    protected string $selfSection = 'junkman_characteristics';
    protected string $selfName = 'junkman characteristic';
    protected string $selfRepositoryClass = 'characteristicRepository';
    protected string $selfUID = Characteristic::FIELD__NAME;
    protected string $selfItemClass = Characteristic::class;
}
