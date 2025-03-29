@php
    $employer = auth()->user()->employer;
@endphp

<x-user-profile-layout>
  <x-slot:title>Profile - {{ $employer != null ? $employer->name : 'Not Set' }}</x-slot:title>
  
  <h2 class="flex flex-col items-center font-bold text-xl p-5">MANAGE {{ $employer != null ? strtoupper($employer->name) : '' }} COMPANY PROFILE</h2>
  
  @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="max-w-4xl mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
      <span>{{ session('success') }}</span>
      <button @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 focus:outline-none">
        &times;
      </button>
    </div>
  @endif

  @if($employer == null)
  <div x-data="{ show: true }" x-show="show" class="max-w-4xl mx-auto mb-6 p-4 bg-red-100 border border-green-red text-red-700 rounded relative">
    <span>Your Company Profile Is Not Set, Set it now</span>
    <button @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-red-700 hover:text-red-900 focus:outline-none">
      &times;
    </button>
  </div>
  @endif


  @if ($employer != null)
    <div class="flex flex-col items-center mb-10">
      <!-- Gradient border wrapper -->
      <div class="p-1 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 rounded-lg w-100">
        <img  src="{{ asset('storage/company_logos/' . basename($employer->logo)) }}" 
            alt="Company Logo"
            class="block rounded-lg transition-transform duration-300 ease-in-out hover:scale-105" />
      </div>
    </div>
  @endif

  <form class="max-w-4xl mx-auto" method="POST" action="/user/company-profile" enctype="multipart/form-data">
    @csrf

    <x-form-field>
      <x-form-input 
        type="text" 
        name="company_name" 
        id="company_name" 
        value="{{ old('company_name') ? old('company_name') : ($employer != null ? $employer->name : '') }}" 
        placeholder=" " 
        required 
      />
      <x-form-label for="company_name">Company Name</x-form-label>
      <x-form-error name="company_name"/>
    </x-form-field>

    <x-form-field>
      <x-form-file-select name="company_logo" id="company_logo" :multiple="false"/>
      <x-form-error name="company_logo"/>
    </x-form-field>

    <div class="flex flex-col items-center pt-10">
      <x-form-button type="submit">Update Company Profile</x-form-button>
    </div>    
  </form>      
</x-user-profile-layout>