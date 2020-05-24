<?php
namespace junkman\components\persons;

use extas\components\plugins\Plugin;
use extas\interfaces\IItem;
use junkman\components\THasStories;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\extensions\IExtensionHasTakeHash;
use junkman\interfaces\IJunkman;
use junkman\interfaces\using\ICanBeUsed;

/**
 * Class Unknown
 *
 * @package junkman\components\persons
 * @author jeyroik@gmail.com
 */
class Unknown extends Plugin
{
    use THasStories;

    protected array $stories = [
        'take_ok' => [
            'Вы подобрали вещицу.',
            'Получилось-таки захапать вещицу себе.'
        ],
        'take_fail' => [
            'Это нельзя взять. И голоса в голове прибавили: @wisp',
            'Ваши намерения под вопросом, убедитесь, что делаете всё правильно. А дальше вы подумали: @wisp'
        ],
        'throw_far' => [
            'Далековато...подойдите поближе к цели.'
        ]
    ];

    /**
     * @param ICanBeUsed $usable
     * @param IJunkman|null $to
     */
    public function take(IJunkman &$to, ICanBeUsed &$usable): void
    {
        try {
            $this->hasEnoughSpace($to);
            $this->canTake($usable);
            $this->addThis($usable, $to);
            $this->tellRandomStory('take_ok');
        } catch (\Exception $e) {
            $this->tellRandomStory('take_fail', ['wisp' => $e->getMessage()]);
        }
    }

    /**
     * @param ICanBeUsed|IItem $usable
     * @return bool
     * @throws \Exception
     */
    protected function canTake(ICanBeUsed $usable): bool
    {
        $hash = $this->getCurrentHash();

        if (!$usable->hasMethod('getTakeHash()')) {
            throw new \Exception('Эту вещь нельзя взять...');
        }

        if (!$hash || ($hash != $usable->getTakeHash())) {
            throw new \Exception('Вы что ли пытаетесь украсть что-то?');
        }

        return true;
    }

    /**
     * @param ICanBeUsed|IExtensionHasTakeHash $usable
     * @param IJunkman $junkman
     */
    protected function addThis(ICanBeUsed $usable, IJunkman &$junkman): void
    {
        if ($usable instanceof IContentsItem) {
            $usable->setTakeHash('');
            $junkman->addContentsItem($usable);
        } else {
            throw new \Exception('Без понятия, как это взять...');
        }
    }

    /**
     * @param IJunkman $to
     * @throws \Exception
     */
    protected function hasEnoughSpace(IJunkman $to): void
    {
        if (!$to->hasSpaceForContentsItem()) {
            throw new \Exception('Упс, а места больше нет.');
        }
    }

    /**
     * @return string
     */
    protected function getCurrentHash()
    {
        return $this->config[IExtensionHasTakeHash::FIELD__TAKE_HASH] ?? '';
    }
}
