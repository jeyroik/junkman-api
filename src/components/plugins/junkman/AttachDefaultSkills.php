<?php
namespace junkman\components\plugins\junkman;

use extas\components\plugins\Plugin;
use junkman\interfaces\IJunkman;

/**
 * Class AttachDefaultSkills
 *
 * @package junkman\components\plugins\junkman
 * @author jeyroik@gmail.com
 */
class AttachDefaultSkills extends Plugin
{
    /**
     * @param IJunkman $junkman
     */
    public function __invoke(IJunkman &$junkman)
    {
        $defaultSkillsConfig = APP__ROOT . '/src/configs/default.skills.php';
        if (is_file($defaultSkillsConfig)) {
            $defaultSkills = include $defaultSkillsConfig;
            $junkman->addSkills($defaultSkills);
        }
    }
}
