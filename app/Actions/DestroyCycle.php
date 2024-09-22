<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cycle;

class DestroyCycle
{
    public function __construct(
        public Cycle $cycle,
    ) {
    }

    public function execute(): void
    {
        $this->cycle->delete();
    }
}
