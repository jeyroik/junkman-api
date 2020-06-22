<?php
namespace junkman\components\exceptions;

use Throwable;

/**
 * Class ExceptionMaxMin
 *
 * @package junkman\components\exceptions
 * @author jeyroik@gmail.com
 */
class ExceptionMaxMin extends \Exception
{
    /**
     * ExceptionMaxMin constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Max can not be lower than min';

        parent::__construct($message, $code, $previous);
    }
}
