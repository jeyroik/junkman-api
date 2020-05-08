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
    public const FIELD__HEALTH_REGENERATION = 'health_regeneration';
    public const FIELD__ATTACK = 'attack';
    public const FIELD__ATTACK_SPEED = 'attack_speed';
    public const FIELD__DEFENSE = 'defense';
    public const FIELD__MOVE = 'move';
    public const FIELD__MOVE_SPEED = 'move_speed';
    public const FIELD__CRITICAL_CHANCE = 'critical_chance';
    public const FIELD__CRITICAL_MULTIPLE = 'critical_multiple';

    public function addSkill(ISkill $skill);
    public function hasSkill(string $skillName);
    public function removeSkill(string $skillName);
    public function addSkills(array $skills);
    public function removeSkills(array $skillsNames);
    public function useSkill(string $skillName, array $args, IJunkman &$junkman = null);

    public function incProperty(string $name, int $increment);
    public function decProperty(string $name, int $decrement);
    public function isDead(): bool;
}
