<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Goal;

class DestroyGoal
{
    public function __construct(
        public Goal $goal,
    ) {
    }

    public function execute(): void
    {
        $this->goal->delete();
    }
}
