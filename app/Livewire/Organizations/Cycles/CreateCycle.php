<?php

namespace App\Livewire\Organizations\Cycles;

use App\Actions\CreateCycle as CreateCycleAction;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateCycle extends Component
{
    #[Locked]
    public Organization $organization;

    #[Locked]
    public int $cycleNumber = 0;

    #[Validate('required|string|min:3|max:100000')]
    public string $description = '';

    public function render()
    {
        // get the new cycle number based on the previous ones
        // we need to check which number is the highest, and increment it
        $this->cycleNumber = $this->organization->cycles->max('number') + 1;

        return view('livewire.organizations.cycles.create', [
            'cycleNumber' => $this->cycleNumber,
            'url' => [
                'back' => route('organizations.show', ['slug' => $this->organization->slug]),
            ],
        ]);
    }

    public function store(): Redirector
    {
        $this->validate();

        $cycle = (new CreateCycleAction(
            user: Auth::user(),
            organization: $this->organization,
            number: $this->cycleNumber,
            description: $this->description,
            startedAt: Carbon::now(),
            endedAt: Carbon::now()->addDays(30),
            isActive: false,
            isPublic: false,
        ))->execute();

        return redirect()->route('organizations.cycles.show', [
            'slug' => $this->organization->slug,
            'cycle' => $cycle->number,
        ])->success(trans('Cycle created'));
    }
}
