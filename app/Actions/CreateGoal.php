<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Organization;
use Carbon\Carbon;

class CreateGoal
{
    private Goal $goal;

    public function __construct(
        public Cycle $cycle,
        public string $title,
        public ?string $description,
    ) {
    }

    public function execute(): Goal
    {
        $this->create();

        return $this->goal;
    }

    private function create(): void
    {
        $this->goal = Goal::create([
            'cycle_id' => $this->cycle->id,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
