<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Checkin;

class DestroyCheckin
{
    public function __construct(
        public Checkin $checkin,
    ) {
    }

    public function execute(): void
    {
        $this->checkin->delete();
    }
}
