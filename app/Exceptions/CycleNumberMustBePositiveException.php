<?php

declare(strict_types=1);

namespace App\Exceptions;

class CycleNumberMustBePositiveException extends \Exception
{
    public function __construct(string $message = 'This cycle number must be a positive integer.')
    {
        parent::__construct($message);
    }
}
