<x-app-layout :organization="$organization" :member="$member">
  <div class="py-12">
    <div class="mx-auto max-w-5xl px-2 sm:px-4">
      <!-- cycle selector -->
      <div class="mb-8 grid grid-cols-3">
        <!-- previous cycles -->
        <div class="flex items-center">
          <div class="mr-2 rounded-full border bg-white p-3">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
          </div>

          <div class="flex flex-col">
            <p class="text-sm">{{ __('Previous cycle') }}</p>
            <p class="text-xs text-gray-600">Cycle #32</p>
          </div>
        </div>

        <!-- draft new cycle -->
        <div class="place-self-center">
          <x-secondary-button hover="true" href="{{ route('organizations.index') }}">
            {{ __('Draft new cycle') }}
          </x-secondary-button>
        </div>

        <!-- next cycles -->
        <div class="flex items-center place-self-end">
          <div class="mr-2 flex flex-col">
            <p class="text-sm">{{ __('Next cycle') }}</p>
            <p class="text-xs text-gray-600">Cycle #32</p>
          </div>

          <div class="rounded-full border bg-white p-3">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
          </div>
        </div>
      </div>

      <!-- cycle title -->
      <div class="mb-6 flex justify-between">
        <h2 class="font-bold">
          {{ __('Current cyle') }}
          <span class="font-normal text-gray-400">(43 days left)</span>
        </h2>
        <div class="text-sm text-gray-600">
          <span class="font-mono">17/04/2024</span>
          &#8611;
          <span class="font-mono">28/05/2024</span>
        </div>
      </div>

      <div class="mb-8 flex justify-center">
        <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
            <div class="bg-white">
              <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

              <label for="all" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="all">Description</label>
            </div>
            <div class="bg-white">
              <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

              <label for="unread" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="unread">Goals</label>
            </div>
            <div>
              <input type="radio" :name="name" x-model="__selected" id="unread" value="unread" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" />

              <label for="unread" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="unread">Check-ins</label>
            </div>
          </div>
        </div>
      </div>

      <div>
        <!-- cycle description -->
        <div class="mb-5 rounded-md border border-gray-200 bg-white sm:rounded-lg">
          <div class="prose mx-auto px-4 py-8">
            <p>Hello Team,</p>

            <p>As we embark on our next 6-week cycle, I want to share our main objectives to ensure we are all moving forward in the right direction. Our first focus will be on integrating a new variable in our CSS framework. This enhancement will not only streamline our codebase but also provide more flexibility and customization options for our users. I encourage everyone to collaborate closely, share insights, and leverage our collective expertise to make this integration seamless and efficient.</p>

            <p>Our second objective is to optimize the TailwindUI website. This involves improving load times, enhancing user experience, and ensuring our site is as responsive and accessible as possible. A fast, user-friendly website is crucial for retaining our users and showcasing the power of Tailwind CSS. Let’s prioritize performance optimization and usability improvements, and work together to identify and implement the best solutions.</p>

            <p>Lastly, we will be adding three new templates to our TailwindUI collection. These templates should reflect the latest design trends and meet the diverse needs of our growing user base. Creativity and innovation will be key here, so let’s push the boundaries and deliver templates that are not only functional but also visually stunning. I’m excited to see the unique ideas and designs that each of you will bring to the table.</p>

            <p>Thank you for your dedication and hard work. Let’s make this cycle a success!</p>
          </div>

          <div class="prose mx-auto px-4 py-8">
            <!-- actions -->
            <div class="flex justify-center">
              <div class="focus-visible:ring-ring mr-2 inline-flex cursor-pointer items-center justify-center rounded-md border border-gray-300 bg-white px-2 py-1 text-sm font-medium shadow-sm transition-colors hover:border-gray-400 hover:bg-gray-100 focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50">
                <svg class="mr-2 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>

                <span>{{ __('Edit') }}</span>
              </div>

              <div class="focus-visible:ring-ring inline-flex cursor-pointer items-center justify-center rounded-md border border-gray-300 bg-white px-2 py-1 text-sm font-medium shadow-sm transition-colors hover:border-gray-400 hover:bg-gray-100 focus-visible:outline-none focus-visible:ring-1 disabled:pointer-events-none disabled:opacity-50">
                <svg class="mr-2 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>

                <span>{{ __('Delete') }}</span>
              </div>
            </div>
          </div>

          <div class="border-t border-gray-200">
            <div class="flex justify-between px-4 py-3">
              <div class="flex items-center">
                <svg class="mr-2 h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

                <div class="flex flex-col">
                  <p class="text-sm">{{ __('Edit cycle\'s description') }}</p>
                  <p class="text-xs text-gray-600">dafdsaf</p>
                </div>
              </div>

              <x-secondary-button hover="true" href="{{ route('organizations.index') }}">
                {{ __('Edit') }}
              </x-secondary-button>
            </div>
          </div>
        </div>

        <!-- cycle selector -->
        <div class="mb-8 grid grid-cols-3">
          <!-- previous cycles -->
          <div class="flex items-center">
            <div class="mr-2 rounded-full border bg-white p-3">
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
              </svg>
            </div>

            <div class="flex flex-col">
              <p class="text-sm">{{ __('Previous cycle') }}</p>
              <p class="text-xs text-gray-600">Cycle #32</p>
            </div>
          </div>

          <!-- draft new cycle -->
          <div class="place-self-center">
            <x-secondary-button hover="true" href="{{ route('organizations.index') }}">
              {{ __('Draft new cycle') }}
            </x-secondary-button>
          </div>

          <!-- next cycles -->
          <div class="flex items-center place-self-end">
            <div class="mr-2 flex flex-col">
              <p class="text-sm">{{ __('Previous cycle') }}</p>
              <p class="text-xs text-gray-600">Cycle #32</p>
            </div>

            <div class="rounded-full border bg-white p-3">
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
              </svg>
            </div>
          </div>
        </div>

        <!-- post input -->
        <div class="mb-3 overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="flex items-center px-4 py-2">
            <img class="mr-2 h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />

            <input type="text" class="w-full rounded-lg border-none bg-gray-100 focus:ring-0" placeholder="What's on your mind?" />
          </div>
        </div>

        <!-- filters -->
        <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
            <di class="bg-white">
              <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

              <label for="all" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="all">All</label>
            </di>
            <div>
              <input type="radio" :name="name" x-model="__selected" id="unread" value="unread" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" />

              <label for="unread" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="unread">Unread</label>
            </div>
          </div>
        </div>

        <!-- posts -->
        <div></div>
      </div>

      <div class="special-grid grid grid-cols-1 gap-6">
        <!-- left -->
        <div>
          <div class="mb-2 flex items-center rounded-lg">
            <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
            </svg>

            <span class="ml-2">{{ __('Cycles') }}</span>
          </div>
          <div class="flex items-center rounded-lg">
            <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
            </svg>

            <span class="ml-2">{{ __('Life') }}</span>
          </div>
        </div>

        <!-- center -->
        <div>
          <!-- cycle -->
          <div class="mb-3 flex justify-between">
            <h2 class="font-bold">
              {{ __('Current cyle') }}
              <span class="font-normal text-gray-400">(43 days left)</span>
            </h2>
            <div class="text-sm text-gray-600">
              <span class="font-mono">17/04/2024</span>
              &#8611;
              <span class="font-mono">28/05/2024</span>
            </div>
          </div>

          <!-- cycle description -->
          <div class="rounded-md border border-gray-200 bg-white px-4 py-6 sm:rounded-lg">
            <div class="prose mx-auto">
              <p>Hello Team,</p>

              <p>As we embark on our next 6-week cycle, I want to share our main objectives to ensure we are all moving forward in the right direction. Our first focus will be on integrating a new variable in our CSS framework. This enhancement will not only streamline our codebase but also provide more flexibility and customization options for our users. I encourage everyone to collaborate closely, share insights, and leverage our collective expertise to make this integration seamless and efficient.</p>

              <p>Our second objective is to optimize the TailwindUI website. This involves improving load times, enhancing user experience, and ensuring our site is as responsive and accessible as possible. A fast, user-friendly website is crucial for retaining our users and showcasing the power of Tailwind CSS. Let’s prioritize performance optimization and usability improvements, and work together to identify and implement the best solutions.</p>

              <p>Lastly, we will be adding three new templates to our TailwindUI collection. These templates should reflect the latest design trends and meet the diverse needs of our growing user base. Creativity and innovation will be key here, so let’s push the boundaries and deliver templates that are not only functional but also visually stunning. I’m excited to see the unique ideas and designs that each of you will bring to the table.</p>

              <p>Thank you for your dedication and hard work. Let’s make this cycle a success!</p>
            </div>
          </div>

          <!-- post input -->
          <div class="mb-3 overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
            <div class="flex items-center px-4 py-2">
              <img class="mr-2 h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />

              <input type="text" class="w-full rounded-lg border-none bg-gray-100 focus:ring-0" placeholder="What's on your mind?" />
            </div>
          </div>

          <!-- filters -->
          <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
            <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
              <di class="bg-white">
                <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

                <label for="all" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="all">All</label>
              </di>
              <div>
                <input type="radio" :name="name" x-model="__selected" id="unread" value="unread" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" />

                <label for="unread" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="unread">Unread</label>
              </div>
            </div>
          </div>

          <!-- posts -->
          <div></div>
        </div>

        <!-- right -->
        <div>right</div>
      </div>
    </div>
  </div>
</x-app-layout>
