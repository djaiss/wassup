<?php

namespace App\Jobs;

use App\Cache\CycleCache;
use App\Models\Cycle;
use App\Models\Organization;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RefreshCycleCache implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Organization $organization
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->organization->cycles->each(fn (Cycle $cycle): mixed => CycleCache::make(
                organization: $this->organization,
                cycle: $cycle,
            )->refresh()
        );
    }
}
