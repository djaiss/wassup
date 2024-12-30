<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-4">
      <!-- cycle title -->
      <div class="mb-6 flex justify-between">
        <h2 class="text-xl font-bold">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $cycle->number]) }}</h2>

        @if ($cycle->is_active)
          <div class="flex items-center rounded-lg border border-green-900 bg-green-50 px-2 py-0 text-xs text-green-900">
            <x-lucide-target class="mr-1 h-4 w-4" />

            <span>{{ __('Active') }}</span>
          </div>
        @else
          <div class="flex items-center rounded-lg border border-red-900 bg-yellow-100 px-2 py-0 text-xs text-red-900">
            <x-lucide-book-dashed class="mr-1 h-4 w-4" />

            <span>{{ __('Draft') }}</span>
          </div>
        @endif
      </div>

      <!-- cycle tab: description, goals, check-ins -->
      <div class="mb-8 flex justify-center">
        <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
            <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" wire:navigate.hover class="rounded-l-md px-3 py-1 text-sm hover:bg-white">{{ __('Description') }}</a>
            <a href="{{ route('organizations.goals.index', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" wire:navigate.hover class="px-3 py-1 text-sm hover:bg-white">{{ __('Goals for the cycle') }}</a>
            <a href="{{ route('organizations.checkins.index', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" class="rounded-r-md bg-white px-3 py-1 text-sm font-medium shadow-sm hover:bg-white hover:shadow-sm">{{ __('Check-ins') }}</a>
          </div>
        </div>
      </div>
    </div>

    <!-- week selector -->
    @if ($weeks)
      <div class="mx-auto max-w-6xl px-2 sm:px-4">
        <div class="mb-8 grid grid-flow-col rounded-lg border border-gray-200 bg-white sm:auto-cols-auto">
          @foreach ($weeks as $week)
            <a wire:navigate href="{{ $week['url']['week'] }}" class="{{ $week['is_current_week'] ? 'bg-gray-100' : '' }} flex cursor-pointer flex-col border-r border-gray-200 px-3 py-2 first:rounded-l-lg last:rounded-r-lg hover:bg-gray-100">
              <div class="flex items-center justify-between">
                <div class="text-sm">{{ $week['week'] }}</div>
                <div class="flex items-center text-xs">
                  <div class="flex w-fit items-center space-x-1 rounded-md bg-green-600/10 py-0.5 pl-1 pr-1.5 text-xs text-green-600 dark:bg-green-500/10 dark:text-green-500">
                    <svg class="mr-1 h-3.5 w-3.5">
                      <circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="2" fill="none" class="text-white" />
                      <circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="2" fill="none" class="text-green-600" stroke-dasharray="31.4" stroke-dashoffset="{{ 31.4 - 31.4 * (2 / 19) }}" transform="rotate(-90 7 7)" />
                    </svg>
                    <span>7/19</span>
                  </div>
                </div>
              </div>
              <div class="text-xs text-gray-600">{{ $week['start_day'] }} - {{ $week['end_day'] }}</div>
            </a>
          @endforeach
        </div>
      </div>
    @endif

    <!-- checkins list -->
    <div class="mx-auto mb-10 max-w-4xl px-2 sm:px-4">
      <div class="checkin-grid grid gap-4">
        <!-- list of members -->
        <div class="flex flex-col space-y-1">
          <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-2 py-1.5">
            <div class="flex items-center">
              <span class="text-sm font-medium">{{ __('All members') }}</span>
            </div>
            <div class="flex h-3 w-3 items-center justify-center space-x-0.5 rounded-full bg-green-600/10 dark:bg-green-500/10">
              <div class="h-1 w-1 rounded-full bg-green-600 dark:bg-green-500"></div>
            </div>
          </div>
          <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-2 py-1.5">
            <div class="flex items-center">
              <img class="mr-1 h-6 w-6 rounded-full border border-gray-200 object-cover" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
              <span class="text-sm font-medium">{{ $member->user->name }}</span>
            </div>
            <div class="flex h-3 w-3 items-center justify-center space-x-0.5 rounded-full bg-green-600/10 dark:bg-green-500/10">
              <div class="h-1 w-1 rounded-full bg-green-600 dark:bg-green-500"></div>
            </div>
          </div>
          @foreach ($members as $member)
            <div class="flex items-center justify-between px-2 py-1.5">
              <div class="flex items-center">
                <img class="mr-1 h-6 w-6 rounded-full border border-gray-200 object-cover shadow ring-1 ring-slate-900/10" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
                <span class="text-sm font-medium">{{ $member->user->name }}</span>
              </div>
            </div>
          @endforeach
        </div>

        <!-- checkins -->
        <livewire:organizations.checkins.checkin :member="$member" :cycle="$cycle" :startDay="$day" />
      </div>
    </div>

    <!-- cycle selector -->
    <div class="mx-auto max-w-6xl px-2 sm:px-4">
      <div class="grid grid-cols-1 sm:grid-cols-3">
        <!-- previous cycle -->
        <div class="flex items-center">
          @if ($previousCycle)
            <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $previousCycle->number]) }}" wire:navigate.hover class="mr-2 rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
              </svg>
            </a>

            <div class="flex flex-col">
              <p class="text-sm">{{ __('Previous cycle') }}</p>
              <p class="text-xs text-gray-600">Cycle #{{ $previousCycle->number }}</p>
            </div>
          @endif
        </div>

        <!-- draft new cycle -->
        <div class="place-self-center">
          <x-secondary-button hover="true" href="{{ route('organizations.cycles.new', ['slug' => $organization->slug]) }}">
            {{ __('Draft new cycle') }}
          </x-secondary-button>
        </div>

        <!-- next cycle -->
        <div class="flex items-center place-self-end">
          @if ($nextCycle)
            <div class="mr-2 flex flex-col">
              <p class="text-sm">{{ __('Next cycle') }}</p>
              <p class="text-xs text-gray-600">Cycle #{{ $nextCycle->number }}</p>
            </div>

            <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $nextCycle->number]) }}" wire:navigate.hover class="rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
