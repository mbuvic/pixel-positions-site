
<x-layout>
  <x-slot:title>Pixel Positions - {{ $job->title }}</x-slot:title>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">{{ $job->title }}</h1>
        </section>
        <section class="pt-10">
            <x-employer-logo class="mx-auto" logoUrl="{{ asset('storage/company_logos/' . basename($job->employer->logo)) }}" :width="150" />
            <p class="text-center">A job from <strong>{{ $job->employer->name }}</strong></p>
        </section>

        <section>
            <x-section-heading>Job Details</x-section-heading>
            <p>{!! $job->description ?? 'No Description' !!}</p>
        </section>

        <section>
            <x-section-heading>Job Tags</x-section-heading>
            <div class="flex flex-wrap gap-2 mt-6">
              @if (count($tags) === 0)
                  <p class="text-center text-gray-400">No Tags</p>
              @endif
              @foreach($tags as $tag)
                  <x-tag :$tag />
              @endforeach
            </div>
        </section>
    </div>
</x-layout>