<?php

declare(strict_types=1);

namespace App\Exceptions;

class NameAlreadyTakenException extends \Exception
{
    public function __construct(string $message = 'This name can not be taken. Please choose another one.')
    {
        parent::__construct($message);
    }
}
