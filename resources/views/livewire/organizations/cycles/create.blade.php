<form wire:submit="store" class="grid grid-cols-6 gap-4">
  <div class="col-start-1 col-end-6 overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
    <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
      <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{ __('Draft a new cycle') }}</h1>

      <p class="text-gray-500 dark:text-gray-400">{{ __('Think of cycles as time-boxed periods where everyone will work on what needs to be done.') }}</p>
    </div>

    <div class="flex">
      <div class="px-6 pt-6">
        <x-label for="number" :value="__('Cycle number')" class="mb-1" />
        <x-input id="number" class="w-full" type="number" :min="$cycleNumber" max="1000" wire:model.defer="cycleNumber" />
        <x-input-error for="name" class="mt-2" />
      </div>
    </div>

    <div class="p-6">
      <x-label for="description" :value="__('Tell your team what this cycle is going to be about')" class="mb-1" />
      <x-textarea wire:model="description" id="description" class="min-h-[600px] w-full" required />
      <p class="mt-1 text-xs text-gray-600">{{ __('This editor supports markdown.') }}</p>
      <x-input-error for="description" class="mt-2" />
    </div>
  </div>

  <div>
    <div class="">
      <x-button class="mb-3 w-full text-center">
        {{ __('Save') }}
      </x-button>

      <x-secondary-button hover="true" href="{{ route('organizations.show', ['slug' => $organization->slug]) }}" class="w-full">
        {{ __('Back') }}
      </x-secondary-button>
    </div>
  </div>
</form>
