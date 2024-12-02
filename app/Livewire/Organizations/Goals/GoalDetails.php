<?php

namespace App\Livewire\Organizations\Goals;

use App\Actions\CreateGoal;
use App\Actions\DestroyGoal;
use App\Actions\UpdateGoal;
use App\Http\ViewModels\GoalViewModel;
use App\Models\Cycle;
use App\Models\Goal;
use App\Models\Member;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class GoalDetails extends Component
{
    #[Locked]
    public Member $member;

    #[Locked]
    public Cycle $cycle;

    #[Locked]
    public Collection $goals;

    #[Locked]
    public int $editedGoalId = 0;

    #[Validate('required|string|min:3|max:1000')]
    public string $title = '';

    #[Validate('nullable|string|min:3|max:2000')]
    public ?string $description = null;

    public bool $addMode = false;

    public function mount(Member $member, Cycle $cycle): void
    {
        $this->member = $member;
        $this->cycle = $cycle;
        $this->goals = collect(GoalViewModel::index($cycle, $member));
    }

    public function render()
    {
        return view('livewire.organizations.goals.goal');
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div class="border-b border-gray-200 bg-white mb-4">
            <div class="flex flex-col space-y-3">
                <div class="animate-pulse bg-slate-200 h-[125px] w-full rounded-xl"></div>
                <div class="space-y-2">
                    <div class="bg-slate-200 animate-pulse rounded-md bg-muted h-4 w-full"></div>
                    <div class="bg-slate-200 animate-pulse rounded-md bg-muted h-4 w-[200px]"></div>
                </div>
            </div>
        </div>
        HTML;
    }

    public function toggleAddMode(): void
    {
        $this->addMode = ! $this->addMode;
        $this->title = '';
    }

    public function store(): void
    {
        $this->validate([
            'title' => 'required|string|min:3|max:1000',
            'description' => 'nullable|string|min:3|max:2000',
        ]);

        $goal =(new CreateGoal(
            member: $this->member,
            cycle: $this->cycle,
            title: $this->title,
            description: $this->description,
        ))->execute();

        Toaster::success(__('Goal created'));

        $this->goals = $this->goals->prepend(GoalViewModel::goal($goal));

        $this->toggleAddMode();
    }

    public function toggleEditMode(int $goalId): void
    {
        $this->editedGoalId = $goalId;

        $goal = $this->goals->firstWhere('id', $goalId);
        $this->title = $goal['title'];
        $this->description = $goal['description'];
    }

    public function update(int $goalId): void
    {
        $this->validate([
            'title' => 'required|string|min:3|max:1000',
            'description' => 'nullable|string|min:3|max:2000',
        ]);

        $goal = Goal::where('member_id', $this->member->id)
            ->findOrFail($goalId);

        (new UpdateGoal(
            goal: $goal,
            member: $this->member,
            title: $this->title,
            description: $this->description,
        ))->execute();

        $this->resetEdit();

        Toaster::success(__('Goal updated'));

        $goal = GoalViewModel::goal($goal);

        $this->goals = $this->goals->map(fn(array $existingGoal): array => $existingGoal['id'] === $goalId ? $goal : $existingGoal);
    }

    public function resetEdit(): void
    {
        $this->editedGoalId = 0;
        $this->title = '';
        $this->description = null;
        $this->resetErrorBag();
    }

    public function delete(int $goalId): void
    {
        $goal = Goal::where('member_id', $this->member->id)
            ->findOrFail($goalId);

        (new DestroyGoal(
            goal: $goal,
        ))->execute();

        Toaster::success(__('Goal deleted'));

        $this->goals = $this->goals->reject(fn(array $goal): bool => $goal['id'] === $goalId);
    }
}
