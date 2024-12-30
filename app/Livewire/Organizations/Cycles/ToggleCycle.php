<?php

namespace App\Livewire\Organizations\Cycles;

use App\Actions\ToggleCycle as ToggleCycleAction;
use App\Cache\CycleCache;
use App\Jobs\RefreshCycleCache;
use App\Models\Cycle;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class ToggleCycle extends Component
{
    #[Locked]
    public Cycle $cycle;

    public function render()
    {
        return view('livewire.organizations.cycles.toggle');
    }

    public function toggle(): Redirector
    {
        (new ToggleCycleAction(
            cycle: $this->cycle,
            isActive: ! $this->cycle->is_active,
        ))->execute();

        // we need to manually refresh the cache for this cycle since it's
        // the one that will be immediately shown to the user
        // then, we'll need to refresh the other caches
        CycleCache::make(
            organization: $this->cycle->organization,
            cycle: $this->cycle,
        )->refresh();

        RefreshCycleCache::dispatch($this->cycle->organization);

        return redirect()->route('organizations.cycles.show', [
            'slug' => $this->cycle->organization->slug,
            'cycle' => $this->cycle->number,
        ])->success(trans('Cycle updated'));
    }
}
