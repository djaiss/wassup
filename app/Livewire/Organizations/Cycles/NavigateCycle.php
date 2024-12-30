<?php

namespace App\Livewire\Organizations\Cycles;

use App\Models\Cycle;
use Livewire\Attributes\Locked;
use Livewire\Component;

class NavigateCycle extends Component
{
    #[Locked]
    public Cycle $cycle;

    public function render()
    {
        $organization = $this->cycle->organization;

        $nextCycle = $organization->cycles()
            ->where('number', $this->cycle->number + 1)
            ->first();

        $previousCycle = $organization->cycles()
            ->where('number', $this->cycle->number - 1)
            ->first();

        return view('livewire.organizations.cycles.navigate', [
            'cycles' => [
                'previous' => [
                    'number' => $previousCycle?->number,
                ],
                'next' => [
                    'number' => $nextCycle?->number,
                ],
            ],
            'url' => [
                'new' => route('organizations.cycles.new', ['slug' => $organization->slug]),
                'previous' => $previousCycle ? route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $previousCycle->number]) : null,
                'next' => $nextCycle ? route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $nextCycle->number]) : null,
            ],
        ]);
    }
}
