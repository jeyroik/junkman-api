<?php
namespace junkman\interfaces\extensions;

/**
 * Interface IExtensionStory
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IHasStory
{
    /**
     * @param array $episodes
     */
    public function tellStory(array $episodes): void;

    /**
     * @return string
     */
    public function getStory(): string;
}
