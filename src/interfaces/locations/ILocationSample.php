<?php
namespace junkman\interfaces\locations;

use junkman\interfaces\junkers\IJunkman;

/**
 * Interface ILocationSample
 *
 * @package junkman\interfaces\locations
 * @author jeyroik@gmail.com
 */
interface ILocationSample extends IJunkman
{
    public const PARAM__FREQUENCY_MIN = 'f_min';
    public const PARAM__FREQUENCY_MAX = 'f_max';

    /**
     * @return int
     */
    public function getFrequencyMin(): int;

    /**
     * @return int
     */
    public function getFrequencyMax(): int;

    /**
     * @param int $min
     * @return $this
     */
    public function setFrequencyMin(int $min);

    /**
     * @param int $max
     * @return $this
     */
    public function setFrequencyMax(int $max);
}
