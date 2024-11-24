<div class="rounded-lg border border-gray-200 bg-white mb-8">
  <div class="flex justify-between items-center border-b border-gray-200 rounded-t-lg px-4 py-1 bg-sky-50">
    <div class="flex items-center">
      <img class="mr-3 h-6 w-6 rounded-full object-cover border border-gray-200" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
      <span class="text-sm font-medium">{{ $member->user->name }}</span>
    </div>

    <div>
      <span wire:click="toggleAddMode" class="inline-flex cursor-pointer items-center justify-center rounded-md text-sm font-normal transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-gray-200 hover:border-gray-400 bg-white shadow-sm hover:bg-gray-100 px-3 py-1">
        <x-lucide-plus class="h-3 w-3 mr-1" />
        {{ __('Add') }}
      </span>
    </div>
  </div>

  <div class="flex justify-between items-center mb-1 last:mb-0 px-4 py-2 border-b border-gray-200">
    <div class="flex">
      <x-lucide-square-check-big class="h-4 w-4 mr-2 relative top-1 text-gray-400 flex-shrink-0" />
      <span>Id fugiat fugiat enim exercitation Lorem adipisicing dolore dolore.</span>
    </div>

    <x-lucide-ellipsis class="h-4 w-4 text-gray-400 flex-shrink-0" />
  </div>

  @if ($addMode)
  <form class="flex mb-1 last:mb-0 px-4 py-2 border-b border-gray-200">
    <x-input type="text" class="block w-full mr-2" wire:model="state.name" data-1p-ignore required autofocus autocomplete="name" />

    <x-button wire:loading.attr="disabled" wire:target="photo">
      {{ __('Save') }}
    </x-button>
  </form>
  @endif
</div>
