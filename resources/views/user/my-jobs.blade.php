@php
    $employer = auth()->user()->employer;
@endphp

<x-user-profile-layout>
  <x-slot:title>My Jobs - {{ $employer != null ? $employer->name : 'Not Set' }}</x-slot:title>
  
  <h2 class="flex flex-col items-center font-bold text-xl p-5">MANAGE {{ $employer != null ? strtoupper($employer->name) : '' }} JOBS</h2>
  
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
    <span>Your Company Profile Is Not Set, <a href="/user/company-profile">Set it now</a></span>
    <button @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-red-700 hover:text-red-900 focus:outline-none">
      &times;
    </button>
  </div>
  @endif

  <!-- Create a nice looking tailwind table -->
  <div class="container mx-auto px-4">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-800 border border-gray-700 shadow-md rounded-lg">
        <thead class="bg-gray-900 text-gray-200">
            <tr>
            <th class="px-6 py-3 text-left">Job Title</th>
            <th class="px-6 py-3 text-left">Description</th>
            <th class="px-6 py-3 text-left">Location</th>
            <th class="px-6 py-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-300">
            @forelse($myJobs as $job)
            <tr class="border-b border-gray-700 hover:bg-gray-700">
                <td class="px-6 py-4">{{ $job->title }}</td>
                <td class="px-6 py-4">{{ $job->description }}</td>
                <td class="px-6 py-4">{{ $job->location }}</td>
                <td class="px-6 py-4 space-x-2">
                <a href="/jobs/{{ $job->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-500 transition-colors">
                    <i class="fas fa-eye mr-1"></i> View
                </a>
                <a href="/jobs/{{ $job->id }}/edit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-500 transition-colors">
                    <i class="fas fa-edit mr-1"></i> Edit
                </a>
                </td>
            </tr>
            @empty
            <tr>
                <td class="px-6 py-4 text-center" colspan="4">No jobs found.</td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    </div>



    
</x-user-profile-layout>