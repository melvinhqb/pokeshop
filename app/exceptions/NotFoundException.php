<?php

// app/exceptions/NotFoundException.php

namespace App\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct($message = "Resource not found", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}