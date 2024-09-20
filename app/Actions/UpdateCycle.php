<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cycle;
use Carbon\Carbon;

class UpdateCycle
{
    public function __construct(
        public Cycle $cycle,
        public string $description,
        public int $number,
        public Carbon $startedAt,
        public Carbon $endedAt,
        public bool $isPublic,
    ) {
    }

    public function execute(): Cycle
    {
        $this->update();

        return $this->cycle;
    }

    private function update(): void
    {
        $this->cycle->update([
            'description' => $this->description,
            'number' => $this->number,
            'started_at' => $this->startedAt->toDateString(),
            'ended_at' => $this->endedAt->toDateString(),
            'is_public' => $this->isPublic,
        ]);
    }
}
