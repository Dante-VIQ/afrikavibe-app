<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">

    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1 ">Create a Destination</h2>
        {{-- <p class="mb-4 font-semibold">Post a gig</p> --}}
    </header>

    <div class="overflow overflow-scroll">
        <form wire:submit.prevent="create">
            @csrf
            <div class="mb-6 text-black font-semibold">
                <label for="name" class="inline-block text-lg mb-2">Name</label>
                <input wire:model.live="name" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="name" value="{{ old('name') }}" />

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="detail" class="inline-block text-lg mb-2">Details</label>
                <input wire:model.live="detail" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="detail" value="{{ old('detail') }}" />

                @error('detail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="images" class="inline-block text-lg mb-2">
                    Image
                </label>
                <input multiple wire:model.live="images" accept="image/jpg, image/png, image/jpeg" type="file"
                    class="border border-gray-200 rounded p-2 w-full"/>

                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror


                @if ($images)
                    @foreach ($images as $image)
                        <img class="img-fluid w-24 h-24" src="{{ $image->temporaryUrl() }}" alt="">
                    @endforeach
                @endif

                <div wire:loading wire:target="images">
                    <span class="text-green-500 text-center">Uploading...</span>
                </div>
            </div>

            <div class="mb-6 text-black font-semibold">
                <button class="bg-laravel rounded py-2 px-4">
                    Create
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </div>
</x-card>
