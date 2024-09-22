<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-4">
      @if ($cycle)
        <!-- cycle selector -->
        <div class="mb-8 grid grid-cols-1 sm:grid-cols-3">
          <!-- previous cycle -->
          <div class="flex items-center">
            @if ($previousCycle)
              <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $previousCycle->number]) }}" wire:navigate class="mr-2 rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
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

              <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $nextCycle->number]) }}" wire:navigate class="rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
              </a>
            @endif
          </div>
        </div>

        <!-- cycle title -->
        <div class="mb-6 flex justify-between">
          <h2 class="text-xl font-bold">Cycle #{{ $cycle->number }}</h2>

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

        <div class="mb-8 flex justify-center">
          <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
            <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
              <div class="bg-white">
                <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

                <label for="all" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="all">Description</label>
              </div>
              <div class="bg-white">
                <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

                <label for="unread" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="unread">Goals</label>
              </div>
              <div>
                <input type="radio" :name="name" x-model="__selected" id="unread" value="unread" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" />

                <label for="unread" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="unread">Check-ins</label>
              </div>
            </div>
          </div>
        </div>

        <!-- cycle description -->
        <div class="mb-5 rounded-md border border-gray-200 bg-white sm:rounded-lg">
          <div class="prose mx-auto px-4 py-8">
            {!! $cycle->getMarkdownDescription() !!}
          </div>

          <!-- cycle options -->
          <div>
            <!-- toggle -->
            <div class="flex justify-between border-t border-gray-200 px-4 py-3">
              <div class="flex items-center">
                <svg class="mr-3 h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                </svg>

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
                <svg class="mr-3 h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>

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
                <svg class="mr-3 h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>

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
      @else
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

<!-- post input -->
{{--
  <div class="mb-3 overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
  <div class="flex items-center px-4 py-2">
  <img class="mr-2 h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
  
  <input type="text" class="w-full rounded-lg border-none bg-gray-100 focus:ring-0" placeholder="What's on your mind?" />
  </div>
  </div>
--}}
