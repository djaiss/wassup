<div>
  <div class="mb-1 flex items-center justify-between">
    <div class="flex items-center">
      <img class="mr-3 h-6 w-6 rounded-full border border-gray-200 object-cover" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
      <span class="text-sm font-medium">{{ $member->user->name }}</span>
    </div>

    <div>
      <span wire:click="toggleAddMode" class="focus-visible:ring-ring inline-flex cursor-pointer items-center justify-center rounded-md border border-gray-200 bg-white px-3 py-1 text-sm font-normal transition-colors hover:border-gray-400 hover:bg-gray-100 focus-visible:outline-none focus-visible:ring-1">
        <x-lucide-plus class="mr-1 h-3 w-3" />
        {{ __('Add') }}
      </span>
    </div>
  </div>

  <div class="mb-8 rounded-lg border border-gray-200 bg-white">
    @forelse ($goals as $goal)
      @if ($editedGoalId !== $goal['id'])
        <div class="mb-1 flex items-center justify-between rounded-t-lg border-b border-gray-200 px-4 py-2 last:mb-0 last:rounded-b-lg last:border-b-0 hover:bg-cyan-50">
          <div class="flex flex-col space-y-1">
            <div>{{ $goal['title'] }}</div>
            <div class="flex">
              <div class="flex items-center">
                <x-lucide-folder-kanban class="mr-2 h-4 w-4 flex-shrink-0 text-gray-400" />
                <span class="text-sm text-gray-500">Refonte du site marketing</span>
              </div>
            </div>
          </div>

          <div x-data="{ dropdownOpen: false }" class="relative">
            <x-lucide-ellipsis @click="dropdownOpen=true" class="h-4 w-4 cursor-pointer text-gray-500" />

            <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="duration-200 ease-out" x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" class="absolute -top-5 left-1/2 z-50 mt-12 w-32 -translate-x-1/2" x-cloak>
              <div class="mt-1 rounded-md border border-neutral-200/70 bg-white p-1 text-neutral-700 shadow-md">
                <span wire:click="toggleEditMode({{ $goal['id'] }})" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                  <x-lucide-pencil class="mr-2 h-4 w-4 text-gray-600" />
                  <span>{{ __('Edit') }}</span>
                </span>
                <span wire:click="delete({{ $goal['id'] }})" wire:confirm="{{ __('Are you sure you want to proceed? This can not be undone.') }}" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                  <x-lucide-trash-2 class="mr-2 h-4 w-4 text-gray-600" />
                  <span>{{ __('Delete') }}</span>
                </span>
              </div>
            </div>
          </div>
        </div>
      @else
        <form x-data="{ addDescription: false }" wire:submit="update({{ $goal['id'] }})" class="mb-1 px-4 py-2 last:mb-0">
          <!-- when description is not added -->
          <div x-show="!addDescription" class="flex flex-col">
            <div class="flex">
              <x-input wire:model="title" wire:keydown.esc="resetEdit" type="text" class="mr-2 block w-full" data-1p-ignore required autofocus autocomplete="title" />

              <x-button wire:loading.attr="disabled">
                {{ __('Save') }}
              </x-button>
            </div>
            <span @click="addDescription = true" class="mt-1 cursor-pointer text-xs text-gray-500 hover:underline">{{ __('+ add description') }}</span>
          </div>

          <!-- when description is added -->
          <div x-show="addDescription" class="flex flex-col space-y-4">
            <div class="flex flex-col space-y-4">
              <div>
                <x-label for="title" :value="__('Title')" class="mb-1" />
                <x-input wire:model="title" wire:keydown.esc="toggleAddMode" type="text" class="mr-2 block w-full" data-1p-ignore required autofocus autocomplete="title" />
                <x-input-error for="title" class="mt-2" />
              </div>

              <div>
                <x-label for="description" :value="__('Give more details about this goal')" class="mb-1" />
                <x-textarea wire:model="description" id="description" class="w-full" :height="'min-h-[300px]'" />
                <x-input-error for="description" class="mt-2" />
              </div>
            </div>

            <div class="flex">
              <x-button wire:loading.attr="disabled" class="mr-2">
                {{ __('Save') }}
              </x-button>

              <x-secondary-button wire:click="resetEdit">
                {{ __('Cancel') }}
              </x-secondary-button>
            </div>
          </div>
        </form>
      @endif
    @empty
      @if (! $addMode)
        <div id="blank-state" class="px-4 py-2 text-sm text-gray-500">{{ __('No goals found') }}</div>
      @endif
    @endforelse

    @if ($addMode)
      <form x-data="{ addDescription: false }" wire:submit="store" class="mb-1 px-4 py-2 last:mb-0">
        <!-- when description is not added -->
        <div x-show="!addDescription" class="flex flex-col">
          <div class="flex">
            <x-input wire:model="title" wire:keydown.esc="resetEdit" type="text" class="mr-2 block w-full" data-1p-ignore required autofocus autocomplete="title" />

            <x-button wire:loading.attr="disabled">
              {{ __('Save') }}
            </x-button>
          </div>
          <span @click="addDescription = true" class="mt-1 cursor-pointer text-xs text-gray-500 hover:underline">{{ __('+ add description') }}</span>
        </div>

        <!-- when description is added -->
        <div x-show="addDescription" class="flex flex-col space-y-4">
          <div class="flex flex-col space-y-4">
            <div>
              <x-label for="title" :value="__('Title')" class="mb-1" />
              <x-input wire:model="title" wire:keydown.esc="toggleAddMode" type="text" class="mr-2 block w-full" data-1p-ignore required autofocus autocomplete="title" />
              <x-input-error for="title" class="mt-2" />
            </div>

            <div>
              <x-label for="description" :value="__('Give more details about this goal')" class="mb-1" />
              <x-textarea wire:model="description" id="description" class="w-full" :height="'min-h-[300px]'" />
              <x-input-error for="description" class="mt-2" />
            </div>
          </div>

          <div class="flex">
            <x-button wire:loading.attr="disabled" class="mr-2">
              {{ __('Save') }}
            </x-button>

            <x-secondary-button wire:click="toggleAddMode">
              {{ __('Cancel') }}
            </x-secondary-button>
          </div>
        </div>
      </form>
    @endif
  </div>
</div>
