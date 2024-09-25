<?php

namespace App\Livewire\Organizations\Cycles;

use App\Actions\ToggleCycle;
use App\Cache\CycleCache;
use App\Jobs\RefreshCycleCache;
use App\Models\Cycle;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Toggle extends Component
{
    #[Locked]
    public Cycle $cycle;

    public function render()
    {
        return view('livewire.organizations.cycles.toggle');
    }

    public function toggle(): void
    {
        (new ToggleCycle(
            cycle: $this->cycle,
        ))->execute();

        // we need to manually refresh the cache for this cycle since it's
        // the one that will be immediately shown to the user
        // then, we'll need to refresh the other caches
        CycleCache::make(
            organization: $this->cycle->organization,
            cycle: $this->cycle,
        )->refresh();

        RefreshCycleCache::dispatch($this->cycle->organization);

        $this->redirectRoute('organizations.cycles.show', [
            'slug' => $this->cycle->organization->slug,
            'cycle' => $this->cycle->number,
        ]);
    }
}
