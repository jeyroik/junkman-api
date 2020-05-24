<?php
namespace junkman\interfaces\using;

use extas\interfaces\IHasId;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\repositories\IRepository;

/**
 * Interface IUsable
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IUsable extends IItem, IHasId, IHasName
{
    public const SUBJECT = 'junkman.usable';

    public const FIELD__REPOSITORY_CLASS = 'repository_class';

    /**
     * @return string
     */
    public function getRepositoryClass(): string;

    /**
     * @return IRepository
     */
    public function getRepository(): IRepository;

    /**
     * @return ICanBeUsed|null
     */
    public function getICanBeUsed(): ?ICanBeUsed;

    /**
     * @param string $repositoryClass
     * @return IUsable
     */
    public function setRepositoryClass(string $repositoryClass): IUsable;
}
