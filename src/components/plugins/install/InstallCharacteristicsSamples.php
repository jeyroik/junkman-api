<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\characteristics\CharacteristicSample;

/**
 * Class InstallCharacteristicsSamples
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallCharacteristicsSamples extends InstallSection
{
    protected string $selfSection = 'junkman_characteristics_samples';
    protected string $selfName = 'junkman characteristic sample';
    protected string $selfRepositoryClass = 'characteristicSampleRepository';
    protected string $selfUID = CharacteristicSample::FIELD__NAME;
    protected string $selfItemClass = CharacteristicSample::class;
}
