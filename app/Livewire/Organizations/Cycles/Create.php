<?php

namespace App\Livewire\Organizations\Cycles;

use App\Actions\CreateCycle;
use App\Jobs\RefreshCycleCache;
use App\Models\Organization;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Create extends Component
{
    #[Locked]
    public Organization $organization;

    #[Validate('required|integer|min:1|max:1000')]
    public int $cycleNumber = 0;

    #[Validate('required|string|min:3|max:100000')]
    public string $description = '';

    public function render()
    {
        // get the new cycle number based on the previous ones
        // we need to check which number is the highest, and increment it
        $this->cycleNumber = $this->organization->cycles->max('number') + 1;

        return view('livewire.organizations.cycles.create', [
            'organization' => $this->organization,
            'cycleNumber' => $this->cycleNumber,
        ]);
    }

    public function store(): Redirector
    {
        $this->validate();

        $cycle = (new CreateCycle(
            organization: $this->organization,
            number: $this->cycleNumber,
            description: $this->description,
            startedAt: Carbon::now(),
            endedAt: Carbon::now()->addDays(30),
            isActive: false,
            isPublic: false,
        ))->execute();

        RefreshCycleCache::dispatch($this->organization);

        return redirect()->route('organizations.cycles.show', [
            'slug' => $this->organization->slug,
            'cycle' => $cycle->number,
        ])->success(trans('Cycle created'));
    }
}
