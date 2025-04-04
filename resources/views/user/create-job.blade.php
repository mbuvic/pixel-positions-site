@foreach($tags as $tag)
  @php
    $jobTags[] = $tag->name;
  @endphp
@endforeach

<x-user-profile-layout>
  <x-slot:title>Pixel Positions - Add Job</x-slot:title>
  <h2 class="flex flex-col items-center font-bold text-xl mb-3">Add a new Job for {{ auth()->user()->employer->name }}</h2>

  @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="max-w-4xl mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
      <span>{{ session('success') }}</span>
      <button @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-green-700 hover:text-green-900 focus:outline-none">
        &times;
      </button>
    </div>
  @endif

  <form class="max-w-4xl mx-auto" method="POST" action="/user/my-jobs/create">
    @csrf

    <x-form-field-group>

      <x-form-field>
        <x-form-input type="text" name="title" id="title" value="{{ old('title') }}" placeholder=" " required />
        <x-form-label for="title" >Title (Senior Software Developer)</x-form-label>
        <x-form-error name="title"/>
      </x-form-field>

      <x-form-field>
        <x-form-input type="text" name="location" id="location" value="{{ old('location') }}" placeholder=" " required />
        <x-form-label for="location" >Location (Nairobi - Kenya)</x-form-label>
        <x-form-error name="location"/>
      </x-form-field>

    </x-form-field-group>

    <x-form-field-group>

      <x-form-field>
        <x-form-input type="text" name="salary" id="salary" value="{{ old('salary') }}" placeholder=" " required />
        <x-form-label for="salary" >Salary (KES)</x-form-label>
        <x-form-error name="salary"/>
      </x-form-field>

      <x-form-field>
        <x-form-input type="text" name="schedule" id="schedule" value="{{ old('schedule') }}" placeholder=" " required />
        <x-form-label for="schedule" >Schedule (full-time/part-time)</x-form-label>
        <x-form-error name="schedule"/>
      </x-form-field>

    </x-form-field-group>

    <x-form-field>
      <x-form-textarea name="description" id="description" rows="5" placeholder=" " required>{{ old('description') }}</x-form-textarea>
      <x-form-label for="description" >Description</x-form-label>
      <x-form-error name="description"/>
    </x-form-field>

    <x-form-field>
      <x-form-input type="url" name="url" id="url" value="{{ old('url') }}" placeholder=" " required />
      <x-form-label for="url" >External Link (https://externaljob.link)</x-form-label>
      <x-form-error name="url"/>
    </x-form-field>

    <x-form-tag-select :jobTags="$jobTags" name="tags" :oldTags="old('tags')"/>

    <div class="flex justify-end">
      <x-form-button type="submit" class="flex flex-col items-center">
        Save New Job
      </x-form-button>
    </div>
  </form>
</x-user-profile-layout>