<?php

namespace App\Livewire\Organizations\Cycles;

use App\Actions\ToggleCycle;
use App\Models\Cycle;
use Livewire\Component;
use Livewire\Attributes\Locked;

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

        $this->redirectRoute('organizations.cycles.show', [
            'slug' => $this->cycle->organization->slug,
            'cycle' => $this->cycle->number,
        ]);
    }
}
