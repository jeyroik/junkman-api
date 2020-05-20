<?php
namespace junkman\components\extensions\actions;

use extas\components\extensions\Extension;
use junkman\components\THasStories;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\extensions\actions\IActionJunkmanTake;
use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;

/**
 * Class ActionJunkmanTake
 *
 * @method
 *
 * @package junkman\components\extensions\actions
 * @author jeyroik@gmail.com
 */
class ActionJunkmanTake extends Extension implements IActionJunkmanTake
{
    use THasStories;

    protected array $stories = [
        'take_ok' => [
            'Вы подобрали вещицу.',
            'Получилось-таки захапать вещицу себе.'
        ],
        'take_fail' => [
            'Харе! Больше нет места для вещей.',
            'Воу-воу! Чем вы это нести собрались? Задницей что ли?',
            'Да-да, в зубах понесёте, как же.'
        ],
        'throw_far' => [
            'Далековато...подойдите поближе к цели.'
        ],
        'throw_self' => [
            'Вы, конечно, очень постарались попасть в Тиабалду, но всё равно промахнулись'
        ],
        'throw_another' => [
            'Странный способ выражать свои эмоции, но дело ваше...'
        ],
        'has_not' => [
            'Какая-то неправомерная передача вещи. Она точно находится по адресу?'
        ]
    ];

    /**
     * @param IContentsItem $item
     * @param IJunkman $from
     * @param IJunkman|null $to
     */
    public function take(IContentsItem $item, IJunkman $from, IJunkman &$to = null): void
    {
        try {
            $this->hasItem($from, $item);
            $this->isCloseEnough($from, $to);
            $this->hasEnoughSpace($to);

            $dispatcher = $item->buildClassWithParameters();
            $from->removeContentsItem($item->getName());
            $dispatcher($from, $item, ['action' => 'lostBy', 'to' => $to]);

            $to->addContentsItem($item);
            $dispatcher($to, $item, ['action' => 'takenBy', 'from' => $from]);

            $this->tellRandomStory('take_ok');
        } catch (\Exception $e) {

        }
    }

    /**
     * @param IJunkman $to
     * @throws \Exception
     */
    protected function hasEnoughSpace(IJunkman $to): void
    {
        if (!$to->hasSpaceForContentsItem()) {
            $this->tellRandomStory('take_fail');
            throw new \Exception('Has not enough space');
        }
    }

    /**
     * @param IJunkman $from
     * @param IContentsItem $item
     * @throws \Exception
     */
    protected function hasItem(IJunkman $from, IContentsItem $item): void
    {
        if (!$from->hasContentsItem($item->getName())) {
            $this->tellRandomStory('has_not');
            throw new \Exception('Has not item');
        }
    }

    /**
     * @param IJunkman $from
     * @param IJunkman $to
     * @throws \Exception
     */
    protected function isCloseEnough(IJunkman $from, IJunkman $to): void
    {
        if ($from->getLocation()->getName() != $to->getLocation()->getName()) {
            $this->tellRandomStory('throw_far');
            throw new \Exception('Too far');
        }
    }

    /**
     * @param IContentsItem $item
     * @param IJunkman $from
     * @param IJunkman|null|IExtensionHealth $junkman
     */
    public function throw(IContentsItem $item, IJunkman $from, IJunkman &$junkman = null): void
    {
        if ($junkman->hasContentsItem($item->getName())) {
            $junkman->removeContentsItem($item->getName());
            $dispatcher = $item->buildClassWithParameters([]);
            $dispatcher($junkman, $item, ['action' => 'thrownBy', 'from' => $from]);
        }

        if ($from->getLocation()->getName() != $junkman->getLocation()->getName()) {
            $this->tellRandomStory('throw_far');
        } else {
            if ($from->getName() == $junkman->getName()) {
                $this->tellRandomStory('throw_self');
            } else {
                $junkman->decHealth(1);
                $this->tellRandomStory('throw_another');
            }
        }
    }
}
