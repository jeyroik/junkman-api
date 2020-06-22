<?php
namespace junkman\components\exceptions;

use Throwable;

/**
 * Class ExceptionTooSmall
 *
 * @package junkman\components\exceptions
 * @author jeyroik@gmail.com
 */
class ExceptionTooSmall extends \Exception
{
    /**
     * ExceptionTooLarge constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Can not be lower than ' . $message;
        parent::__construct($message, $code, $previous);
    }
}
