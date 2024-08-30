<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-xl sm:px-0">

      @if ($companies->count() > 0)
      <div class="flex justify-end">
        <x-secondary-button hover="true" href="{{ route('organizations.new') }}" class="my-8">{{ __('Create an organization') }}</x-secondary-button>
      </div>
      @endif

      <div class="overflow-hidden border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
        @forelse ($companies as $company)
          <div class="flex items-center justify-between border-b border-gray-200 px-3 py-2 last:border-b-0">
            <div>
              {{ $company['name'] }}
            </div>

            <div>
              <x-secondary-button hover="true" href="{{ route('organizations.new') }}" class="">{{ __('Visit') }}</x-secondary-button>
            </div>
          </div>
        @empty
          <div class="border-b border-gray-200 bg-white p-6 lg:p-8 dark:border-gray-700 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent">
            <h1 class="mb-6 text-2xl font-medium text-gray-900 dark:text-white">{{ __('Welcome to your Wassup account!') }}</h1>
            <p class="text-gray-500 dark:text-gray-400">{{ __('It appears you are not part of an organization yet. You can either ask your organization\'s administrator to add you, or you can create an organization yourself.') }}</p>
          </div>

          <div class="flex items-center justify-center">
            <x-secondary-button hover="true" href="{{ route('organizations.new') }}" class="my-8">{{ __('Create an organization') }}</x-secondary-button>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</x-app-layout>
