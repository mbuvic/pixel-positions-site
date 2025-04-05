
<x-layout>
  <x-slot:title>Pixel Positions - {{ $job->title }}</x-slot:title>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">{{ $job->title }}</h1>
        </section>
        <section class="pt-10">
            <x-section-heading>A job from {{ $job->employer->name }}</x-section-heading>

        </section>
        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="flex flex-wrap gap-2 mt-6">
              @if (count($tags) === 0)
                  <p class="text-center text-gray-400">No Tags</p>
              @endif
              @foreach($tags as $tag)
                  <x-tag :$tag />
              @endforeach
            </div>
        </section>
        <section>
            <x-section-heading>Job Description</x-section-heading>

        </section>
    </div>
</x-layout>