<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1">Add a City</h2>
        <p class="mb-4 font-semibold">Tell us where it is found</p>
    </header>

    <form wire:submit.prevent="create">
        @csrf

        <div class="mb-6 text-black font-semibold">
            <label for="name" class="inline-block text-lg mb-2">City Name</label>
            <input wire:model.live="name" type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                value="{{ old('name') }}" />

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 text-black font-semibold">
            <label for="country" class="inline-block text-lg mb-2">Country</label>
            <textarea wire:model.live="country" type="text" class="border border-gray-200 rounded p-2 w-full" name="country"
                value="{{ old('country') }}"></textarea>

            @error('country')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 text-black font-semibold">
            <label for="image" class="inline-block text-lg mb-2">
                Image
            </label>
            <input wire:model.live="image" type="file" class="border border-gray-200 rounded p-2 w-full" />

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



        <div class="mb-6 text-black font-semibold">
            <x-secondary-button class="bg-laravel rounded py-2 px-4">
                Create
            </x-secondary-button>

            {{-- <a href="/" class="text-black ml-4"> Back </a> --}}
        </div>
    </form>
</x-card>
