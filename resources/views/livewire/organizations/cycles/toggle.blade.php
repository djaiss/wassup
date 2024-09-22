<div wire:click="toggle" x-data="{ switchOn: {{ $cycle->is_active ? 'true' : 'false' }} }" class="flex items-center justify-center space-x-2">
  <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn" />

  <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn" :class="switchOn ? 'bg-blue-600' : 'bg-neutral-200'" class="relative ml-2 inline-flex h-4 w-8 rounded-full py-0.5 focus:outline-none" x-cloak>
    <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="h-3 w-3 rounded-full bg-white shadow-md duration-200 ease-in-out"></span>
  </button>
</div>
