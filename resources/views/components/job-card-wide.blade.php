@props(['job' => ''])

<div class="p-4 bg-white/5 rounded-xl flex flex-col md:flex-row gap-y-4 md:gap-x-6 border border-transparent hover:border-blue-500 group transition-colors duration-300"
    onclick="window.location.href = '/jobs/{{ $job->slug }}'"      
>
  <div class="flex-shrink-0 flex justify-center md:justify-start">
      <x-employer-logo logoUrl="{{ asset('storage/company_logos/' . basename($job->employer->logo)) }}" :width="90" />
  </div>
  <div class="flex-1 flex flex-col">
      <a href="#" class="self-start text-sm text-gray-400">{{ $job->employer->name }}</a>
      <h3 class="font-bold text-xl mt-3 group-hover:text-blue-500 transition-colors duration-500">{{ $job->title }}</h3>
      <p class="text-sm text-gray-400 mt-auto">{{ $job->location }} - {{ $job->schedule }} - {{ $job->salary }}</p>
  </div>
  <div class="justify-center md:justify-center">
      @foreach($job->tags as $tag)
          <x-tag class="text-xs" :$tag />
      @endforeach
  </div>
</div>
