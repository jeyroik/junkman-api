<?php
namespace junkman\interfaces\extensions;

/**
 * Interface IExtensionOccupied
 *
 * @package junkman\interfaces\extensions
 * @author jeyroik@gmail.com
 */
interface IExtensionOccupied
{
    public const PARAM__SIZE_X_OCCUPIED = 'size_x_occupied';
    public const PARAM__SIZE_Y_OCCUPIED = 'size_y_occupied';
    public const PARAM__SIZE_Z_OCCUPIED = 'size_z_occupied';

    /**
     * @param int $x
     * @return mixed
     * @throws \Exception
     */
    public function incXOccupied(int $x);

    /**
     * @param int $y
     * @return mixed
     * @throws \Exception
     */
    public function incYOccupied(int $y);

    /**
     * @param int $z
     * @return mixed
     * @throws \Exception
     */
    public function incZOccupied(int $z);

    /**
     * @param array $size
     * @return mixed
     * @throws \Exception
     */
    public function incSizeOccupied(array $size);

    /**
     * @param int $x
     * @return mixed
     */
    public function decXOccupied(int $x);

    /**
     * @param int $y
     * @return mixed
     */
    public function decYOccupied(int $y);

    /**
     * @param int $z
     * @return mixed
     */
    public function decZOccupied(int $z);

    /**
     * @param array $size
     * @return mixed
     */
    public function decSizeOccupied(array $size);
}
