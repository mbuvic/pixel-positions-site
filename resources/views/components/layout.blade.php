<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">
    <div class="px-10">
      <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <!-- Logo -->
        <div>
            <a href="/">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Logo" class="h-10">
            </a>
        </div>
    
        <!-- Navigation Links (conditional) -->
        @if (!request()->is('user/login') && !request()->is('user/register'))
            <div class="hidden md:flex space-x-6 font-bold">
                <a href="#" class="hover:text-blue-500 transition-colors">Jobs</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Careers</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Salaries</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Companies</a>
            </div>
        @endif
    
        <!-- Right Section -->
        <div class="flex items-center gap-6">
            @if (!request()->is('jobs/create') && !request()->is('user/login') && !request()->is('user/register'))
                <a href="/jobs/create" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                    Post a Job
                </a>
            @elseif(request()->is('jobs/create'))
                <a href="/" class="text-gray-600 hover:text-gray-800 transition-colors">
                    Go Back
                </a>
            @endif
    
            <!-- Auth Section -->
            @auth
              <div x-data="{ open: false }" class="relative">
                <button 
                    @click="open = !open"
                    class="flex items-center gap-2 hover:text-blue-500 transition-colors"
                >
                    <span>{{ auth()->user()->first_name }}</span>
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
        </div>
      </nav>
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>