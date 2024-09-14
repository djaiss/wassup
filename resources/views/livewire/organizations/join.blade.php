<div>
  <form wire:submit="store">
    <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
      <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{ __('Join an existing organization') }}</h1>

      <p class="text-gray-500 dark:text-gray-400">{{ __('You will join the organization if you can provide these two information.') }}</p>
    </div>

    <div class="">
      <div class="p-6">
        <x-label for="organization_name" value="{{ __('Name of the organization') }}" class="mb-1" />
        <x-input id="organization_name" type="text" class="block w-full" wire:model="name" required autofocus />
        <x-input-error for="name" class="mt-2" />
      </div>

      <div class="px-6 pb-6">
        <x-label for="code" value="{{ __('Code given by the administrators') }}" class="mb-1" />
        <x-input id="code" type="text" class="block w-full text-center font-mono" wire:model="code" required autofocus />
        <x-input-error for="code" class="mt-2" />
      </div>

      <div class="flex justify-between p-5">
        <x-secondary-button hover="true" href="{{ route('organizations.index') }}">
          {{ __('Cancel') }}
        </x-secondary-button>

        <x-button>
          {{ __('Join') }}
        </x-button>
      </div>
    </div>
  </form>
</div>
