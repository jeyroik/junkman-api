<?php
namespace junkman\components\junkers;

use junkman\components\using\TCanBeUsed;
use junkman\components\using\TCanUse;
use junkman\interfaces\junkers\IJunkman;

/**
 * Class Junkman
 *
 * @package junkman\components\junkers
 * @author jeyroik@gmail.com
 */
class Junkman extends JunkmanSample implements IJunkman
{
    use TCanUse;
    use TCanBeUsed;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.self';
    }
}
