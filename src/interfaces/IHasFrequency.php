<?php
namespace junkman\interfaces;

/**
 * Interface IHasFrequency
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasFrequency
{
    public const FIELD__FREQUENCY = 'frequency';

    /**
     * @return array
     */
    public function getFrequency(): array;

    /**
     * @param array $frequency
     * @return $this
     */
    public function setFrequency(array $frequency);
}
