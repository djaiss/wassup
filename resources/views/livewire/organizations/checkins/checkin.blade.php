<div class="">
  <form wire:submit="store" class="mb-4 rounded-lg border border-gray-200 bg-white p-4" x-data="{ isEditing: false }">
    <x-textarea wire:model="content" :height="'min-h-[100px]'" placeholder="{{ __('Tell us what you have done today or this week.') }}" class="mb-2 w-full" x-on:focus="isEditing = true" x-on:blur="isEditing = false" />

    <!-- actions -->
    <div class="flex items-center justify-end" x-show="isEditing" x-cloak x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="scale-95 transform opacity-0" x-transition:enter-end="scale-100 transform opacity-100" x-transition:leave="transition duration-100 ease-in" x-transition:leave-start="scale-100 transform opacity-100" x-transition:leave-end="scale-95 transform opacity-0">
      <x-button type="submit">
        {{ __('Save') }}
      </x-button>
    </div>
  </form>

  @forelse ($checkins as $checkin)
    <div class="mb-5">
      <!-- avatar + date -->
      <div class="mb-1 flex justify-between">
        <img class="h-6 w-6 rounded-full border border-gray-200 object-cover shadow ring-1 ring-slate-900/10" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
        <span x-data x-init="$el.textContent = new Date('{{ $checkin['created_at'] }}').toLocaleString()" class="text-xs text-gray-600"></span>
      </div>

      <!-- checkin text -->
      <div class="prose rounded-lg border border-gray-200 bg-white p-4">
        {!! $checkin['content'] !!}
      </div>
    </div>
  @empty
    <div class="flex justify-center rounded-lg border border-gray-200 bg-white p-4">
      <div class="flex flex-col items-center space-x-2">
        <x-lucide-megaphone class="mb-2 h-4 w-4 text-gray-500" />
        <span class="text-sm text-gray-500">{{ __('No checkins yet for this period yet') }}</span>
      </div>
    </div>
  @endforelse
</div>
