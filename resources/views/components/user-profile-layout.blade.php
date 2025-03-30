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
          <a href="/user/dashboard">
            <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Logo" class="h-10">
          </a>
        </div>
      
        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-6 font-bold">
          <x-user-menu-item href="/user/dashboard" :active="request()->is('user/dashboard')">
            Dashboard
          </x-user-menu-item>
          <x-user-menu-item href="/user/my-jobs" :active="request()->is('user/my-jobs')">
            My Jobs
          </x-user-menu-item>
          <x-user-menu-item href="/user/company-profile" :active="request()->is('user/company-profile')">
            Company Profile
          </x-user-menu-item>
          <x-user-menu-item href="/user/profile" :active="request()->is('user/profile')">
            My Profile
          </x-user-menu-item>
        </div>
      
        <!-- Right Section -->
        <div class="flex items-center gap-6">
          <a href="/" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors flex items-center">
            <i class="fa-solid fa-globe"></i>
            <span class="hidden sm:inline ml-2">Public Site</span>
          </a>
      
          <!-- Mobile Hamburger Icon -->
          <button class="md:hidden" id="mobile-menu-button">
            <i class="fa-solid fa-bars text-2xl"></i>
          </button>
      
          <!-- Auth Section -->
          <x-auth-section />
        </div>
      </nav>
      
      <!-- Mobile Menu (hidden by default) -->
      <div class="md:hidden" id="mobile-menu" style="display: none;">
        <div class="flex flex-col space-y-4 p-4 font-bold">
          <x-user-menu-item href="/user/dashboard" :active="request()->is('user/dashboard')">
            Dashboard
          </x-user-menu-item>
          <x-user-menu-item href="/user/my-jobs" :active="request()->is('user/my-jobs')">
            My Jobs
          </x-user-menu-item>
          <x-user-menu-item href="/user/company-profile" :active="request()->is('user/company-profile')">
            Company Profile
          </x-user-menu-item>
          <x-user-menu-item href="/user/profile" :active="request()->is('user/profile')">
            My Profile
          </x-user-menu-item>
        </div>
      </div>
      
      <main class="mt-10 max-w-[986px] mx-auto">
          {{ $slot }}
      </main>
      <x-footer />
    </div>
</body>
</html>