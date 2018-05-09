<?php

namespace App\Exceptions;

use Throwable;

class MultipleShiftAssignmentException extends \Exception
{
    public function __construct(string $message = 'Cannot assign multiple shifts to the same date with the same definition.', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}