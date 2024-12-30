<?php

declare(strict_types=1);

namespace App\Exceptions;

class CycleStartedAtMustBeBeforeEndedAtException extends \Exception
{
    public function __construct(string $message = 'The started at date must be before the ended at date.')
    {
        parent::__construct($message);
    }
}
