@auth
<div x-data="{ open: false }" class="relative">
  <button 
      @click="open = !open"
      class="flex items-center gap-2 hover:text-blue-500 transition-colors"
  >
      <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
      </svg>
  </button>

  <!-- Dropdown Menu -->
  <div 
      x-show="open" 
      @click.away="open = false"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 transform scale-95"
      x-transition:enter-end="opacity-100 transform scale-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 transform scale-100"
      x-transition:leave-end="opacity-0 transform scale-95"
      class="absolute right-0 mt-4 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100"
      style="display: none"
  >
      <a 
          href="/user/profile" 
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
      >
          My Profile
      </a>
      <a 
          href="/user/company-profile" 
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
      >
          Manage Company
      </a>
      <form method="POST" action="/user/logout">
          @csrf
          <button 
              type="submit"
              class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
          >
              Log Out
          </button>
      </form>
  </div>
</div>

@else
  @if (request()->is('user/login') || request()->is('user/register'))
      <a href="/" class="text-gray-100 hover:text-gray-400 transition-colors">
          Home
      </a>
  @else
      <a href="/user/login" class="text-gray-100 hover:text-gray-400 transition-colors">
          Login
      </a>
  @endif
@endauth