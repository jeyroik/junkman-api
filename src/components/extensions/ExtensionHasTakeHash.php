<?php
namespace junkman\components\extensions;

use extas\components\extensions\Extension;
use extas\interfaces\samples\parameters\IHasSampleParameters;
use junkman\interfaces\extensions\IExtensionHasTakeHash;

/**
 * Class ExtensionHasTakeHash
 *
 * @package junkman\components\extensions
 * @author jeyroik@gmail.com
 */
class ExtensionHasTakeHash extends Extension implements IExtensionHasTakeHash
{
    /**
     * @param null $subject
     * @return string
     */
    public function getTakeHash($subject = null): string
    {
        return $subject instanceof IHasSampleParameters
            ? $subject->getParameterValue(static::FIELD__TAKE_HASH, '')
            : (string) $subject[static::FIELD__TAKE_HASH];
    }

    /**
     * @param string $hash
     * @param null $subject
     * @return mixed
     */
    public function setTakeHash(string $hash, &$subject = null)
    {
        if ($subject instanceof IHasSampleParameters) {
            $subject->addParameterByValue(static::FIELD__TAKE_HASH, $hash);
        } else {
            $subject[static::FIELD__TAKE_HASH] = $hash;
        }

        return $subject;
    }
}
