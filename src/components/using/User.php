<?php
namespace junkman\components\using;

use extas\interfaces\IHasName;
use junkman\interfaces\using\ICanUse;
use junkman\interfaces\using\IUser;

/**
 * Class User
 *
 * @package junkman\components\using
 * @author jeyroik@gmail.com
 */
class User extends Usable implements IUser
{
    /**
     * @return ICanUse|null
     */
    public function getICanUse(): ?ICanUse
    {
        return $this->getRepository()->one([IHasName::FIELD__NAME => $this->getName()]);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'junkman.user';
    }
}
