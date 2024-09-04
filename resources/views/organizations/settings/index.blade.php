<x-app-layout :organization="$organization" :member="$member">
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Settings') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-xl px-2 sm:px-0">{{ $member->permission }}</div>
  </div>
</x-app-layout>
