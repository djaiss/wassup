<div class="mb-8 rounded-lg border border-gray-200 bg-white">
  <div class="flex items-center justify-between rounded-t-lg border-b border-gray-200 bg-sky-50 px-4 py-1">
    <div class="flex items-center">
      <img class="mr-3 h-6 w-6 rounded-full border border-gray-200 object-cover" src="{{ $member->user->profile_photo_url }}" alt="{{ $member->user->name }}" />
      <span class="text-sm font-medium">{{ $member->user->name }}</span>
    </div>

    <div>
      <span wire:click="toggleAddMode" class="focus-visible:ring-ring inline-flex cursor-pointer items-center justify-center rounded-md border border-gray-200 bg-white px-3 py-1 text-sm font-normal shadow-sm transition-colors hover:border-gray-400 hover:bg-gray-100 focus-visible:outline-none focus-visible:ring-1">
        <x-lucide-plus class="mr-1 h-3 w-3" />
        {{ __('Add') }}
      </span>
    </div>
  </div>

  <div class="mb-1 flex items-center justify-between border-b border-gray-200 px-4 py-2 last:mb-0">
    <div class="flex">
      <x-lucide-square-check-big class="relative top-1 mr-2 h-4 w-4 flex-shrink-0 text-gray-400" />
      <span>Id fugiat fugiat enim exercitation Lorem adipisicing dolore dolore.</span>
    </div>

    <x-lucide-ellipsis class="h-4 w-4 flex-shrink-0 text-gray-400" />
  </div>

  @if ($addMode)
    <form class="mb-1 flex border-b border-gray-200 px-4 py-2 last:mb-0">
      <x-input type="text" class="mr-2 block w-full" wire:model="state.name" data-1p-ignore required autofocus autocomplete="name" />

      <x-button wire:loading.attr="disabled" wire:target="photo">
        {{ __('Save') }}
      </x-button>
    </form>
  @endif
</div>
