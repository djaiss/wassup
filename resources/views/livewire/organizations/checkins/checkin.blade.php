<div class="">
  <form wire:submit="store" class="mb-4 rounded-lg border border-gray-200 bg-white p-4" x-data="{ isEditing: false }">
    <x-textarea wire:model="content" :height="'min-h-[100px]'" placeholder="{{ __('Tell us what you have done today or this week.') }}" class="mb-2 w-full" x-on:focus="isEditing = true" x-on:blur="isEditing = false" />

    <!-- actions -->
    <div
      class="flex items-center justify-end"
      x-show="isEditing"
      x-cloak
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 transform scale-95"
      x-transition:enter-end="opacity-100 transform scale-100"
      x-transition:leave="transition ease-in duration-100"
      x-transition:leave-start="opacity-100 transform scale-100"
      x-transition:leave-end="opacity-0 transform scale-95"
    >
      <x-button type="submit">
        {{ __('Save') }}
      </x-button>
    </div>
  </form>

  @forelse ($checkins as $checkin)
  <div class="mb-5">
    <!-- avatar + date -->
    <div class="mb-1 flex justify-between">
      <img class="h-6 w-6 rounded-full border border-gray-200 object-cover ring-1 ring-slate-900/10 shadow" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
      <span x-data x-init="$el.textContent = new Date('{{ $checkin['created_at'] }}').toLocaleString()" class="text-xs text-gray-600"></span>
    </div>

    <!-- checkin text -->
    <div class="prose rounded-lg border border-gray-200 bg-white p-4">
      {!! $checkin['content'] !!}
    </div>
  </div>
  @empty
    <div class="rounded-lg border border-gray-200 bg-white p-4 flex justify-center">
      <div class="flex flex-col items-center space-x-2">
      <x-lucide-megaphone class="h-4 w-4 text-gray-500 mb-2" />
      <span class="text-sm text-gray-500">{{ __('No checkins yet for this period yet') }}</span>
      </div>
    </div>
  @endforelse
</div>
