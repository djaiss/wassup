<x-app-layout :organization="$organization" :member="$member">
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl px-2 sm:px-4">
      <div class="flex justify-center">
        <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
          <div class="text-muted-foreground mx-2 my-1 inline-flex h-9 items-center justify-center rounded-lg bg-gray-100 p-1">
            <div class="bg-white">
              <input type="radio" :name="name" x-model="__selected" id="all" value="all" class="border-primary text-primary focus-visible:ring-ring peer sr-only aspect-square h-4 w-4 rounded-full border shadow focus:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50" name="mail-filter" checked="checked" />

              <label for="all" class="ring-offset-background peer-focus-visible:ring-ring peer-checked:bg-background peer-checked:text-foreground inline-flex w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 peer-checked:shadow peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-offset-2 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" id="all">Cycle</label>
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
