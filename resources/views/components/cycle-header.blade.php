@props(['cycle' => null])

<div class="mb-6 flex justify-between">
          <h2 class="text-xl font-bold">{{ __('Cycle #:cycleNumber', ['cycleNumber' => $cycle->number]) }}</h2>

          @if ($cycle->is_active)
            <div class="flex items-center rounded-lg border border-green-900 bg-green-50 px-2 py-0 text-xs text-green-900">
              <x-lucide-flame class="mr-1 h-4 w-4" />

              <span>{{ __('Active') }}</span>
            </div>
          @else
            <div class="flex items-center rounded-lg border border-red-900 bg-yellow-100 px-2 py-0 text-xs text-red-900">
              <x-lucide-book-dashed class="mr-1 h-4 w-4" />

              <span>{{ __('Draft') }}</span>
            </div>
          @endif
        </div>
