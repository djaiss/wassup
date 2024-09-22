<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-0">
      <form action="{{ route('organizations.cycles.update', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" method="POST" class="grid grid-cols-6 gap-4">
        @csrf
        @method('PUT')

        <div class="col-start-1 col-end-6 overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
            <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{ __('Edit the cycle') }}</h1>

            <p class="text-gray-500 dark:text-gray-400">{{ __('Think of cycles as time-boxed periods where everyone will work on what needs to be done.') }}</p>
          </div>

          <div class="p-6">
            <x-label for="description" :value="__('Tell your team what this cycle is going to be about')" class="mb-1" />
            <x-textarea name="description" id="description" class="min-h-[400px] w-full" required>{{ $cycle->description }}</x-textarea>
            <p class="mt-1 text-xs text-gray-600">{{ __('This editor supports markdown.') }}</p>
            <x-input-error for="description" class="mt-2" />
          </div>
        </div>

        <div>
          <div class="">
            <x-button class="mb-3 w-full text-center">
              {{ __('Save') }}
            </x-button>

            <x-secondary-button hover="true" href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" class="w-full">
              {{ __('Back') }}
            </x-secondary-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
