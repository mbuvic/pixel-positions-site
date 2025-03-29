<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/fav.svg') }}">
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
            <x-auth-section />
        </div>
      </nav>
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>