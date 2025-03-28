@props(['jobTags' => [], 'name' => 'tags', 'oldTags' => []])

<div x-data="{
  tags: {{ json_encode($oldTags) }},
  newTag: '',
  availableTags: {{ json_encode($jobTags) }},
  filteredTags: [],
  updateSuggestions() {
      // Filter the available tags based on newTag input,
      // excluding tags already selected
      if (this.newTag.trim() === '') {
          this.filteredTags = [];
          return;
      }
      this.filteredTags = this.availableTags.filter(tag =>
          tag.toLowerCase().includes(this.newTag.toLowerCase()) &&
          !this.tags.includes(tag)
      );
  }
}" {{ $attributes->merge(["class" => "relative z-0 w-full mb-5 group dark:text-white"]) }}>

  <!-- Hidden input to store selected tags -->
  <input type="hidden" name="{{ $name }}" x-model="tags.join(',')" required>

  <!-- Tags display -->
  <div class="flex flex-wrap gap-2 pb-2">
      <template x-for="(tag, index) in tags" :key="index">
          <div
              class="flex items-center bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded
                     dark:bg-blue-900 dark:text-blue-200"
          >
              <span x-text="tag"></span>
              <button
                  @click.prevent="tags.splice(index, 1)"
                  class="ml-1 hover:text-blue-600 dark:hover:text-blue-300"
              >
                  &times;
              </button>
          </div>
      </template>
  </div>

  <!-- Input field with suggestions -->
  <div class="relative">
      <input
          x-model="newTag"
          @input="updateSuggestions()"
          @keydown.enter.prevent="
              if (
                  newTag.trim() &&
                  tags.length < 3 &&
                  availableTags.includes(newTag.trim()) &&
                  !tags.includes(newTag.trim())
              ) {
                  tags.push(newTag.trim());
                  newTag = '';
                  filteredTags = [];
              }
          "
          @keydown.backspace="if (!newTag && tags.length > 0) tags.pop()"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0
                 border-b-2 border-gray-300 appearance-none dark:text-white
                 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none
                 focus:ring-0 focus:border-blue-600 peer"
          :placeholder="tags.length < 3 ? 'Add a tag...' : 'Maximum 3 tags reached'"
          :disabled="tags.length >= 3"
      />

      <!-- Suggestions dropdown (dark theme) -->
      <ul
          x-show="filteredTags.length > 0"
          class="absolute z-10 w-full mt-1 rounded shadow-lg max-h-40 overflow-y-auto
                 border border-gray-300 bg-white text-gray-800
                 dark:bg-gray-800 dark:text-white dark:border-gray-700"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 translate-y-1"
          x-transition:enter-end="opacity-100 translate-y-0"
          x-transition:leave="transition ease-in duration-100"
          x-transition:leave-start="opacity-100 translate-y-0"
          x-transition:leave-end="opacity-0 translate-y-1"
      >
          <template x-for="(tag, index) in filteredTags" :key="index">
              <li
                  @click="
                      if (tags.length < 3) {
                          tags.push(tag);
                          newTag = '';
                          filteredTags = [];
                      }
                  "
                  x-text="tag"
                  class="px-3 py-2 cursor-pointer border-b border-gray-200
                         dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-blue-600
                         last:border-b-0"
              ></li>
          </template>
      </ul>
  </div>

  <!-- Error message -->
  @error($name)
    <p class="mt-2 text-sm/6 text-red-600">{{ $message }}</p>
  @enderror
</div>