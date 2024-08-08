<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AppException extends Exception
{
    public function __construct($status = 500, $message = 'Internal Server Error', Throwable $previous = null)
    {
        parent::__construct($message, $status, $previous);
    }
}
