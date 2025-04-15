<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1 ">Post an Article</h2>
        <p class="mb-4 font-semibold">Post a gig</p>
    </header>

    <form wire:submit.prevent="create">
        @csrf
        <div class="flex space-x-2">
            <div class="mb-6 text-black font-semibold">
                <label for="title" class="inline-block text-lg mb-2">title</label>
                <input wire:model="title" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="title" value="{{ old('title') }}" />

               

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="description" class="inline-block text-lg mb-2">Description</label>
                <input wire:model="description" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="description" value="{{ old('description') }}" />

                @error('description')
                    <p class="text-red-900 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex space-x-2">
            {{-- <div class="mb-6 text-black font-semibold">
                <label for="tags" class="inline-block text-lg mb-2">tags</label>
                <input wire:model="tags" type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
                    value="{{ old('tags') }}" />

                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            <div class="mb-6 text-black font-semibold">
                <label for="image" class="inline-block text-lg mb-2">
                    Image
                </label>
                <input wire:model="image" type="file" class="border border-gray-200 rounded p-2 w-full" />

                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if ($image)
                    <img class="img-fluid w-24 h-24" src="{{ $image->temporaryUrl() }}" alt="">
                @endif
                <div wire:loading wire:target="image">
                    <span class="text-green-500 text-center">Uploading...</span>
                </div>
            </div>

        </div>
        <div class="mb-6 text-black font-semibold">
            <button class="bg-success rounded py-2 px-4">
                Create
            </button>

        </div>
    </form>
</x-card>
