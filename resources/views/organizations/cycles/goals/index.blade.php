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
            <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" wire:navigate.hover class="rounded-l-md px-3 py-1 text-sm shadow-sm hover:bg-white">{{ __('Description') }}</a>
            <a href="{{ route('goals.index', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" class="bg-white px-3 py-1 text-sm font-medium shadow-sm hover:bg-white">{{ __('Goals') }}</a>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-auto max-w-3xl px-2 sm:px-4">
      <div>
        @foreach ($members as $member)
        <livewire:organizations.goals.goal-details lazy :member="$member" :cycle="$cycle" />
        @endforeach
      </div>

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
