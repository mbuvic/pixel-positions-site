<footer class="mt-10">
  <div class="flex flex-col md:flex-row justify-between items-center py-4 border-t border-white/10">
    <!-- Logo and Social Media -->
    <div class="flex flex-col md:flex-row items-center gap-6">
      <!-- Logo -->
      <a href="/" class="mb-4 md:mb-0">
        <img src="{{ Vite::asset('resources/images/fav.svg') }}" alt="Logo" class="h-10">
      </a>
      <!-- Social Media Icons -->
      <div class="flex gap-5">
        <a href="#" class="hover:text-blue-500 transition-colors">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="#" class="hover:text-blue-500 transition-colors">
          <i class="fa-brands fa-twitter"></i>
        </a>
        <a href="#" class="hover:text-blue-500 transition-colors">
          <i class="fa-brands fa-linkedin-in"></i>
        </a>
      </div>
    </div>
    <!-- Copyright Text -->
    <div class="mt-4 md:mt-0">
      <p class="text-sm text-gray-400"><i>All rights reserved. Copyright &copy; {{ date('Y') }}</i></p>
    </div>
    <!-- Navigation Links -->
    <div class="mt-4 md:mt-0 flex flex-col md:flex-row items-center gap-4 md:gap-6 text-sm">
      <a href="#" class="hover:text-blue-500 transition-colors">About</a>
      <a href="#" class="hover:text-blue-500 transition-colors">Contact</a>
      <a href="#" class="hover:text-blue-500 transition-colors">Privacy Policy</a>
    </div>
  </div>
</footer>
