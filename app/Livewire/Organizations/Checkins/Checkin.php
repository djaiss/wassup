<?php

namespace App\Livewire\Organizations\Checkins;

use App\Actions\CreateCheckin;
use App\Http\ViewModels\CheckinViewModel;
use App\Models\Cycle;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Checkin extends Component
{
    #[Locked]
    public Member $member;

    #[Locked]
    public Cycle $cycle;

    #[Locked]
    public Collection $checkins;

    #[Validate('required|string|min:3|max:1000')]
    public string $content = '';

    public function mount(Member $member, Cycle $cycle, Carbon $startDay): void
    {
        $this->member = $member;
        $this->cycle = $cycle;
        $this->checkins = collect(CheckinViewModel::show($cycle, $member, $startDay));
    }

    public function render()
    {
        return view('livewire.organizations.checkins.checkin');
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div class="border-b border-gray-200 mb-4">
            <div class="flex flex-col space-y-3">
                <div class="flex justify-between">
                    <div class="flex items-center">
                    <div class="bg-slate-200 animate-pulse rounded-full bg-muted h-4 w-[50px] mr-2"></div>
                    <div class="bg-slate-200 animate-pulse rounded-md bg-muted h-4 w-[100px]"></div>
                    </div>
                    <div class="bg-slate-200 animate-pulse rounded-md bg-muted h-4 w-[100px]"></div>
                </div>
                <div class="bg-slate-200 animate-pulse rounded-xl h-[70px] w-full"></div>
            </div>
        </div>
        HTML;
    }

    public function store(): void
    {
        $this->validate([
            'content' => 'required|string|min:3|max:1000',
        ]);

        $checkin = (new CreateCheckin(
            member: $this->member,
            cycle: $this->cycle,
            content: $this->content,
        ))->execute();

        Toaster::success(__('Checkin created'));

        $this->checkins = $this->checkins->prepend(CheckinViewModel::checkin($checkin));

        $this->content = '';
    }
}
