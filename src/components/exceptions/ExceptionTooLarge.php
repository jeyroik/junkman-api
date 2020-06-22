<?php
namespace junkman\components\exceptions;

use Throwable;

/**
 * Class ExceptionTooLarge
 *
 * @package junkman\components\exceptions
 * @author jeyroik@gmail.com
 */
class ExceptionTooLarge extends \Exception
{
    /**
     * ExceptionTooLarge constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Can not be larger than ' . $message;
        parent::__construct($message, $code, $previous);
    }
}
