<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl px-4 sm:px-4">
    <div class="flex h-16 justify-between">
      <div class="flex">
        <!-- Logo -->
        <div class="flex shrink-0 items-center">
          <a href="{{ route('organizations.index') }}">
            <x-application-mark class="block h-9 w-auto" />
          </a>
        </div>

        <!-- Navigation Links -->
        @if ($organization->id > 0)
          <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link href="{{ route('organizations.show', ['slug' => $organization->slug]) }}" :active="request()->routeIs('organizations.show') || request()->routeIs('organizations.cycles.*') || request()->routeIs('organizations.goals.*') || request()->routeIs('organizations.checkins.*')">
              <x-lucide-refresh-ccw class="h-3 w-3 mr-2" />
              <span>{{ __('Cycles') }}</span>
            </x-nav-link>

            <x-nav-link href="{{ route('organizations.show', ['slug' => $organization->slug]) }}" :active="request()->routeIs('organizations.show')">
              <x-lucide-users class="h-3 w-3 mr-2" />
              {{ __('Projects') }}
            </x-nav-link>

            <x-nav-link href="{{ route('organizations.people.index', ['slug' => $organization->slug]) }}" :active="request()->routeIs('organizations.people.index')">
              <x-lucide-users class="h-3 w-3 mr-2" />
              {{ __('People') }}
            </x-nav-link>

            @if ($member->permission === 'administrator')
              <x-nav-link href="{{ route('organizations.settings.index', ['slug' => $organization->slug]) }}" :active="request()->routeIs('organizations.settings.index')">
                <x-lucide-settings class="h-3 w-3 mr-2" />
                {{ __('Settings') }}
              </x-nav-link>
            @endif
          </div>
        @endif
      </div>

      <div class="hidden sm:ms-6 sm:flex sm:items-center">
        <!-- Teams Dropdown -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <div class="relative ms-3">
            <x-dropdown align="right" width="60">
              <x-slot name="trigger">
                <span class="inline-flex rounded-md">
                  <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                    {{ Auth::user()->currentTeam->name }}

                    <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                  </button>
                </span>
              </x-slot>

              <x-slot name="content">
                <div class="w-60">
                  <!-- Team Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                  </div>

                  <!-- Team Settings -->
                  <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                    {{ __('Team Settings') }}
                  </x-dropdown-link>

                  @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-dropdown-link href="{{ route('teams.create') }}">
                      {{ __('Create New Team') }}
                    </x-dropdown-link>
                  @endcan

                  <!-- Team Switcher -->
                  @if (Auth::user()->allTeams()->count() > 1)
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                      <x-switchable-team :team="$team" />
                    @endforeach
                  @endif
                </div>
              </x-slot>
            </x-dropdown>
          </div>
        @endif

        <!-- Settings Dropdown -->
        <div class="relative ms-3">
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <button class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none">
                  <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </button>
              @else
                <span class="inline-flex rounded-md">
                  <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                    {{ Auth::user()->name }}

                    <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </button>
                </span>
              @endif
            </x-slot>

            <x-slot name="content">
              <!-- Account Management -->
              <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Account') }}
              </div>

              <x-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
              </x-dropdown-link>

              @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                  {{ __('API Tokens') }}
                </x-dropdown-link>
              @endif

              <div class="border-t border-gray-200 dark:border-gray-600"></div>

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        </div>
      </div>

      <!-- Hamburger -->
      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="space-y-1 pb-3 pt-2">
      <x-responsive-nav-link href="{{ route('organizations.index') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
      <div class="flex items-center px-4">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
          <div class="me-3 shrink-0">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
          </div>
        @endif

        <div>
          <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
          <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
        </div>
      </div>

      <div class="mt-3 space-y-1">
        <!-- Account Management -->
        <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
          <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
            {{ __('API Tokens') }}
          </x-responsive-nav-link>
        @endif

        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}" x-data>
          @csrf

          <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>

        <!-- Team Management -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <div class="border-t border-gray-200 dark:border-gray-600"></div>

          <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Manage Team') }}
          </div>

          <!-- Team Settings -->
          <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
            {{ __('Team Settings') }}
          </x-responsive-nav-link>

          @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
              {{ __('Create New Team') }}
            </x-responsive-nav-link>
          @endcan

          <!-- Team Switcher -->
          @if (Auth::user()->allTeams()->count() > 1)
            <div class="border-t border-gray-200 dark:border-gray-600"></div>

            <div class="block px-4 py-2 text-xs text-gray-400">
              {{ __('Switch Teams') }}
            </div>

            @foreach (Auth::user()->allTeams() as $team)
              <x-switchable-team :team="$team" component="responsive-nav-link" />
            @endforeach
          @endif
        @endif
      </div>
    </div>
  </div>
</nav>
