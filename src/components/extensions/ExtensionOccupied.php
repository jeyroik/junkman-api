<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use junkman\interfaces\contents\IContentsItem;
use junkman\interfaces\extensions\IExtensionOccupied;

/**
 * Class ExtensionOccupied
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionOccupied extends Extension implements IExtensionOccupied
{
    public const PARAM__SIZE_X_OCCUPIED = 'size_x_occupied';
    public const PARAM__SIZE_Y_OCCUPIED = 'size_y_occupied';
    public const PARAM__SIZE_Z_OCCUPIED = 'size_z_occupied';

    /**
     * @param int $x
     * @param IContentsItem $item
     * @return mixed
     * @throws \Exception
     */
    public function incXOccupied(int $x, IContentsItem &$item = null)
    {
        $this->checkFreeEnough(static::PARAM__SIZE_X_OCCUPIED, $x, $item);
        $this->incXYZ(static::PARAM__SIZE_X_OCCUPIED, $x, $item);

        return $item;
    }

    /**
     * @param int $y
     * @param IContentsItem $item
     * @return mixed
     * @throws \Exception
     */
    public function incYOccupied(int $y, IContentsItem &$item = null)
    {
        $this->checkFreeEnough(static::PARAM__SIZE_Y_OCCUPIED, $y, $item);
        $this->incXYZ(static::PARAM__SIZE_Y_OCCUPIED, $y, $item);

        return $item;
    }

    /**
     * @param int $z
     * @param IContentsItem $item
     * @return mixed
     * @throws \Exception
     */
    public function incZOccupied(int $z, IContentsItem &$item = null)
    {
        $this->checkFreeEnough(static::PARAM__SIZE_Z_OCCUPIED, $z, $item);
        $this->incXYZ(static::PARAM__SIZE_Z_OCCUPIED, $z, $item);

        return $item;
    }

    /**
     * @param array $size
     * @param IContentsItem $item
     * @return mixed
     * @throws \Exception
     */
    public function incSizeOccupied(array $size, IContentsItem &$item = null)
    {
        list($x, $y, $z) = $size;

        $this->checkFreeEnough(static::PARAM__SIZE_X_OCCUPIED, $x, $item);
        $this->checkFreeEnough(static::PARAM__SIZE_Y_OCCUPIED, $y, $item);
        $this->checkFreeEnough(static::PARAM__SIZE_Z_OCCUPIED, $z, $item);

        $this->incXOccupied($x, $item);
        $this->incYOccupied($y, $item);
        $this->incZOccupied($z, $item);
    }

    /**
     * @param int $x
     * @param IContentsItem $item
     * @return mixed
     */
    public function decXOccupied(int $x, IContentsItem &$item = null)
    {
        $this->decXYZ(static::PARAM__SIZE_X_OCCUPIED, $x, $item);

        return $item;
    }

    /**
     * @param int $y
     * @param IContentsItem $item
     * @return mixed
     */
    public function decYOccupied(int $y, IContentsItem &$item = null)
    {
        $this->decXYZ(static::PARAM__SIZE_Y_OCCUPIED, $y, $item);

        return $item;
    }

    /**
     * @param int $z
     * @param IContentsItem $item
     * @return mixed
     */
    public function decZOccupied(int $z, IContentsItem &$item = null)
    {
        $this->decXYZ(static::PARAM__SIZE_Z_OCCUPIED, $z, $item);

        return $item;
    }

    /**
     * @param array $size
     * @param IContentsItem $item
     * @return mixed
     */
    public function decSizeOccupied(array $size, IContentsItem &$item = null)
    {
        list($x, $y, $z) = $size;

        $this->decXOccupied($x, $item);
        $this->decYOccupied($y, $item);
        $this->decZOccupied($z, $item);

        return $item;
    }

    /**
     * @param string $dim
     * @param int $value
     * @param IContentsItem $item
     */
    protected function incXYZ(string $dim, int $value, IContentsItem &$item): void
    {
        $item->setParameterValue($dim, $item->getParameterValue($dim) + $value);
    }

    /**
     * @param string $dim
     * @param int $value
     * @param IContentsItem $item
     */
    protected function decXYZ(string $dim, int $value, IContentsItem &$item): void
    {
        if ($item->getParameterValue($dim) < $value) {
            $item->setParameterValue($dim, 0);
        }

        $item->setParameterValue($dim, $item->getParameterValue($dim) - $value);
    }

    /**
     * @param string $dim
     * @param int $value
     * @param IContentsItem $item
     * @throws \Exception
     */
    protected function checkFreeEnough(string $dim, int $value, IContentsItem $item): void
    {
        $free = $item->getSizeX() - $item->getParameterValue(static::PARAM__SIZE_X_OCCUPIED);
        if ($free < $value) {
            throw new \Exception('Too big to add');
        }
    }
}
