<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-4">
      <!-- cycle title -->
      <div class="mb-6 flex justify-between">
        <h2 class="text-xl font-bold">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $cycle->number]) }}</h2>

        @if ($cycle->is_active)
          <div class="flex items-center rounded-lg border border-green-900 bg-green-50 px-2 py-0 text-xs text-green-900">
            <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <circle cx="12" cy="12" r="1" />
            </svg>

            <span>{{ __('Active') }}</span>
          </div>
        @else
          <div class="flex items-center rounded-lg border border-red-900 bg-yellow-100 px-2 py-0 text-xs text-red-900">
            <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 17h2" />
              <path d="M12 22h2" />
              <path d="M12 2h2" />
              <path d="M18 22h1a1 1 0 0 0 1-1" />
              <path d="M18 2h1a1 1 0 0 1 1 1v1" />
              <path d="M20 15v2h-2" />
              <path d="M20 8v3" />
              <path d="M4 11V9" />
              <path d="M4 19.5V15" />
              <path d="M4 5v-.5A2.5 2.5 0 0 1 6.5 2H8" />
              <path d="M8 22H6.5a1 1 0 0 1 0-5H8" />
            </svg>

            <span>{{ __('Draft') }}</span>
          </div>
        @endif
      </div>

      <!-- cycle tab: description, goals, check-ins -->
      <div class="mb-8 flex justify-center">
        <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
            <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle]) }}" wire:navigate.hover class="rounded-l-md px-3 py-1 text-sm shadow-sm hover:bg-white">{{ __('Description') }}</a>
            <a href="{{ route('goals.index', ['slug' => $organization->slug, 'cycle' => $cycle]) }}" class="bg-white px-3 py-1 text-sm font-medium shadow-sm hover:bg-white">{{ __('Goals') }}</a>
          </div>
        </div>
      </div>

      <!-- goals detaisl -->
      <div class="goal-grid grid gap-4">
        <!-- left -->
        <div>
          @foreach ($members as $member)
            <livewire:organizations.goals.goal lazy :member="$member" />
          @endforeach
        </div>

        <!-- right -->
        <div class="bg-white px-3 py-3">
          <div>
            1.5 average goal per member
          </div>

          <div>
            33 goals total
          </div>

          <!-- high level overview of goals for members -->
          @foreach ($members as $member)
            <div class="flex justify-between">
              <div class="flex items-center">
                <img class="mr-3 h-6 w-6 rounded-full object-cover" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
                <span>{{ $member->user->name }}</span>
              </div>
              <span>3</span>
            </div>
          @endforeach
        </div>
      </div>

      @if ($goals->count() == 0)
        <div class="mb-8 flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-white p-10">
          <img src="/img/goal-blank.png" class="mb-10 w-40" />

          <h2 class="mb-6 text-xl font-bold">{{ __('Goals let you track what people should do in the cycle.') }}</h2>

          <p class="mb-8">{{ __('Think of cycles as time-boxed periods where everyone will work on what needs to be done.') }}</p>

          <div class="">
            <x-secondary-button hover="true" href="{{ route('organizations.cycles.new', ['slug' => $organization->slug]) }}">
              {{ __('Add a goal') }}
            </x-secondary-button>
          </div>
        </div>
      @endif

      <!-- cycle selector -->
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
