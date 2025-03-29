@props(['multiple' => false, 'name' => 'file', 'id' => 'file'])

<div x-data="fileSelector()" class="max-w-md mx-auto pt-6">
  <!-- File Input Label -->
  <label for="{{ $id }}" class="cursor-pointer block text-center border-2 border-dashed border-gray-600 dark:border-gray-500 p-6 rounded-lg hover:bg-gray-800 transition-colors">
    <input type="file" id="{{ $id }}" name="{{ $name }}" {{ $multiple ? 'multiple' : '' }} class="hidden" @change="updateFiles">
    <span class="text-gray-400 dark:text-gray-300">Drag &amp; drop or click to select {{ ucwords(str_replace(['-', '_'], ' ', $name)) }} file </span>
  </label>
  
  <!-- Selected Files List -->
  <template x-if="files.length">
    <div class="mt-4">
      <h3 class="text-lg font-semibold text-gray-100 dark:text-gray-200 mb-2">Selected File:</h3>
      <ul class="divide-y divide-gray-700">
        <template x-for="(file, index) in files" :key="index">
          <li class="py-2 text-gray-300 dark:text-gray-400" x-text="file.name"></li>
        </template>
      </ul>
    </div>
  </template>
</div>


<!-- Alpine.js Component Script -->
<script>
  function fileSelector() {
    return {
      files: [],
      updateFiles(event) {
        this.files = Array.from(event.target.files);
      }
    }
  }
</script>