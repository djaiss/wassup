<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-xl sm:px-0">
      <div class="overflow-hidden border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
        <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
          <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{ __('Create a new organization') }}</h1>

          <p class="text-gray-500 dark:text-gray-400">{{ __('You will become the administrator of this organization and be able to add other members.') }}</p>
        </div>

        <div class="">
          <div class="p-6">
            <x-label for="organization_name" value="{{ __('Name') }}" class="mb-1" />
            <x-input id="organization_name" type="text" class="block w-full" wire:model="state.organization_name" autofocus />
            <x-input-error for="organization_name" class="mt-2" />
          </div>

          <div class="flex justify-between p-5">
            <x-secondary-button hover="true" href="{{ route('dashboard') }}">
              {{ __('Cancel') }}
            </x-secondary-button>

            <x-button dusk="submit-form-button">
              {{ __('Create') }}
            </x-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
