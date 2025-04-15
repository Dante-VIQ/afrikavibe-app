<x-card class="p-6 mx-auto mt-24"  style="top: 10%; left: 30%;">

    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1 ">Post an Article</h2>
        {{-- <p class="mb-4 font-semibold">Post a gig</p> --}}
    </header>

    <div>
        
        <form x-data="open: false">
            @csrf

            <div class="mb-6 text-black font-semibold">
                <label for="NewTitle" class="inline-block text-lg mb-2">Service Title</label>
                <input wire:model.live="NewTitle" type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
                    value="{{ old('NewTitle') }}" />

                @error('NewTitle')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="NewCategory" class="inline-block text-lg mb-2">Description</label>
                <textarea wire:model.live="NewCategory" rows="10" cols="10" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="NewCategory" value="{{ old('NewCategory') }}"></textarea>

                @error('NewCategory')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <x-button wire:click.prevent='update' class="bg-laravel rounded py-2 px-4">
                    Update
                </x-button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
            
            
        </form>
    </div>
</x-card>
