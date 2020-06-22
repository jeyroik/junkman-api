<?php
namespace junkman\components\plugins\install;

use extas\components\plugins\install\InstallSection;
use junkman\components\Junkman;

/**
 * Class InstallJunkers
 *
 * @package junkman\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallJunkers extends InstallSection
{
    protected string $selfSection = 'junkers';
    protected string $selfName = 'junkman';
    protected string $selfRepositoryClass = 'junkmanRepository';
    protected string $selfUID = Junkman::FIELD__NAME;
    protected string $selfItemClass = Junkman::class;
}
