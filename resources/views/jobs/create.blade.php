<x-layout>
  <x-slot:title>Pixel Positions - Create Job</x-slot:title>

  <form method="POST" action="/jobs">
    @csrf
      <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
          <h2 class="text-base/7 font-semibold text-gray-900">Create A New Job</h2>
          <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
    
        <div> 
          <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

            <x-form-field class="sm:col-span-6">
              <x-form-label for="title">Title</x-form-label>
              <x-form-input name="title" id="title" placeholder="Job Title" value="{{ old('title') }}" required/>
              <x-form-error name="title"/>
            </x-form-field>

            @php
                $locations = [
                    'United States'       => 'United States',
                    'Canada'              => 'Canada',
                    'Mexico'              => 'Mexico',
                    'Kenya'               => 'Kenya',
                    'Remote - United States' => 'Remote - United States',
                    'Remote - Canada'        => 'Remote - Canada',
                    'Remote - Mexico'        => 'Remote - Mexico',
                    'Remote - Kenya'         => 'Remote - Kenya',
                ];
            @endphp
            
            <x-form-field>
                <x-form-label for="location">Location</x-form-label>
                <x-form-select name="location" id="location" :options="$locations" required/>
                <x-form-error name="location"/>
            </x-form-field>
        
    
            <x-form-field>
              <x-form-label for="salary">Salary</x-form-label>
              <x-form-input name="salary" id="salary" placeholder="Prefered Salary" value="{{ old('salary') }}" required/>
              <x-form-error name="salary"/>
            </x-form-field>

          </div>
        </div>
      </div>
    
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="/jobs" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
        <x-form-button type="submit">Save</x-form-button>
      </div>
    </form>
    

</x-layout>