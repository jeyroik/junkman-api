<?php
namespace junkman\components\skills;

use junkman\interfaces\IJunkman;
use junkman\interfaces\locations\ILocation;
use junkman\interfaces\skills\ISkill;

/**
 * Class SkillSearch
 *
 * @method skillRepository()
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

        /**
         * @var ISkill[] $skills
         */
        $skills = $this->skillRepository()->all(['frequency' => $rand]);
        foreach ($skills as $skill) {
            if (!$junkman->hasSkill($skill->getName())) {
                $junkman->addSkill($skill);
                $this->tellStory([
                    'Похоже, вы кое-что нашли и это ' . $skill->getTitle(),
                    'Вы решили рассмотреть находку поближе:',
                    $skill->getDescription()
                ]);
                $this->junkmanRepository()->update($junkman);
                break;
            }
        }
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
