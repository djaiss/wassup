<?php

declare(strict_types=1);

namespace App\Exceptions;

class CycleNumberAlreadyTakenException extends \Exception
{
    public function __construct(string $message = 'This cycle number can not be taken. Please choose another one.')
    {
        parent::__construct($message);
    }
}
