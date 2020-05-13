<?php
namespace junkman\components;

use junkman\interfaces\IHasWeight;

/**
 * Trait THasWeight
 *
 * @property array $config
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
trait THasWeight
{
    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->config[IHasWeight::FIELD__WEIGHT] ?? 0;
    }

    /**
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight)
    {
        $this->config[IHasWeight::FIELD__WEIGHT] = $weight;

        return $this;
    }

    /**
     * @param int $weight
     * @return $this
     */
    public function addToWeight(int $weight)
    {
        return $this->setWeight($this->getWeight() + $weight);
    }

    /**
     * @param int $weight
     * @return $this
     */
    public function removeFromWeight(int $weight)
    {
        if ($weight > $this->getWeight()) {
            $this->setWeight(0);
        } else {
            $this->setWeight($this->getWeight() - $weight);
        }

        return $this;
    }

    /**
     * @param IHasWeight $item
     * @return bool
     */
    public function isWeighsMoreThan(IHasWeight $item): bool
    {
        return $this->getWeight() > $item->getWeight();
    }

    /**
     * @param IHasWeight $item
     * @return bool
     */
    public function isWeighsLessThan(IHasWeight $item): bool
    {
        return !$this->isWeighsMoreThan($item);
    }

    /**
     * @param int $weight
     * @return int -1 less than $weight, 0 equals, 1 bigger than $weight
     */
    public function compareWeightWith(int $weight): int
    {
        $selfWeight = $this->getWeight();
        $result = 0;

        if ($selfWeight < $weight) {
            $result = -1;
        } elseif ($selfWeight > $weight) {
            $result = 1;
        }

        return $result;
    }
}
