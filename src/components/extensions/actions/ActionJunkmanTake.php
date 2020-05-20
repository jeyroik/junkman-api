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
        if ($from->getLocation()->getName() != $to->getLocation()->getName()) {
            $this->tellRandomStory('throw_far');
        } else {
            if ($to->hasSpaceForContentsItem()) {
                $dispatcher = $item->buildClassWithParameters();

                if ($from->hasContentsItem($item->getName())) {
                    $from->removeContentsItem($item->getName());
                    $dispatcher($from, $item, ['action' => 'lostBy', 'to' => $to]);
                    $to->addContentsItem($item);

                    $dispatcher($to, $item, ['action' => 'takenBy', 'from' => $from]);
                    $this->tellRandomStory('take_ok');
                } else {
                    $this->tellRandomStory('has_not');
                }
            } else {
                $this->tellRandomStory('take_fail');
            }
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
