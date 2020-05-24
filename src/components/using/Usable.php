<?php
namespace junkman\components\using;

use extas\components\Item;
use extas\components\THasId;
use extas\components\THasName;
use extas\interfaces\IHasName;
use extas\interfaces\repositories\IRepository;
use junkman\interfaces\using\ICanBeUsed;
use junkman\interfaces\using\IUsable;

/**
 * Class Usable
 *
 * @package junkman\components\using
 * @author jeyroik@gmail.com
 */
class Usable extends Item implements IUsable
{
    use THasId;
    use THasName;

    /**
     * @return string
     */
    public function getRepositoryClass(): string
    {
        return $this->config[static::FIELD__REPOSITORY_CLASS] ?? '';
    }

    /**
     * @return IRepository
     */
    public function getRepository(): IRepository
    {
        $class = $this->getRepositoryClass();

        return new $class();
    }

    /**
     * @return ICanBeUsed|null
     */
    public function getICanBeUsed(): ?ICanBeUsed
    {
        return $this->getRepository()->one([IHasName::FIELD__NAME => $this->getName()]);
    }

    /**
     * @param string $repositoryClass
     * @return $this|IUsable
     */
    public function setRepositoryClass(string $repositoryClass): IUsable
    {
        $this->config[static::FIELD__REPOSITORY_CLASS] = $repositoryClass;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
