<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
  </head>
  <body class="antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      @if ($organization->id > 0)
        <div class="bg-stone-950">
          <div class="mx-auto flex max-w-7xl px-4 py-2 text-sm text-slate-300 sm:px-4">
            <a wire:navigate href="{{ route('organizations.index') }}">{{ __('All organizations') }}</a>
            <p class="mx-2">/</p>
            <p>{{ $organization->name }}</p>
          </div>
        </div>
      @endif

      @include('navigation-menu', ['organization' => $organization, 'member' => $member])

      <!-- Page Heading -->
      @if (isset($header))
        <header class="bg-white shadow dark:bg-gray-800">
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-4">
            {{ $header }}
          </div>
        </header>
      @endif

      <!-- Page Content -->
      <main>
        {{ $slot }}
      </main>
    </div>

    @stack('modals')

    <x-toaster-hub />
    @livewireScripts
  </body>
</html>
