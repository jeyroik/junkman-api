<?php
namespace junkman\components;

use extas\components\Replace;

/**
 * Trait THasAStories
 *
 * @property array $stories
 * @method tellStory(array $episodes)
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
trait THasStories
{
    /**
     * @param string $storyTag
     * @param array $replaces
     */
    public function tellRandomStory(string $storyTag, array $replaces = []): void
    {
        $story = $this->getStoryOnOf($storyTag);
        $realStory = Replace::please()->apply($replaces)->to($story);
        $this->tellStory($realStory);
    }

    /**
     * @param string $storyTag
     * @return mixed|string
     */
    protected function getStoryOnOf(string $storyTag): array
    {
        $byTag = $this->stories[$storyTag] ?? ['Missed story tag "' . $storyTag . '"'];
        $byTagMax = count($byTag)-1;
        $index = mt_rand(0, $byTagMax);
        $story = $byTag[$index];

        return is_array($story) ? $story : [$story];
    }
}
