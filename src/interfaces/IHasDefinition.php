<?php
namespace junkman\interfaces;

/**
 * Interface IHasDefinition
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasDefinition
{
    public const FIELD__DEFINITION = 'definition';

    /**
     * @return string
     */
    public function getDefinition(): string;

    /**
     * @param string $definition
     * @return $this
     */
    public function setDefinition(string $definition);
}
