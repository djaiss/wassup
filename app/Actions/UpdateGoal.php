<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Goal;

class UpdateGoal
{
    public function __construct(
        public Goal $goal,
        public string $title,
        public string $description,
    ) {
    }

    public function execute(): Goal
    {
        $this->update();

        return $this->goal;
    }

    private function update(): void
    {
        $this->goal->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
