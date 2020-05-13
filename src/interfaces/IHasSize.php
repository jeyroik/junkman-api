<?php
namespace junkman\interfaces;

/**
 * Interface IHasSize
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasSize
{
    public const FIELD__SIZE_X = 'size_x';
    public const FIELD__SIZE_Y = 'size_y';
    public const FIELD__SIZE_Z = 'size_z';

    /**
     * @return array
     */
    public function getSize(): array;

    /**
     * @return int
     */
    public function getSizeX(): int;

    /**
     * @return int
     */
    public function getSizeY(): int;

    /**
     * @return int
     */
    public function getSizeZ(): int;

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return $this
     */
    public function setSize(int $x, int $y, int $z);

    /**
     * @param int $x
     * @return $this
     */
    public function setSizeX(int $x);

    /**
     * @param int $y
     * @return $this
     */
    public function setSizeY(int $y);

    /**
     * @param int $z
     * @return $this
     */
    public function setSizeZ(int $z);

    /**
     * @param IHasSize $item
     * @return bool
     */
    public function isBiggerThan(IHasSize $item): bool;

    /**
     * @param IHasSize $item
     * @return bool
     */
    public function isSmallerThan(IHasSize $item): bool;

    /**
     * @param array $size
     * @return array [x, y, z], where z,y,z = -1 less than $size, 0 equal, 1 bigger than $size
     */
    public function compareSizeWith(array $size): array;
}