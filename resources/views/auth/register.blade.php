<x-guest-layout>
  <div class="flex h-screen flex-col bg-gray-100">
    <!-- header -->
    <div class="flex items-center justify-center p-10 sm:mt-24">
      <!-- illustration -->
      <div class="relative mr-10 max-w-96">
        <img src="img/register.png" class="mx-auto mb-10 w-72" alt="" />

        <div class="relative mb-4 flex flex-row justify-center gap-3">
          <svg class="relative top-1 size-5 flex-shrink-0 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <div>
            <h2 class="text-lg font-extrabold">No monthly or yearly subscriptions</h2>
            <p>You pay once, regardless of the size of your company. And the first month is on us.</p>
          </div>
        </div>

        <div class="relative mb-4 flex flex-row justify-center gap-3">
          <svg class="relative top-1 size-5 flex-shrink-0 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <div>
            <h2 class="text-lg font-extrabold">Unlimited projects. Unlimited users.</h2>
            <p>Wassup lets you manage as many projects and statuses that you want.</p>
          </div>
        </div>
      </div>

      <div class="flex flex-col items-center bg-gray-100 sm:justify-center dark:bg-gray-900">
        <img src="img/logo.png" class="w-20" alt="" />

        <x-validation-errors class="mb-4" />

        @session('status')
          <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ $value }}
          </div>
        @endsession

        <form method="POST" action="{{ route('register') }}" class="mt-5 w-96 overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-xl sm:rounded-lg dark:bg-gray-800">
          @csrf

          <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          </div>

          <div class="mt-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
          </div>

          <div class="mt-4">
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="new-password" />
          </div>

          <div class="mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" class="mt-1 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
          </div>

          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
              <x-label for="terms">
                <div class="flex items-center">
                  <x-checkbox name="terms" id="terms" required />

                  <div class="ms-2">
                    {!!
                      __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Terms of Service') . '</a>',
                        'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Privacy Policy') . '</a>',
                      ])
                    !!}
                  </div>
                </div>
              </x-label>
            </div>
          @endif

          <div class="mt-4 flex items-center justify-end">
            <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
              {{ __('Already registered?') }}
            </a>

            <x-button class="ms-4">
              {{ __('Register') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
