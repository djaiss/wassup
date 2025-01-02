<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Cycle;

class ToggleCycle
{
    public function __construct(
        public Cycle $cycle,
        public bool $isActive,
    ) {
    }

    public function execute(): Cycle
    {
        $this->toggle();
        $this->setStartedAt();
        $this->markAllOtherCyclesAsInactive();

        return $this->cycle;
    }

    private function toggle(): void
    {
        $this->cycle->is_active = $this->isActive;
        $this->cycle->save();
    }

    private function setStartedAt(): void
    {
        if ($this->isActive) {
            $this->cycle->started_at = now();
        }

        if (! $this->isActive) {
            $this->cycle->started_at = null;
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
