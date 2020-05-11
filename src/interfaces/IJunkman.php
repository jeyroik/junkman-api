<?php
namespace junkman\interfaces;

use extas\interfaces\IHasClass;
use extas\interfaces\players\IPlayer;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\locations\IHasLocation;
use junkman\interfaces\skills\IHasSkills;

/**
 * Interface IJunkman
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IJunkman extends IPlayer, IHasSampleParameters, IHasLocation, IHasSkills
{
    public const PARAM__HEALTH = 'health';
    public const PARAM__HEALTH_MAX = 'health_max';
    public const PARAM__HEALTH_REGENERATION = 'health_regeneration';
    public const PARAM__ATTACK = 'attack';
    public const PARAM__ATTACK_SPEED = 'attack_speed';
    public const PARAM__DEFENSE = 'defense';
    public const PARAM__DEFENSE_MAX = 'defense_max';
    public const PARAM__MOVE = 'move';
    public const PARAM__MOVE_SPEED = 'move_speed';
    public const PARAM__CRITICAL_CHANCE = 'critical_chance';
    public const PARAM__CRITICAL_MULTIPLE = 'critical_multiple';

    /**
     * @param IHasClass $subject
     * @param string $stageSuffix
     * @param mixed ...$args
     */
    public function use(IHasClass $subject, string $stageSuffix, ...$args): void;

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
}
