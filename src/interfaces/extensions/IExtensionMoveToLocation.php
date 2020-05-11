<?php
namespace junkman\interfaces\extensions;

use junkman\components\Junkman;
use junkman\interfaces\IJunkman;

/**
 * Interface IExtensionMoveToLocation
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IExtensionMoveToLocation
{
    /**
     * @param string $locationName
     * @return IJunkman
     * @throws \Exception
     */
    public function moveToLocation(string $locationName): IJunkman;
}
