@php
foreach($all_tags as $tag) {
    $allTags[] = $tag->name;
}

foreach($job_tags as $tag) {
    $jobTags[] = $tag->name;
}
@endphp

<x-user-profile-layout>
  <x-slot:title>Pixel Positions - Edit Job</x-slot:title>
  <h2 class="flex flex-col items-center font-bold text-xl mb-3">Add a edit Job: {{ $job->title }}</h2>

  @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="max-w-4xl mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
      <span>{{ session('success') }}</span>
      <button @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 focus:outline-none">
        &times;
      </button>
    </div>
  @endif

  <form class="max-w-4xl mx-auto" id="edit-job" method="POST" action="/user/my-jobs/edit">
    @csrf

    <x-form-field-group>

      <x-form-field>
        <x-form-input type="text" name="title" id="title" value="{{ old('title') ? old('title') : $job->title }}" placeholder=" " required />
        <x-form-label for="title" >Title (Senior Software Developer)</x-form-label>
        <x-form-error name="title"/>
      </x-form-field>

      <x-form-field>
        <x-form-input type="text" name="location" id="location" value="{{ old('location') ? old('location') : $job->location }}" placeholder=" " required />
        <x-form-label for="location" >Location (Nairobi - Kenya)</x-form-label>
        <x-form-error name="location"/>
      </x-form-field>

    </x-form-field-group>

    <x-form-field-group>

      <x-form-field>
        <x-form-input type="text" name="salary" id="salary" value="{{ old('salary') ? old('salary') : $job->salary }}" placeholder=" " required />
        <x-form-label for="salary" >Salary (KES)</x-form-label>
        <x-form-error name="salary"/>
      </x-form-field>

      <x-form-field>
        <x-form-input type="text" name="schedule" id="schedule" value="{{ old('schedule') ? old('schedule') : $job->schedule }}" placeholder=" " required />
        <x-form-label for="schedule" >Schedule (full-time/part-time)</x-form-label>
        <x-form-error name="schedule"/>
      </x-form-field>

    </x-form-field-group>

    <x-form-field>
      <x-form-textarea name="description" id="description" rows="5" placeholder=" " required>{{ old('description') ? old('description') : $job->description }}</x-form-textarea>
      <x-form-label for="description" >Description</x-form-label>
      <x-form-error name="description"/>
    </x-form-field>

    <x-form-field>
      <x-form-input type="url" name="url" id="url" value="{{ old('url') ? old('url') : $job->url }}" placeholder=" " required />
      <x-form-label for="url" >External Link (https://externaljob.link)</x-form-label>
      <x-form-error name="url"/>
    </x-form-field>

    <x-form-tag-select :jobTags="$allTags" name="tags" :oldTags="old('tags') ? old('tags') : $jobTags"/>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <div class="flex items-center gap-x-6">
            <button form="delete-form" class="text-sm font-bold text-red-500">Delete</button>
        </div>

      <x-form-button type="submit" form="edit-job" class="flex flex-col items-center">
        Update Job
      </x-form-button>
    </div>
  </form>
    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-user-profile-layout>