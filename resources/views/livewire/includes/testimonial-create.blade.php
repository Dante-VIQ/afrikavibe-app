<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1 ">Give us your Feeback.</h2>
        <p class="mb-4 font-semibold">We value your feedback.</p>
    </header>

    <form wire:submit.prevent="create">

        @csrf
        
        <div class="flex space-x-2">
            <div class="mb-6 text-black font-semibold">
                <label for="name" class="inline-block text-lg mb-2">Name</label>
                <input wire:model="name" type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" />

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="profession" class="inline-block text-lg mb-2">Profession</label>
                <input wire:model="profession" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="profession" value="{{ old('profession') }}" />

                @error('profession')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex space-x-2">
            <div class="mb-6 text-black font-semibold">
                <label for="remark" class="inline-block text-lg mb-2">Remarks</label>
                <input wire:model="remark" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="remark" value="{{ old('remark') }}" />

                @error('remark')
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
        </div>

        <div class="mb-6 text-black font-semibold">
            <x-button class="bg-laravel rounded py-2 px-4 hover:bg-black">
                Create
            </x-button>
            {{-- <a href="/" class="text-black ml-4"> Back </a> --}}
        </div>
    </form>
</x-card>
