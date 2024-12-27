<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cycle;

class ToggleCycle
{
    public function __construct(
        public Cycle $cycle,
    ) {
    }

    public function execute(): Cycle
    {
        $this->toggle();
        $this->markAllOtherCyclesAsInactive();

        return $this->cycle;
    }

    private function toggle(): void
    {
        $this->cycle->is_active = ! $this->cycle->is_active;
        if ($this->cycle->is_active) {
            $this->cycle->started_at = now()->toDateTimeString();
        } else {
            $this->cycle->ended_at = now()->toDateTimeString();
        }
        $this->cycle->save();
    }

    private function markAllOtherCyclesAsInactive(): void
    {
        $this->cycle->organization->cycles()
            ->where('id', '!=', $this->cycle->id)
            ->update([
                'is_active' => false,
            ]);
    }
}
