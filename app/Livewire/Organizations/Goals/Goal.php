<?php

namespace App\Livewire\Organizations\Goals;

use App\Actions\CreateGoal;
use App\Models\Cycle;
use App\Models\Member;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Masmerise\Toaster\Toaster;

class Goal extends Component
{
    #[Locked]
    public Member $member;

    #[Locked]
    public Cycle $cycle;

    #[Locked]
    public Collection $goals;

    #[Validate('required|string|min:3|max:1000')]
    public string $title = '';

    #[Validate('nullable|string|min:3|max:2000')]
    public ?string $description = null;

    public bool $addMode = false;

    public function mount(Member $member, Cycle $cycle): void
    {
        $this->member = $member;
        $this->cycle = $cycle;
    }

    public function render()
    {
        return view('livewire.organizations.goals.goal');
    }

    public function toggleAddMode(): void
    {
        $this->addMode = !$this->addMode;
        $this->title = '';
    }

    public function store(): void
    {
        $this->validate([
            'title' => 'required|string|min:3|max:1000',
            'description' => 'nullable|string|min:3|max:2000',
        ]);

        (new CreateGoal(
            cycle: $this->cycle,
            title: $this->title,
            description: $this->description,
        ))->execute();

        Toaster::success(__('Goal created'));

        $this->toggleAddMode();
    }
}
