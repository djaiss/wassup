<?php

namespace App\Livewire\Organizations\Cycles;

use App\Actions\ToggleCycle as ToggleCycleAction;
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

        return redirect()->route('organizations.cycles.show', [
            'slug' => $this->cycle->organization->slug,
            'cycle' => $this->cycle->number,
        ])->success(trans('Cycle updated'));
    }
}
