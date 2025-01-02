<?php
/**
 * @var \App\Models\Organization $organization
 * @var \App\Models\Member $member
 * @var \App\Models\Cycle $cycle
 * @var \Illuminate\Support\Collection $members
 */
?>

<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-4">
      <!-- cycle title -->
      <x-cycle-header :cycle="$cycle" />

      <!-- cycle tab: description, goals, check-ins -->
      <div class="mb-8 flex justify-center">
        <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
            <a href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" wire:navigate.hover class="rounded-l-md px-3 py-1 text-sm shadow-sm hover:bg-white">{{ __('Description') }}</a>
            <a href="{{ route('organizations.goals.index', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" class="bg-white px-3 py-1 text-sm font-medium shadow-sm hover:bg-white">{{ __('Goals for the cycle') }}</a>
            <a href="{{ route('organizations.checkins.index', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" wire:navigate.hover class="rounded-r-md px-3 py-1 text-sm hover:bg-white hover:shadow-sm">{{ __('Check-ins') }}</a>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-auto max-w-3xl px-2 sm:px-4">
      <div>
        @foreach ($members as $member)
          <livewire:organizations.goals.goal-details lazy :member="$member" :cycle="$cycle" />
        @endforeach
      </div>

      <!-- cycle selector -->
      <livewire:organizations.cycles.navigate-cycle lazy :cycle="$cycle" />
    </div>
  </div>
</x-app-layout>
