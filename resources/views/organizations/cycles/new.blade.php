<?php
/**
 * @var \App\Models\Organization $organization
 * @var \App\Models\Member $member
 */
?>

<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-0">
      <livewire:organizations.cycles.create-cycle :organization="$organization" />
    </div>
  </div>
</x-app-layout>
