<?php
namespace junkman\components\junkers;

use extas\components\samples\Sample;
use extas\components\THasClass;
use junkman\components\characteristics\THasCharacteristics;
use junkman\components\contents\THasContentsItems;
use junkman\components\skills\THasSkills;
use junkman\interfaces\junkers\IJunkmanSample;

/**
 * Class JunkmanSample
 *
 * @package junkman\components\junkers
 * @author jeyroik@gmail.com
 */
class JunkmanSample extends Sample implements IJunkmanSample
{
    use THasClass;
    use THasSkills;
    use THasContentsItems;
    use THasCharacteristics;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.sample';
    }
}
