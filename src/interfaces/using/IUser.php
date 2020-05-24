<?php
namespace junkman\interfaces\using;

/**
 * Interface IUser
 *
 * @package junkman\interfaces
 * @author jeyroik@gmail.com
 */
interface IUser extends IUsable
{
    /**
     * @return ICanUse|null
     */
    public function getICanUse(): ?ICanUse;
}
