@props(['active' => false, 'href' => '/'])

<a href="{{ $href }}" class="relative group {{ $active ? 'active-link' : '' }}">
  {{ $slot }}
  <span class="absolute left-0 -bottom-1 h-1 w-0 bg-gradient-to-r from-blue-500 to-gray-500 transition-all duration-600 group-hover:w-full"></span>
</a>