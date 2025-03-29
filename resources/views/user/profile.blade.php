<x-user-profile-layout>
  <x-slot:title>Profile - {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</x-slot:title>
  
  <h2 class="flex flex-col items-center font-bold text-xl mb-10 p-10">MANAGE YOUR ACCOUNT</h2>
  
  @if(session('success'))
    <div class="max-w-4xl mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
      {{ session('success') }}
    </div>
  @endif

  <form class="max-w-4xl mx-auto" method="POST" action="/user/profile">
    @csrf

    <x-form-field-group>
      <x-form-field>
        <x-form-input 
          type="text" 
          name="first_name" 
          id="first_name" 
          value="{{ old('first_name') ? old('first_name') : auth()->user()->first_name }}" 
          placeholder=" " 
          required 
        />
        <x-form-label for="first_name">First Name</x-form-label>
        <x-form-error name="first_name"/>
      </x-form-field>

      <x-form-field>
        <x-form-input 
          type="text" 
          name="last_name" 
          id="last_name" 
          value="{{ old('last_name') ? old('last_name') : auth()->user()->last_name }}" 
          placeholder=" " 
          required 
        />
        <x-form-label for="last_name">Last Name</x-form-label>
        <x-form-error name="last_name"/>
      </x-form-field>
    </x-form-field-group>

    <x-form-field>
      <x-form-input 
        type="email" 
        name="email" 
        id="email" 
        value="{{ old('email') ? old('email') : auth()->user()->email }}" 
        placeholder=" " 
        required 
      />
      <x-form-label for="email">Email address</x-form-label>
      <x-form-error name="email"/>
    </x-form-field>

    <span class="text-sm text-gray-400">
      Only type in the password fields if you want to update your password 
    </span>

    <x-form-field-group class="mt-3">
      <x-form-field>
        <x-form-input 
          type="password" 
          name="password" 
          id="password" 
          placeholder=" " 
        />
        <x-form-label for="password">New Password</x-form-label>
        <x-form-error name="password"/>
      </x-form-field>

      <x-form-field>
        <x-form-input 
          type="password" 
          name="password_confirmation" 
          id="password_confirmation" 
          placeholder=" " 
        />
        <x-form-label for="password_confirmation">Confirm New Password</x-form-label>
        <x-form-error name="password_confirmation"/>
      </x-form-field>
    </x-form-field-group>

    <div class="flex flex-col items-center pt-10">
      <x-form-button type="submit">Update Profile</x-form-button>
    </div>    
  </form>      
</x-user-profile-layout>
