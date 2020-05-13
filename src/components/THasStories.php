<?php
namespace junkman\components;

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
     */
    public function tellRandomStory(string $storyTag): void
    {
        $this->tellStory($this->getStoryOnOf($storyTag));
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
