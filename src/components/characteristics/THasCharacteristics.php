<?php
namespace junkman\components\characteristics;

use extas\interfaces\repositories\IRepository;
use junkman\interfaces\characteristics\ICharacteristic;
use junkman\interfaces\characteristics\ICharacteristicSample;

/**
 * Trait THasCharacteristics
 *
 * @property array $config
 * @method IRepository characteristicRepository()
 * @method string getName()
 *
 * @package junkman\components\characteristics
 * @author jeyroik@gmail.com
 */
trait THasCharacteristics
{
    /**
     * @param array $where
     * @return bool
     */
    public function hasCharacteristics($where = []): bool
    {
        $where[ICharacteristic::FIELD__PLAYER_NAME] = $this->getName();
        $chars = $this->characteristicRepository()->all($where);

        return !empty($chars);
    }

    /**
     * @param array $where return all if empty
     * @return ICharacteristic[]
     */
    public function getCharacteristics($where = []): array
    {
        $where[ICharacteristic::FIELD__PLAYER_NAME] = $this->getName();
        return $this->characteristicRepository()->all($where);
    }

    /**
     * @param string $name
     * @return ICharacteristic|null
     */
    public function getCharacteristic(string $name): ?ICharacteristic
    {
        return $this->characteristicRepository()->one([
            ICharacteristic::FIELD__NAME => $name,
            ICharacteristic::FIELD__PLAYER_NAME => $this->getName()
        ]);
    }

    /**
     * @param ICharacteristic[] $characteristics
     * @return int added characteristics count
     */
    public function addCharacteristics(array $characteristics): int
    {
        $names = array_column($characteristics, ICharacteristic::FIELD__NAME);
        $existed = $this->getCharacteristics([ICharacteristic::FIELD__NAME => $names]);
        $existedByName = array_column($existed, ICharacteristic::FIELD__NAME);

        $added = 0;
        $repo = $this->characteristicRepository();

        foreach ($characteristics as $characteristic) {
            if (isset($existedByName[$characteristic->getName()])) {
                continue;
            }
            $characteristic->setPlayerName($this->getName());
            $repo->create($characteristic);
            $added++;
        }

        return $added;
    }

    /**
     * @param ICharacteristicSample[] $samples
     * @return int created characteristics count
     */
    public function createCharacteristics(array $samples): int
    {
        $repo = $this->characteristicRepository();
        $created = 0;

        foreach ($samples as $sample) {
            $char = new Characteristic();
            $char->buildFromSample($sample);
            $repo->create($char);
            $created++;
        }

        return $created;
    }

    /**
     * @param array $where
     * @return int removed characteristics count
     */
    public function removeCharacteristics($where = []): int
    {
        $where[ICharacteristic::FIELD__PLAYER_NAME] = $this->getName();
        return $this->characteristicRepository()->delete($where);
    }

    /**
     * @param ICharacteristic $characteristic
     * @return $this
     */
    public function updateCharacteristic(ICharacteristic $characteristic)
    {
        $this->characteristicRepository()->update($characteristic);

        return $this;
    }
}
