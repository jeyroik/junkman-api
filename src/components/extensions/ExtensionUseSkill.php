<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use junkman\components\skills\Skill;
use junkman\interfaces\extensions\IExtensionUseSkill;
use junkman\interfaces\IJunkman;
use junkman\interfaces\skills\IHasSkills;
use junkman\interfaces\stages\IStageJunkmanUseSkill;

/**
 * Class ExtensionUseSkill
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionUseSkill extends Extension implements IExtensionUseSkill
{
    /**
     * @param string $skillName
     * @param IJunkman|null $junkman
     * @param array $args
     * @param IJunkman|null $owner
     */
    public function useSkill(
        string $skillName,
        ?IJunkman &$junkman = null,
        array $args = [],
        IJunkman &$owner = null
    ): void
    {
        if ($owner->hasSkill($skillName)) {
            $skill = $owner->getSkill($skillName);
            $owner->use($skill, IStageJunkmanUseSkill::NAME__SUFFIX, $junkman, $args);

            $stage = IStageJunkmanUseSkill::NAME__PREFIX . IStageJunkmanUseSkill::NAME__SUFFIX . '.' . $skillName;
            foreach ($this->getPluginsByStage($stage) as $plugin) {
                /**
                 * @var IStageJunkmanUseSkill $plugin
                 */
                $plugin($owner, $skill, $junkman, $args);
            }
        }
    }
}
