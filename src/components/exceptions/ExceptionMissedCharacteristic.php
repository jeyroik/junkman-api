<?php
namespace junkman\components\exceptions;

use Throwable;

/**
 * Class ExceptionMissedCharacteristic
 *
 * @package junkman\components\exceptions
 * @author jeyroik@gmail.com
 */
class ExceptionMissedCharacteristic extends \Exception
{
    /**
     * ExceptionMissedCharacteristic constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous\
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Missed characteristic "%s"', $message);
        parent::__construct($message, $code, $previous);
    }
}
