<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('API Tokens') }}
    </h2>
  </x-slot>

  <div>
    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
      @livewire('api.api-token-manager')
    </div>
  </div>
</x-app-layout>
