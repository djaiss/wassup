<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-xl px-2 sm:px-0">
      <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
        <form action="{{ route('organizations.cycles.destroy', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
            <h1 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">{{ __('Delete cycle #') }}{{ $cycle->number }}</h1>

            <p class="text-gray-500 dark:text-gray-400">{{ __('This will delete everything in this cycle, including goals and check-ins.') }}</p>
          </div>


            <div class="flex justify-between p-5">
              <x-secondary-button hover="true" href="{{ route('organizations.cycles.show', ['slug' => $organization->slug, 'cycle' => $cycle->number]) }}">
                {{ __('Cancel') }}
              </x-secondary-button>

              <x-button>
                {{ __('Delete') }}
              </x-button>
            </div>
        </form>
      </div>

    </div>
  </div>
</x-app-layout>
