<?php
namespace junkman\components\plugins;

use extas\components\plugins\PluginInstallDefault;
use junkman\components\Junkman;
use junkman\interfaces\IJunkmanRepository;

/**
 * Class PluginInstallJunkmen
 *
 * @package junkman\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallJunkmen extends PluginInstallDefault
{
    protected string $selfSection = 'junkmen';
    protected string $selfName = 'junkman';
    protected string $selfRepositoryClass = IJunkmanRepository::class;
    protected string $selfUID = Junkman::FIELD__NAME;
    protected string $selfItemClass = Junkman::class;
}
