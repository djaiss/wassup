<?php
/**
 * @var int $cycleNumber
 * @var array $url
 */
?>

<form wire:submit="store" class="grid grid-rows-2 gap-4 sm:grid-cols-6 sm:grid-rows-1">
  <div class="col-span-6 overflow-hidden rounded-md border border-gray-200 bg-white sm:col-start-1 sm:col-end-6 sm:rounded-lg dark:bg-gray-800">
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
      <x-textarea wire:model="description" id="description" class="w-full" :height="'min-h-[600px]'" required />
      <p class="mt-1 text-xs text-gray-600">{{ __('This editor supports markdown.') }}</p>
      <x-input-error for="description" class="mt-2" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-1">
    <x-button class="mb-3 w-full text-center">
      {{ __('Save') }}
    </x-button>

    <x-secondary-button hover="true" href="{{ $url['back'] }}" class="w-full">
      {{ __('Back') }}
    </x-secondary-button>
  </div>
</form>
