<div x-data="{ open: false }" class="relative" x-cloak>
    <!-- Button to Open Popup -->
    <button
        @click="open = true"
        class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        Share Your Experience
    </button>

    <!-- Popup Modal -->
    <div
        x-show="open" x-on:click.outside.prevent="{ open: false }"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        x-transition>
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
            <!-- Close Button -->
            <button
                @click="open = false"
                class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
                ✖
            </button>

            <h2 class="text-xl font-semibold mb-4">Create Post</h2>


                <form wire:submit.prevent="save" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Title</label>
                        <input type="text" wire:model="title" class="w-full border rounded px-3 py-2">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Description</label>
                        <textarea wire:model="body" class="w-full border rounded px-3 py-2"></textarea>
                        @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="media" class="block text-sm font-medium">Upload Photo or Video</label>
                        <input type="file" accept="image/* video/*" wire:model="media">
                        @error('media') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="media_type" class="block text-sm font-medium text-gray-700 mb-1">Media Type</label>
                        <select wire:model="media_type" class="w-full border border-gray-300 rounded p-2 focus:ring-orange-400 focus:border-orange-400">
                            <option value="">Select Type</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Post
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>
