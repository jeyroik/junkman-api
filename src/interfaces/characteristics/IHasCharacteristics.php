<?php
namespace junkman\interfaces\characteristics;

use extas\interfaces\IHasName;

/**
 * Interface IHasCharacteristics
 *
 * @package junkman\interfaces\characteristics
 * @author jeyroik@gmail.com
 */
interface IHasCharacteristics extends IHasName
{
    /**
     * @param array $where
     * @return bool
     */
    public function hasCharacteristics($where = []): bool;

    /**
     * @param string $name
     * @return ICharacteristic|null
     */
    public function getCharacteristic(string $name): ?ICharacteristic;

    /**
     * @param array $where return all if empty
     * @return ICharacteristic[]
     */
    public function getCharacteristics($where = []): array;

    /**
     * @param ICharacteristic[] $characteristics
     * @return int added characteristics count
     */
    public function addCharacteristics(array $characteristics): int;

    /**
     * @param ICharacteristicSample[] $samples
     * @return int created characteristics count
     */
    public function createCharacteristics(array $samples): int;

    /**
     * @param array $where
     * @return int removed characteristics count
     */
    public function removeCharacteristics($where = []): int;

    /**
     * @param ICharacteristic $characteristic
     * @return $this
     */
    public function updateCharacteristic(ICharacteristic $characteristic);
}
