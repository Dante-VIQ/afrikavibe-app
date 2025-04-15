<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1">Post an Article</h2>
        <p class="mb-4 font-semibold">Post a gig</p>
    </header>

    <form wire:submit.prevent="update">
        @csrf
        <div class="flex space-x-2">
            <div class="mb-6 text-black font-semibold">
                <label for="NewName" class="inline-block text-lg mb-2">Place</label>
                <input wire:model.live="NewName" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="NewName" value="{{ old('NewName') }}" />

                @error('NewName')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="NewDepartment" class="inline-block text-lg mb-2">Price</label>
                <input wire:model.live="NewDepartment" type="number" class="border border-gray-200 rounded p-2 w-full"
                    name="NewDepartment" value="{{ old('NewDepartment') }}" />

                @error('NewDepartment')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6 text-black font-semibold">
            <label for="NewDetail" class="inline-block text-lg mb-2">Details</label>
            <textarea wire:model.live="NewDetail" type="number" class="border border-gray-200 rounded p-2 w-full" name="NewDetail"
                value="{{ old('NewDetail') }}"></textarea>

            @error('NewDetail')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex space-x-2">
            <div class="mb-6 text-black font-semibold">
                <label for="NewLinks" class="inline-block text-lg mb-2">links</label>
                <input wire:model.live="NewLinks" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="NewLinks" value="{{ old('NewLinks') }}" />

                @error('NewLinks')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="NewImage" class="inline-block text-lg mb-2">
                    Image
                </label>
                <input wire:model.live="NewImage" type="file" class="border border-gray-200 rounded p-2 w-full" />

                @error('NewImage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if ($this->NewImage)
                    <img class="img-fluid w-24 h-24" src="{{ $NewImage->temporaryUrl() }}" alt="">
                @endif
                <div wire:loading wire:target="NewImage">
                    <span class="text-green-500 text-center">Uploading...</span>
                </div>
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
