<?php
namespace junkman\components\skills;

use extas\interfaces\IHasDescription;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\skills\ISkill;
use junkman\interfaces\skills\ISkillDispatcher;

/**
 * Class SkillSearch
 *
 * @method skillRepository()
 * @method contentsItemRepository()
 * @method junkmanRepository()
 * @method tellStory(array $episodes)
 *
 * @package junkman\components\skills
 * @author jeyroik@gmail.com
 */
class SkillSearch extends SkillDispatcher
{
    public const NAME = 'search';

    /**
     * @param IJunkman $junkman
     * @param IJunkman|null $enemy
     * @param array $args
     */
    protected function dispatch(IJunkman &$junkman, ?IJunkman &$enemy, array $args = []): void
    {
        $currentLocation = $junkman->getLocation();

        $rand = mt_rand(
            $currentLocation->getParameterValue(ILocation::PARAM__FREQUENCY_MIN, 0),
            $currentLocation->getParameterValue(ILocation::PARAM__FREQUENCY_MAX, 100),
        );

        $this
            ->searchSkills($junkman, $rand)
            ->searchItems($junkman, $rand);
    }

    /**
     * @param IJunkman $junkman
     * @param $rand
     * @return $this|ISkillDispatcher
     */
    protected function searchItems(IJunkman &$junkman, $rand): ISkillDispatcher
    {
        if (!$junkman->hasSpaceForContentsItem()) {
            return $this;
        }

        /**
         * @var IContentsItem[] $items
         */
        $items = $this->contentsItemRepository()->all(['frequency' => $rand]);
        foreach ($items as $item) {
            $this->tellStory($this->getSearchStory($item));
            $this->tellStory(['Чтобы подобрать эту вещицу, используйте её особый признак: ' . $item->getName()]);
            break;
        }

        return $this;
    }

    /**
     * @param IJunkman $junkman
     * @param int $rand
     * @return $this|ISkillDispatcher
     */
    protected function searchSkills(IJunkman &$junkman, int $rand): ISkillDispatcher
    {
        /**
         * @var ISkill[] $skills
         */
        $skills = $this->skillRepository()->all(['frequency' => $rand]);
        foreach ($skills as $skill) {
            if (!$junkman->hasSkill($skill->getName())) {
                $junkman->addSkill($skill);
                $this->tellStory($this->getSearchStory($skill));
                $this->junkmanRepository()->update($junkman);
                break;
            }
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

    /**
     * @return int
     */
    protected function getTirednessValue(): int
    {
        return 3;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.skill.search';
    }
}
