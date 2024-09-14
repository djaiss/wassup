<x-guest-layout>
  <div class="grid bg-gray-100 grid-rows-1">
  <div class="flex h-screen flex-col">
    <!-- header -->
    <div class="flex items-center justify-center p-10 sm:mt-24">
      <!-- illustration -->
      <div class="relative mr-10 mt-10 px-20">
        <div class="welcome-back absolute rounded-lg bg-blue-950 px-2 py-1 text-xs font-bold text-white">Welcome back 🫶</div>
        <img src="img/login.png" class="w-60" alt="" />
      </div>

      <div class="flex flex-col items-center bg-gray-100 sm:justify-center dark:bg-gray-900">
        <img src="img/logo.png" class="w-20" alt="" />

        <x-validation-errors class="mb-4" />

        @session('status')
          <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ $value }}
          </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="mt-5 w-96 overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-xl sm:rounded-lg dark:bg-gray-800">
          @csrf

          <p class="my-3 text-center text-lg font-bold">{{ __('Log in to your account') }}</p>

          <div>
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
          </div>

          <div class="mt-4">
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
          </div>

          <div class="mt-4 block">
            <label for="remember_me" class="flex items-center">
              <x-checkbox id="remember_me" name="remember" />
              <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
          </div>

          <div class="mt-4 flex items-center justify-end">
            @if (Route::has('password.request'))
              <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
              </a>
            @endif

            <x-button class="ms-4">
              {{ __('Log in') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</x-guest-layout>
