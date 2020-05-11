<?php
namespace junkman\interfaces\extensions;

use junkman\interfaces\IJunkman;

/**
 * Interface IExtensionUseSkill
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IExtensionUseSkill
{
    /**
     * @param string $skillName
     * @param IJunkman|null $enemy
     * @param array $args
     */
    public function useSkill(string $skillName, ?IJunkman &$enemy = null, array $args = []): void;
}
