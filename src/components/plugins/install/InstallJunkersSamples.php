<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\junkers\Junkman;

/**
 * Class InstallJunkersSamples
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallJunkersSamples extends InstallSection
{
    protected string $selfSection = 'junkers_samples';
    protected string $selfName = 'junkman sample';
    protected string $selfRepositoryClass = 'junkmanRepository';
    protected string $selfUID = Junkman::FIELD__NAME;
    protected string $selfItemClass = Junkman::class;
}
