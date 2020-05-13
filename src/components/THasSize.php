<?php
namespace junkman\components;

use junkman\interfaces\IHasSize;

/**
 * Trait THasSize
 *
 * @property array $config
 *
 * @package junkman\components
 * @author jeyroik@gmail.com
 */
trait THasSize
{
    /**
     * @return array
     */
    public function getSize(): array
    {
        return [$this->getSizeX(), $this->getSizeY(), $this->getSizeZ()];
    }

    /**
     * @return int
     */
    public function getSizeX(): int
    {
        return $this->config[IHasSize::FIELD__SIZE_X] ?? 0;
    }

    /**
     * @return int
     */
    public function getSizeY(): int
    {
        return $this->config[IHasSize::FIELD__SIZE_Y] ?? 0;
    }

    /**
     * @return int
     */
    public function getSizeZ(): int
    {
        return $this->config[IHasSize::FIELD__SIZE_Z] ?? 0;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return $this
     */
    public function setSize(int $x, int $y, int $z)
    {
        return $this->setSizeX($x)->setSizeY($y)->setSizeZ($z);
    }

    /**
     * @param int $x
     * @return $this
     */
    public function setSizeX(int $x)
    {
        $this->config[IHasSize::FIELD__SIZE_X] = $x;

        return $this;
    }

    /**
     * @param int $y
     * @return $this
     */
    public function setSizeY(int $y)
    {
        $this->config[IHasSize::FIELD__SIZE_Y] = $y;

        return $this;
    }

    /**
     * @param int $z
     * @return $this
     */
    public function setSizeZ(int $z)
    {
        $this->config[IHasSize::FIELD__SIZE_Z] = $z;

        return $this;
    }

    /**
     * @param IHasSize $item
     * @return bool
     */
    public function isBiggerThan(IHasSize $item): bool
    {
        $biggerX = $this->getSizeX() > $item->getSizeX();
        $biggerY = $this->getSizeY() > $item->getSizeY();
        $biggerZ = $this->getSizeZ() > $item->getSizeZ();

        return $biggerX && $biggerY && $biggerZ;
    }

    /**
     * @param IHasSize $item
     * @return bool
     */
    public function isSmallerThan(IHasSize $item): bool
    {
        return !$this->isBiggerThan($item);
    }

    /**
     * @param array $size
     * @return array [x, y, z], where z,y,z = -1 less than $size, 0 equal, 1 bigger than $size
     */
    public function compareSizeWith(array $size): array
    {
        $selfSize = $this->getSize();

        $result = [0, 0, 0];

        foreach ($size as $index => $value) {
            if ($selfSize[$index] < $value) {
                $result[$index] = -1;
            } elseif ($selfSize[$index] > $value) {
                $result[$index] = 1;
            }
        }

        return $result;
    }
}
