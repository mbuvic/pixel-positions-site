<x-layout>
  <x-slot:title>Pixel Positions - Login</x-slot:title>
  <h2 class="flex flex-col items-center font-bold text-xl mb-3">Login to your Account</h2>
    <form class="max-w-md mx-auto" method="POST" action="/user/login">
      @csrf

      <x-form-field>
        <x-form-input type="email" name="email" id="email" value="{{ old('email') }}" placeholder=" " required />
        <x-form-label for="email" >Email address</x-form-label>
        <x-form-error name="email"/>
      </x-form-field>

      <x-form-field>
        <x-form-input type="password" name="password" id="password" placeholder=" " required />
        <x-form-label for="password" >Password</x-form-label>
        <x-form-error name="password"/>
      </x-form-field>

      <div class="flex flex-col items-center space-y-2">
        <x-form-button type="submit">Login</x-form-button>
        <a href="/user/register" class="text-sm font-semibold text-white">New user? Register</a>
      </div>    
    </form>      
</x-layout>