<?php
namespace junkman\components\exceptions;

use Throwable;

/**
 * Class ExceptionMissed
 *
 * @package junkman\components\exceptions
 * @author jeyroik@gmail.com
 */
class ExceptionMissed extends \Exception
{
    /**
     * ExceptionMissedCharacteristic constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous\
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Missed "%s"', $message);
        parent::__construct($message, $code, $previous);
    }
}
