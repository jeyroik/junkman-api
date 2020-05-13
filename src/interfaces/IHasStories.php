<?php
namespace junkman\interfaces;

/**
 * Interface IHasAStories
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasStories
{
    /**
     * @param string $storyTag
     */
    public function tellRandomStory(string $storyTag): void;
}
