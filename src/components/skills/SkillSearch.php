<?php
namespace junkman\components\skills;

use extas\interfaces\IHasDescription;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\skills\ISkill;
use junkman\interfaces\skills\ISkillDispatcher;
use junkman\interfaces\skills\ISkillSample;
use Ramsey\Uuid\Uuid;

/**
 * Class SkillSearch
 *
 * @method skillRepository()
 * @method skillSampleRepository()
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
    protected array $stories = [
        'empty' => [
            'Похоже, что здесь ничего нет, но можно ещё немного поискать...',
            'Пусто. Ещё одно бесполезное место...или бесполезный вы в этом месте.'
        ],
        'skill.found' => [
            'Что-то пробуждается внутри вас. Похоже, что это @skill.title.'
            . 'Если хочется развить это, то используйте заклинание @skill.name.',
            'Появилось ощущение, что вы можете узнать про @skill.title. Позовите это ощущение по имени @skill.name.'
        ]
    ];

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
     * @param IJunkman $junkman
     * @param int $rand
     * @return $this|ISkillDispatcher
     */
    protected function searchSkills(IJunkman &$junkman, int $rand): ISkillDispatcher
    {
        /**
         * @var ISkill[] $skills
         */
        $skills = $this->skillSampleRepository()->all([ISkillSample::FIELD__FREQUENCY => $rand]);
        foreach ($skills as $skill) {
            $this->tellRandomStory('skill.found', ['skill' => $skill]);
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
