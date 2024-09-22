<x-app-layout :organization="$organization" :member="$member">
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('People and teams') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl px-2 sm:px-0">
      <div class="grid grid-cols-[1fr_300px] gap-6">
        <!-- left -->
        <div>
          <div class="rounded-md border border-gray-200 bg-white sm:rounded-lg dark:bg-gray-800">
            @foreach ($members as $currentMember)
              <div class="flex items-center justify-between border-b border-gray-200 px-3 py-2 last:border-b-0">
                <div class="flex items-center">
                  <img class="mr-3 h-8 w-8 rounded-full object-cover" src="{{ $currentMember['avatar'] }}" alt="{{ $currentMember['name'] }}" />
                  {{ $currentMember['name'] }}
                </div>

                <div>
                  <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen=true" class="inline-flex items-center justify-center rounded-md border bg-white px-3 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-100 focus:bg-white focus:outline-none active:bg-white disabled:pointer-events-none disabled:opacity-50">
                      <span class="mr-2">{{ __('Options') }}</span>
                      <svg class="h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                      </svg>
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="duration-200 ease-out" x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" class="absolute -top-3 left-1/2 z-50 mt-12 w-56 -translate-x-1/2" x-cloak>
                      <div class="mt-1 rounded-md border border-neutral-200/70 bg-white p-1 text-neutral-700 shadow-md">
                        <div class="px-2 py-1.5 text-sm font-semibold">My Account</div>
                        <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                        <a href="#_" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                          </svg>
                          <span>Profile</span>
                          <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘P</span>
                        </a>
                        <a href="#_" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                            <line x1="2" x2="22" y1="10" y2="10"></line>
                          </svg>
                          <span>Billing</span>
                          <span class="ml-auto text-xs tracking-widest opacity-60">⌘B</span>
                        </a>
                        <a href="#_" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <path
                              d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                          </svg>
                          <span>Settings</span>
                          <span class="ml-auto text-xs tracking-widest opacity-60">⌘S</span>
                        </a>
                        <a href="#_" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <rect width="20" height="16" x="2" y="4" rx="2" ry="2"></rect>
                            <path d="M6 8h.001"></path>
                            <path d="M10 8h.001"></path>
                            <path d="M14 8h.001"></path>
                            <path d="M18 8h.001"></path>
                            <path d="M8 12h.001"></path>
                            <path d="M12 12h.001"></path>
                            <path d="M16 12h.001"></path>
                            <path d="M7 16h10"></path>
                          </svg>
                          <span>Keyboard shortcuts</span>
                          <span class="ml-auto text-xs tracking-widest opacity-60">⌘K</span>
                        </a>
                        <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                        <div class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                          </svg>
                          <span>Team</span>
                        </div>
                        <div class="group relative">
                          <div class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                              <circle cx="9" cy="7" r="4"></circle>
                              <line x1="19" x2="19" y1="8" y2="14"></line>
                              <line x1="22" x2="16" y1="11" y2="11"></line>
                            </svg>
                            <span>Invite users</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto h-4 w-4"><polyline points="9 18 15 12 9 6"></polyline></svg>
                          </div>
                          <div data-submenu class="invisible absolute right-0 top-0 mr-1 translate-x-full opacity-0 duration-200 ease-out group-hover:visible group-hover:mr-0 group-hover:opacity-100">
                            <div class="animate-in slide-in-from-left-1 z-50 w-40 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 shadow-md">
                              <div @click="dropdownOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <span>Email</span>
                              </div>
                              <div @click="dropdownOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <span>Message</span>
                              </div>
                              <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                              <div @click="dropdownOpen=false" class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <circle cx="12" cy="12" r="10"></circle>
                                  <line x1="12" x2="12" y1="8" y2="16"></line>
                                  <line x1="8" x2="16" y1="12" y2="12"></line>
                                </svg>
                                <span>More...</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <line x1="12" x2="12" y1="5" y2="19"></line>
                            <line x1="5" x2="19" y1="12" y2="12"></line>
                          </svg>
                          <span>New Team</span>
                          <span class="ml-auto text-xs tracking-widest opacity-60">⌘+T</span>
                        </div>
                        <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                        <a href="#_" class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                            <path d="M9 18c-4.51 2-5-2-7-2"></path>
                          </svg>
                          <span>GitHub</span>
                        </a>
                        <a href="#_" class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="4"></circle>
                            <line x1="4.93" x2="9.17" y1="4.93" y2="9.17"></line>
                            <line x1="14.83" x2="19.07" y1="14.83" y2="19.07"></line>
                            <line x1="14.83" x2="19.07" y1="9.17" y2="4.93"></line>
                            <line x1="14.83" x2="18.36" y1="9.17" y2="5.64"></line>
                            <line x1="4.93" x2="9.17" y1="19.07" y2="14.83"></line>
                          </svg>
                          <span>Support</span>
                        </a>
                        <a href="#_" class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50" data-disabled>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"></path></svg>
                          <span>API</span>
                        </a>
                        <div class="-mx-1 my-1 h-px bg-neutral-200"></div>
                        <a href="#_" class="focus:bg-accent focus:text-accent-foreground relative flex cursor-default select-none items-center rounded px-2 py-1.5 text-sm outline-none transition-colors hover:bg-neutral-100 data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" x2="9" y1="12" y2="12"></line>
                          </svg>
                          <span>Log out</span>
                          <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘Q</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- right -->
        <div class="p-3 sm:p-0">
          <div class="rounded-md border border-gray-200 bg-white p-5 sm:rounded-lg dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-center">
              <svg class="mr-1 h-5 w-5 flex-shrink-0 text-red-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
              </svg>
              <p class="text-sm font-bold">{{ __('How can you invite someone') }}</p>
            </div>

            <p class="mb-4">{{ __('Please invite the person you\'d like to join by having them create an account on Wassup. After that, they can easily join the organization using the code provided above.') }}</p>

            <div class="flex justify-center">
              <div
                x-data="{
                  copyText: '{{ $organization->code }}',
                  copyNotification: false,
                  copyToClipboard() {
                    const el = document.createElement('textarea')
                    el.value = this.copyText
                    el.setAttribute('readonly', '')
                    el.style.position = 'absolute'
                    el.style.left = '-9999px'
                    document.body.appendChild(el)
                    el.select()
                    document.execCommand('copy')
                    document.body.removeChild(el)
                    this.copyNotification = true
                    let that = this
                    setTimeout(function () {
                      that.copyNotification = false
                    }, 3000)
                  },
                }"
                class="relative z-20 flex items-center">
                <button @click="copyToClipboard();" class="text-md group flex h-8 w-auto cursor-pointer items-center justify-center rounded-md border border-neutral-200/60 bg-white px-3 py-1 font-mono text-neutral-500 hover:bg-neutral-100 hover:text-neutral-600 focus:bg-white focus:outline-none active:bg-white">
                  <span x-show="!copyNotification">{{ $organization->code }}</span>
                  <svg x-show="!copyNotification" class="ml-1.5 h-4 w-4 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                  </svg>
                  <span x-show="copyNotification" class="font-sans text-sm tracking-tight text-green-500" x-cloak>Copied</span>
                  <svg x-show="copyNotification" class="ml-1.5 h-4 w-4 stroke-current text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" x-cloak>
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
