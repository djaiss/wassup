<x-app-layout>
  <div class="py-3 sm:py-12">
    <div class="mx-auto max-w-xl px-2 sm:px-0">
      @if ($organizations->count() > 0)
        <div class="flex justify-end items-center gap-3 my-8">
          <x-secondary-button hover="true" href="{{ route('organizations.new') }}">{{ __('Create an organization') }}</x-secondary-button>
          <span class="text-gray-500">{{ __('or') }}</span>
          <x-secondary-button hover="true" href="{{ route('organizations.join') }}">{{ __('Join an existing organization') }}</x-secondary-button>
        </div>
      @endif

      <div class="overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
        @forelse ($organizations as $organization)
          <div class="flex items-center justify-between border-b border-gray-200 px-3 py-2 last:border-b-0">
            <div>
              {{ $organization['name'] }}
            </div>

            <div>
              <x-secondary-button hover="true" href="{{ route('organizations.show', ['slug' => $organization['slug']]) }}" class="">{{ __('Visit') }}</x-secondary-button>
            </div>
          </div>
        @empty
          <div class="flex border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
            <img src="/img/welcome.png" class="mr-6 h-28" />
            <div>
              <h1 class="mb-6 text-2xl font-medium text-gray-900 dark:text-white">{{ __('Welcome to your Wassup account!') }}</h1>
              <p class="text-gray-500 dark:text-gray-400">{{ __('It appears you are not part of an organization yet. You can either ask your organization\'s administrator to add you, or you can create an organization yourself.') }}</p>
            </div>
          </div>

          <div class="flex items-center justify-center flex-col">
            <x-secondary-button hover="true" href="{{ route('organizations.new') }}" class="mt-4">{{ __('Create an organization') }}</x-secondary-button>

            <span class="text-gray-500 my-5">{{ __('or') }}</span>

            <x-secondary-button hover="true" href="{{ route('organizations.join') }}" class="mb-4">{{ __('Join an existing organization') }}</x-secondary-button>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
