<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use junkman\interfaces\extensions\IExtensionStory;

/**
 * Class ExtensionStory
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionStory extends Extension implements IExtensionStory
{
    protected static array $episodes = [];
    protected static array $story = [
        'text' => '',
        'hash' => ''
    ];

    /**
     * @param array $episodes
     */
    public function tellStory(array $episodes): void
    {
        self::$episodes[] = array_merge(self::$episodes, $episodes);
    }

    /**
     * @return string
     */
    public function getStory(): string
    {
        return $this->buildStory();
    }

    /**
     * @return string
     */
    protected function buildStory(): string
    {
        if (!self::$story) {
            $this->compileStory();
        } else {
            $hash = $this->getStoryHash();

            if (self::$story['hash'] != $hash) {
                $this->resetStory();;

                return $this->buildStory();
            }
        }

        return self::$story['text'];
    }

    /**
     *
     */
    protected function resetStory(): void
    {
        self::$story = [
            'text' => '',
            'hash' => ''
        ];
    }

    /**
     * Compile story from episodes.
     */
    protected function compileStory(): void
    {
        $storyText = '';
        foreach (self::$episodes as $episode) {
            foreach ($this->getPluginsByStage('') as $plugin) {
                $plugin($storyText, $episode);
            }
        }

        self::$story['text'] = $storyText ?: implode("\n", self::$episodes);
        self::$story['hash'] = $this->getStoryHash();
    }

    /**
     * @return string
     */
    protected function getStoryHash()
    {
        return sha1(json_encode(self::$episodes));
    }
}
