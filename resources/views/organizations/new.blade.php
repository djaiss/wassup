<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-xl sm:px-0">
      <div class="overflow-hidden border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
        <livewire:organizations.create />
      </div>
    </div>
  </div>
</x-app-layout>
