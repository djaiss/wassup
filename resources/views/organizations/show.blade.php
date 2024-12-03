<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-4">
      <!-- check if there is a cycle -->
      @if ($cycle)
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
              <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" class="rounded-l-md bg-white px-3 py-1 text-sm font-medium shadow-sm hover:bg-white">{{ __('Description') }}</a>
              <a href="{{ route('goals.index', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" wire:navigate.hover class="px-3 py-1 text-sm hover:bg-white hover:shadow-sm">{{ __('Goals') }}</a>
              <a href="" class="rounded-r-md px-3 py-1 text-sm hover:bg-white hover:shadow-sm">{{ __('Check-ins') }}</a>
            </div>
          </div>
        </div>

        <!-- cycle description -->
        <div class="mb-8 rounded-md border border-gray-200 bg-white sm:rounded-lg">
          <div class="prose mx-auto px-4 py-8">
            {!! $cycle->getMarkdownDescription() !!}
          </div>

          <!-- cycle options -->
          <div>
            <!-- toggle -->
            <div class="flex justify-between border-t border-gray-200 px-4 py-3">
              <div class="flex items-center">
                <x-lucide-thumbs-up class="mr-3 h-5 w-5 text-gray-600" />

                <div class="flex flex-col">
                  <p class="text-sm">{{ __('Make this cycle active') }}</p>
                  <p class="text-xs text-gray-600">{{ __('This will disable any other active cycles.') }}</p>
                </div>
              </div>

              <livewire:organizations.cycles.toggle :cycle="$cycle" />
            </div>

            <!-- edit -->
            <div class="flex justify-between border-t border-gray-200 px-4 py-3">
              <div class="flex items-center">
                <x-lucide-pen class="mr-3 h-5 w-5 text-gray-600" />

                <div class="flex flex-col">
                  <p class="text-sm">{{ __('Edit the cycle\'s description') }}</p>
                  <p class="text-xs text-gray-600">{{ __('Maybe the cycle has changed and it\'s time for adjustements.') }}</p>
                </div>
              </div>

              <div class="flex items-center">
                <x-secondary-button hover="true" href="{{ route('organizations.cycles.edit', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}">
                  {{ __('Edit') }}
                </x-secondary-button>
              </div>
            </div>

            <!-- delete -->
            <div class="flex justify-between border-t border-gray-200 px-4 py-3">
              <div class="flex items-center">
                <x-lucide-trash class="mr-3 h-5 w-5 text-gray-600" />

                <div class="flex flex-col">
                  <p class="text-sm">{{ __('Delete the cycle') }}</p>
                  <p class="text-xs text-gray-600">{{ __('It will be immediately deleted.') }}</p>
                </div>
              </div>

              <div class="flex items-center">
                <x-secondary-button hover="true" href="{{ route('organizations.cycles.delete', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}">
                  {{ __('Delete') }}
                </x-secondary-button>
              </div>
            </div>
          </div>
        </div>

        <!-- cycle selector -->
        <div class="grid grid-cols-1 sm:grid-cols-3">
          <!-- previous cycle -->
          <div class="flex items-center">
            @if ($previousCycle)
              <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $previousCycle->number]) }}" wire:navigate.hover class="mr-2 rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
                <x-lucide-arrow-left class="h-5 w-5" />
              </a>

              <div class="flex flex-col">
                <p class="text-sm">{{ __('Previous cycle') }}</p>
                <p class="text-xs text-gray-600">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $previousCycle->number]) }}</p>
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
                <p class="text-xs text-gray-600">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $nextCycle->number]) }}</p>
              </div>

              <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $nextCycle->number]) }}" wire:navigate.hover class="rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
                <x-lucide-arrow-right class="h-5 w-5" />
              </a>
            @endif
          </div>
        </div>
      @else
        <!-- blank state -->
        <div class="flex flex-col items-center justify-center rounded-lg border border-gray-200 bg-white p-10">
          <img src="/img/cycle-blank.png" class="mb-10 w-20" />

          <h2 class="mb-6 text-xl font-bold">{{ __('It\'s time to create your first cycle.') }}</h2>

          <p class="mb-8">{{ __('Think of cycles as time-boxed periods where everyone will work on what needs to be done.') }}</p>

          <div>
            <x-secondary-button hover="true" href="{{ route('organizations.cycles.new', ['slug' => $organization->slug]) }}">
              {{ __('Draft a new cycle') }}
            </x-secondary-button>
          </div>
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
