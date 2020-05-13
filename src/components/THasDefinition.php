<?php
namespace junkman\components;

use junkman\interfaces\IHasDefinition;

/**
 * Trait THasDefinition
 *
 * @property array $config
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
trait THasDefinition
{
    /**
     * @return string
     */
    public function getDefinition(): string
    {
        return $this->config[IHasDefinition::FIELD__DEFINITION] ?? '';
    }

    /**
     * @param string $definition
     * @return $this
     */
    public function setDefinition(string $definition)
    {
        $this->config[IHasDefinition::FIELD__DEFINITION] = $definition;

        return $this;
    }
}
