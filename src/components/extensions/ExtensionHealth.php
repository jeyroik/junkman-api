<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use junkman\interfaces\extensions\IExtensionHealth;
use junkman\interfaces\IJunkman;

/**
 * Class ExtensionIsDead
 *
 * @method junkmanRepository()
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionHealth extends Extension implements IExtensionHealth
{
    /**
     * @param IJunkman|null $junkman
     * @return int
     */
    public function getCurrentHealth(IJunkman &$junkman = null): int
    {
        return $junkman->getParameterValue($junkman::PARAM__HEALTH, 0);
    }

    /**
     * @param IJunkman|null $junkman
     * @return int
     */
    public function getCurrentHealthRegeneration(IJunkman &$junkman = null): int
    {
        return $junkman->getParameterValue($junkman::PARAM__HEALTH_REGENERATION, 0);
    }

    /**
     * @param IJunkman|null $junkman
     * @return int
     */
    public function getMaxHealth(IJunkman &$junkman = null): int
    {
        return $junkman->getParameterValue($junkman::PARAM__HEALTH_MAX, 0);
    }

    /**
     * @param IJunkman|null $junkman
     * @return int
     */
    public function getLostHealth(IJunkman &$junkman = null): int
    {
        return $this->getMaxHealth($junkman) - $this->getCurrentHealth($junkman);
    }

    /**
     * @param int $increment
     * @param IJunkman|null $junkman
     * @return IJunkman
     */
    public function incHealth(int $increment, IJunkman &$junkman = null): IJunkman
    {
        if ($this->getMaxHealth($junkman) >= ($this->getCurrentHealth($junkman) + $increment)) {
            $junkman->incProperty($junkman::PARAM__HEALTH, $increment);
        } else {
            $junkman->setParameterValue($junkman::PARAM__HEALTH, $this->getMaxHealth($junkman));
        }

        $this->junkmanRepository()->update($junkman);

        return $junkman;
    }

    /**
     * @param int $decrement
     * @param IJunkman|null $junkman
     * @return IJunkman
     */
    public function decHealth(int $decrement, IJunkman &$junkman = null): IJunkman
    {
        if ($this->getCurrentHealth($junkman) >= $decrement) {
            $junkman->decProperty($junkman::PARAM__HEALTH, $decrement);
        } else {
            $junkman->setParameterValue($junkman::PARAM__HEALTH, 0);
        }

        $this->junkmanRepository()->update($junkman);

        return $junkman;
    }

    /**
     * @param int $increment
     * @param IJunkman|null $junkman
     * @return IJunkman
     */
    public function incMaxHealth(int $increment, IJunkman &$junkman = null): IJunkman
    {
        $junkman->incProperty($junkman::PARAM__HEALTH_MAX, $increment);
        $this->junkmanRepository()->update($junkman);

        return $junkman;
    }

    /**
     * @param int $decrement
     * @param IJunkman|null $junkman
     * @return IJunkman
     */
    public function decMaxHealth(int $decrement, IJunkman &$junkman = null): IJunkman
    {
        if ($this->getMaxHealth($junkman) >= $decrement) {
            $junkman->decProperty($junkman::PARAM__HEALTH_MAX, $decrement);
        } else {
            $junkman->setParameterValue($junkman::PARAM__HEALTH_MAX, 0);
        }

        $this->junkmanRepository()->update($junkman);

        return $junkman;
    }

    /**
     * @param int $increment
     * @param IJunkman|null $junkman
     * @return IJunkman
     */
    public function incHealthRegeneration(int $increment, IJunkman &$junkman = null): IJunkman
    {
        $junkman->incProperty($junkman::PARAM__HEALTH_REGENERATION, $increment);
        $this->junkmanRepository()->update($junkman);

        return $junkman;
    }

    /**
     * @param int $decrement
     * @param IJunkman|null $junkman
     * @return IJunkman
     */
    public function decHealthRegeneration(int $decrement, IJunkman &$junkman = null): IJunkman
    {
        if ($this->getCurrentHealthRegeneration($junkman) >= $decrement) {
            $junkman->decProperty($junkman::PARAM__HEALTH_REGENERATION, $decrement);
        } else {
            $junkman->setParameterValue($junkman::PARAM__HEALTH_REGENERATION, 0);
        }

        $this->junkmanRepository()->update($junkman);

        return $junkman;
    }

    /**
     * @param IJunkman|null $junkman
     * @return bool
     */
    public function isDead(IJunkman $junkman = null): bool
    {
        return $junkman->getParameterValue($junkman::PARAM__HEALTH) <= 0;
    }
}
