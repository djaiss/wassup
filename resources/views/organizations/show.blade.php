<x-app-layout :organization="$organization" :member="$member">
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl px-2 sm:px-0">
      <div class="special-grid grid grid-cols-1 gap-6">
        <!-- left -->
        <div></div>

        <!-- center -->
        <div>
          <!-- post input -->
          <div class="overflow-hidden rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800 mb-3">
            <div class="flex items-center px-4 py-2">
              <img class="mr-2 h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />

              <input type="text" class="w-full rounded-lg border-none bg-gray-100 focus:ring-0" placeholder="What's on your mind?" />
            </div>
          </div>

          <!-- filters -->
          <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
            <div class="mx-2 my-1 bg-gray-100 text-muted-foreground inline-flex h-9 items-center justify-center rounded-lg p-1">
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
          <div>
            <div>
              <img class="mr-2 h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />

              <input type="text" class="w-full rounded-lg border-none bg-gray-100 focus:ring-0" placeholder="What's on your mind?" />
            </div>
          </div>
        </div>

        <!-- right -->
        <div>right</div>
      </div>
    </div>
  </div>
</x-app-layout>
