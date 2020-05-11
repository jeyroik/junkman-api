<?php
namespace junkman\interfaces\skills;

use junkman\interfaces\IJunkman;

/**
 * Interface IHasSkills
 *
 * @package junkman\interfaces\skills
 * @author jeyroik@gmail.com
 */
interface IHasSkills
{
    public const FIELD__SKILLS = 'skills';

    /**
     * @param ISkill $skill
     * @return $this
     */
    public function addSkill(ISkill $skill);

    /**
     * @param string $skillName
     * @return ISkill|null
     */
    public function getSkill(string $skillName): ?ISkill;

    /**
     * @param string $skillName
     * @return bool
     */
    public function hasSkill(string $skillName): bool;

    /**
     * @param string $skillName
     * @return $this
     */
    public function removeSkill(string $skillName);

    /**
     * @param array $skills
     * @return $this
     */
    public function addSkills(array $skills);

    /**
     * @param array $skillsNames
     * @return $this
     */
    public function removeSkills(array $skillsNames);
}
