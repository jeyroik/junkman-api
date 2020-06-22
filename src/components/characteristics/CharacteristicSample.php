<?php
namespace junkman\components\characteristics;

use extas\components\samples\Sample;
use extas\components\THasTags;
use extas\components\THasValue;
use junkman\components\exceptions\ExceptionMaxMin;
use junkman\components\exceptions\ExceptionTooLarge;
use junkman\components\exceptions\ExceptionTooSmall;
use junkman\interfaces\characteristics\ICharacteristicSample;

/**
 * Class CharacteristicSample
 *
 * @package junkman\components\characteristics
 * @author jeyroik@gmail.com
 */
class CharacteristicSample extends Sample implements ICharacteristicSample
{
    use THasTags;
    use THasValue;

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->config[static::FIELD__MAX] ?? 0;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->config[static::FIELD__MIN] ?? 0;
    }

    /**
     * @param int $increment
     * @return int
     * @throws ExceptionMaxMin
     */
    public function incMax(int $increment): int
    {
        $this->setMax($this->getMax() + $increment);

        return $this->getMax();
    }

    /**
     * @param int $increment
     * @return int
     * @throws ExceptionMaxMin
     */
    public function incMin(int $increment): int
    {
        $currentMax = $this->getMax();

        if ($currentMax < ($this->getMin() + $increment)) {
            throw new ExceptionMaxMin();
        }

        $this->setMin($this->getMin() + $increment);

        return $this->getMin();
    }

    /**
     * @param int $increment
     * @return int
     * @throws ExceptionTooLarge
     */
    public function incValue(int $increment): int
    {
        if ($this->getMax() < ($this->getValue() + $increment)) {
            throw new ExceptionTooLarge($this->getMax());
        }

        $this->setValue($this->getValue() + $increment);

        return $this->getValue();
    }

    /**
     * @param int $decrement
     * @return int
     * @throws ExceptionMaxMin
     */
    public function decMax(int $decrement): int
    {
        $currentMin = $this->getMin();

        if ($currentMin > ($this->getMax()-$decrement)) {
            throw new ExceptionMaxMin();
        }

        return $this->incMax(-$decrement);
    }

    /**
     * @param int $decrement
     * @return int
     * @throws ExceptionMaxMin
     */
    public function decMin(int $decrement): int
    {
        return $this->incMin(-$decrement);
    }

    /**
     * @param int $decrement
     * @return int
     * @throws ExceptionTooSmall
     */
    public function decValue(int $decrement): int
    {
        if ($this->getMin() > ($this->getValue() - 1)) {
            throw new ExceptionTooSmall($this->getMin());
        }

        $this->setValue($this->getValue() - $decrement);

        return $this->getValue();
    }

    /**
     * @param int $max
     * @return $this|CharacteristicSample
     * @throws ExceptionMaxMin
     */
    public function setMax(int $max)
    {
        if ($max < $this->getMin()) {
            throw new ExceptionMaxMin();
        }

        $this->config[static::FIELD__MAX] = $max;

        return $this;
    }

    /**
     * @param int $min
     * @return $this|CharacteristicSample
     * @throws ExceptionMaxMin
     */
    public function setMin(int $min)
    {
        if ($min > $this->getMax()) {
            throw new ExceptionMaxMin();
        }

        $this->config[static::FIELD__MIN] = $min;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.characteristic.sample';
    }
}
