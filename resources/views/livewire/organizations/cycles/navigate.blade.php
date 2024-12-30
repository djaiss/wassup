<?php
/**

 * @var array $url
 */
?>

<div class="grid grid-cols-1 sm:grid-cols-3">
  <!-- previous cycle -->
  <div class="flex items-center">
    @if ($url['previous'])
      <a href="{{ $url['previous'] }}" wire:navigate.hover class="mr-2 rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
        <x-lucide-arrow-left class="h-5 w-5" />
      </a>

      <div class="flex flex-col">
        <p class="text-sm">{{ __('Previous cycle') }}</p>
        <p class="text-xs text-gray-600">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $cycles['previous']['number']]) }}</p>
      </div>
    @endif
  </div>

  <!-- draft new cycle -->
  <div class="place-self-center">
    <x-secondary-button hover="true" href="{{ $url['new'] }}">
      {{ __('Draft new cycle') }}
    </x-secondary-button>
  </div>

  <!-- next cycle -->
  <div class="flex items-center place-self-end">
    @if ($url['next'])
      <div class="mr-2 flex flex-col">
        <p class="text-sm">{{ __('Next cycle') }}</p>
        <p class="text-xs text-gray-600">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $cycles['next']['number']]) }}</p>
      </div>

      <a href="{{ $url['next'] }}" wire:navigate.hover class="rounded-full border bg-white p-3 hover:border-gray-400 hover:bg-gray-100">
        <x-lucide-arrow-right class="h-5 w-5" />
      </a>
    @endif
  </div>
</div>
