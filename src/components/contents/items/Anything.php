<?php
namespace junkman\components\contents\items;

use extas\components\plugins\Plugin;
use extas\interfaces\IHasDescription;
use junkman\components\THasStories;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\skills\ISkillDispatcher;
use junkman\interfaces\using\ICanUse;
use Ramsey\Uuid\Uuid;

/**
 * Class Anything
 *
 * @method contentsItemRepository()
 *
 * @package junkman\components\contents\items
 * @author jeyroik@gmail.com
 */
class Anything extends Plugin
{
    use THasStories;

    /**
     * @param IContentsItem $anything
     * @param ICanUse $owner
     * @throws \Exception
     */
    public function search(IContentsItem &$anything, ICanUse &$owner)
    {
        if (!$owner instanceof IJunkman) {
            throw new \Exception('Трудно этим* искать...');
        }

        $currentLocation = $owner->getLocation();

        $rand = mt_rand(
            $currentLocation->getParameterValue(ILocation::PARAM__FREQUENCY_MIN, 0),
            $currentLocation->getParameterValue(ILocation::PARAM__FREQUENCY_MAX, 100),
        );

        $this->searchItems($junkman, $rand);
    }

    /**
     * @param IJunkman $junkman
     * @param $rand
     * @return $this|ISkillDispatcher
     */
    protected function searchItems(IJunkman &$junkman, $rand): ISkillDispatcher
    {
        /**
         * @var IContentsItem $item
         */
        $item = $this->contentsItemRepository()->one([
            IContentsItem::FIELD__FREQUENCY => $rand,
            IContentsItem::FIELD__PLAYER_NAME => ''
        ]);

        if (empty($item)) {
            $this->tellRandomStory('empty');
        } else {
            $item->setPlayerName($junkman->getLocation()->getName());
            $item->setHash(Uuid::uuid6());
            $this->contentsItemRepository()->update($item);

            $this->tellStory($this->getSearchStory($item));
            $this->tellStory(['Чтобы подобрать эту вещицу, используйте её особый признак: ' . $item->getHash()]);
        }

        return $this;
    }

    /**
     * @param IHasDescription $item
     * @return array
     */
    protected function getSearchStory(IHasDescription $item): array
    {
        return [
            'Похоже, вы кое-что нашли и это ' . $item->getTitle(),
            'Вы решили рассмотреть находку поближе:',
            $item->getDescription()
        ];
    }
}
