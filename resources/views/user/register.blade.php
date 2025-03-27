<x-layout>
  <x-slot:title>Pixel Positions - Register</x-slot:title>
  <h2 class="flex flex-col items-center font-bold text-xl mb-3">Register a new Account</h2>
  <form class="max-w-md mx-auto" method="POST" action="/user/register">
    @csrf

    <x-form-field-group>

      <x-form-field>
        <x-form-input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder=" " required />
        <x-form-label for="first_name" >First Name</x-form-label>
        <x-form-error name="first_name"/>
      </x-form-field>

      <x-form-field>
        <x-form-input type="text" name="last_name" id="last_name" value="{{ old('first_name') }}" placeholder=" " required />
        <x-form-label for="last_name" >Last Name</x-form-label>
        <x-form-error name="last_name"/>
      </x-form-field>

    </x-form-field-group>

    <x-form-field>
      <x-form-input type="email" name="email" id="email" value="{{ old('email') }}" placeholder=" " required />
      <x-form-label for="email" >Email address</x-form-label>
      <x-form-error name="email"/>
    </x-form-field>

    <x-form-field-group>

        <x-form-field>
          <x-form-input type="password" name="password" id="password" placeholder=" " required />
          <x-form-label for="password" >Password</x-form-label>
          <x-form-error name="password"/>
        </x-form-field>

        <x-form-field>
          <x-form-input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required />
          <x-form-label for="password_confirmation" >Confirm Password</x-form-label>
          <x-form-error name="password_confirmation"/>
        </x-form-field>

    </x-form-field-group>
    <div class="flex flex-col items-center space-y-4">
      <x-form-button type="submit">Register</x-form-button>
      <a href="/user/login" class="text-sm font-semibold text-white">Already have a account? Login</a>
    </div>    
  </form>      
</x-layout>