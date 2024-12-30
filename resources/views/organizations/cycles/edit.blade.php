<?php
/**
 * @var \App\Models\Organization $organization
 * @var \App\Models\Member $member
 * @var \App\Models\Cycle $cycle
 * @var array $url
 */
?>

<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-0">
      <form action="{{ $url['cycle']['update'] }}" method="POST" class="grid grid-rows-2 gap-4 sm:grid-cols-6 sm:grid-rows-1">
        @csrf
        @method('PUT')

        <div class="col-span-6 overflow-hidden rounded-md border border-gray-200 bg-white sm:col-start-1 sm:col-end-6 sm:rounded-lg dark:bg-gray-800">
          <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
            <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{ __('Edit the cycle') }}</h1>

            <p class="text-gray-500 dark:text-gray-400">{{ __('Think of cycles as time-boxed periods where everyone will work on what needs to be done.') }}</p>
          </div>

          <div class="p-6">
            <x-label for="description" :value="__('Tell your team what this cycle is going to be about')" class="mb-1" />
            <x-textarea name="description" id="description" class="min-h-[400px] w-full" required>{{ $cycle->description }}</x-textarea>
            <p class="mt-1 text-xs text-gray-600">{{ __('This editor supports markdown.') }}</p>
            <x-input-error for="description" class="mt-2" />
          </div>
        </div>

        <div class="col-span-6 sm:col-span-1">
          <x-button class="mb-3 w-full text-center">
            {{ __('Save') }}
          </x-button>

          <x-secondary-button hover="true" href="{{ $url['cycle']['show'] }}" class="w-full">
            {{ __('Back') }}
          </x-secondary-button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
