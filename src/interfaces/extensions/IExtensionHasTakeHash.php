<?php
namespace junkman\interfaces\extensions;

/**
 * Interface IExtensionHasTakeHash
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IExtensionHasTakeHash
{
    public const FIELD__TAKE_HASH = 'take_hash';

    /**
     * @return string
     */
    public function getTakeHash(): string;

    /**
     * @param string $hash
     * @return $this
     */
    public function setTakeHash(string $hash);
}
