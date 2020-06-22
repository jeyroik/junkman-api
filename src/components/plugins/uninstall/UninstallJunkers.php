<?php
namespace junkman\components\plugins\uninstall;

use extas\components\plugins\uninstall\UninstallSection;
use junkman\components\Junkman;

/**
 * Class UninstallJunkers
 *
 * @package junkman\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallJunkers extends UninstallSection
{
    protected string $selfSection = 'junkers';
    protected string $selfName = 'junkman';
    protected string $selfRepositoryClass = 'junkmanRepository';
    protected string $selfUID = Junkman::FIELD__NAME;
    protected string $selfItemClass = Junkman::class;
}
