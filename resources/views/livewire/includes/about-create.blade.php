<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1 text-slate-700">Add Doctor Details</h2>
        {{-- <p class="mb-4 font-semibold">Post a gig</p> --}}
    </header>

    <form wire:submit.prevent="create">
        @csrf
        <div class="flex space-x-2">
            <div class="mb-6 text-black font-semibold">
                <label for="title" class="inline-block text-lg mb-2">title</label>
                <input wire:model.live="title" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="title" value="{{ old('title') }}" />

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="detail" class="inline-block text-lg mb-2">Detail</label>
                <input wire:model="detail" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="detail" value="{{ old('detail') }}" />

                @error('detail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex space-x-2">

            <div class="mb-6 text-black font-semibold">
                <label for="photo" class="inline-block text-lg mb-2">
                    photo
                </label>
                <input wire:model="photo" accept="image/png, image/jpeg, image/jfif, image/jpg" type="file"
                    class="border border-gray-200 rounded p-2 w-full" />

                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if ($photo)
                    {{-- @foreach ($images as $image) --}}
                    <img class="img-fluid w-24 h-24" src="{{ $photo->temporaryUrl() }}" alt="">
                    {{-- @endforeach --}}
                @endif
                <div wire:loading wire:target="photo">
                    <span class="text-green-500 text-center">Uploading...</span>
                </div>
            </div>
            <div class="mb-6 text-black font-semibold">
                <label for="merit" class="inline-block text-lg mb-2">merit</label>
                <input wire:model.live="merit" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="merit" value="{{ old('merit') }}" />

                @error('merit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="image" class="inline-block text-lg mb-2">
                    Image
                </label>
                <input wire:model.live="image" accept="image/png, image/jpeg, image/jfif, image/jpg" type="file"
                    class="border border-gray-200 rounded p-2 w-full" />

                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if ($image)
                    {{-- @foreach ($images as $image) --}}
                    <img class="img-fluid w-24 h-24" src="{{ $image->temporaryUrl() }}" alt="">
                    {{-- @endforeach --}}
                @endif
                <div wire:loading wire:target="image">
                    <span class="text-green-500 text-center">Uploading...</span>
                </div>
            </div>
        </div>



        <div class="mb-6 text-black font-semibold">
            <x-secondary-button wire:click.prevent="create" class="bg-laravel rounded py-2 px-4">
                Create
            </x-secondary-button>
        </div>
    </form>
</x-card>
