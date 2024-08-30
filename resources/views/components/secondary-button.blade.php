@props([
  'href',
  'hover' => false,
])

@isset($href)
  <a href="{{ $href }}" @if($hover) wire:navigate.hover @endif {{ $attributes->merge(['class' => 'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-gray-100 h-9 px-4 py-2']) }}>
    {{ $slot }}
  </a>
@else
  <button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-gray-100 h-9 px-4 py-2']) }}>
    {{ $slot }}
  </button>
@endisset
