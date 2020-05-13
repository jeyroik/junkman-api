<?php
namespace junkman\components;

use junkman\interfaces\IHasFrequency;

/**
 * Trait THasFrequency
 *
 * @property array $config
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
trait THasFrequency
{
    /**
     * @return array
     */
    public function getFrequency(): array
    {
        return $this->config[IHasFrequency::FIELD__FREQUENCY] ?? [];
    }

    /**
     * @param array $frequency
     * @return $this
     */
    public function setFrequency(array $frequency)
    {
        $this->config[IHasFrequency::FIELD__FREQUENCY] = $frequency;

        return $this;
    }
}
