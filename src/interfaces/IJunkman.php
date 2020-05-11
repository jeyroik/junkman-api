<?php
namespace junkman\interfaces;

use extas\interfaces\players\IPlayer;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\skills\ISkill;

/**
 * Interface IJunkman
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IJunkman extends IPlayer, IHasSampleParameters
{
    public const SUBJECT = 'junkman.self';

    public const FIELD__SKILLS = 'skills';
    public const FIELD__HEALTH = 'health';
    public const FIELD__HEALTH_MAX = 'health_max';
    public const FIELD__HEALTH_REGENERATION = 'health_regeneration';
    public const FIELD__ATTACK = 'attack';
    public const FIELD__ATTACK_SPEED = 'attack_speed';
    public const FIELD__DEFENSE = 'defense';
    public const FIELD__DEFENSE_MAX = 'defense_max';
    public const FIELD__MOVE = 'move';
    public const FIELD__MOVE_SPEED = 'move_speed';
    public const FIELD__CRITICAL_CHANCE = 'critical_chance';
    public const FIELD__CRITICAL_MULTIPLE = 'critical_multiple';

    /**
     * @param ISkill $skill
     * @return IJunkman
     */
    public function addSkill(ISkill $skill): IJunkman;

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
     * @return IJunkman
     */
    public function removeSkill(string $skillName): IJunkman;

    /**
     * @param array $skills
     * @return IJunkman
     */
    public function addSkills(array $skills): IJunkman;

    /**
     * @param array $skillsNames
     * @return IJunkman
     */
    public function removeSkills(array $skillsNames): IJunkman;

    /**
     * @param string $skillName
     * @param IJunkman|null $enemy
     * @param array $args
     */
    public function useSkill(string $skillName, ?IJunkman &$enemy = null, array $args = []): void;

    /**
     * @param string $name
     * @param int $increment
     * @param null $default
     * @return IJunkman
     */
    public function incProperty(string $name, int $increment, $default = null): IJunkman;

    /**
     * @param string $name
     * @param int $decrement
     * @param null $default
     * @return IJunkman
     */
    public function decProperty(string $name, int $decrement, $default = null): IJunkman;

    /**
     * @return bool
     */
    public function isDead(): bool;
}
