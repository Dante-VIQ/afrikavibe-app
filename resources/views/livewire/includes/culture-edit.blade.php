<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1">Post an Article</h2>
        <p class="mb-4 font-semibold">Post a gig</p>
    </header>

    <form wire:submit.prevent="create">
        @csrf

            <div class="mb-6 text-black font-semibold">
                <label for="NewName" class="inline-block text-lg mb-2">Name</label>
                <input wire:model.live="NewName" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="NewName" value="{{ old('NewName') }}" />
                @error('NewName')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="NewLocation" class="inline-block text-lg mb-2">Location</label>
                <input wire:model.live="NewLocation" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="NewLocation" value="{{ old('NewLocation') }}" />

                @error('NewLocation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-black font-semibold">
                <label for="NewDetail" class="inline-block text-lg mb-2">Details</label>
                <textarea wire:model.live="NewDetail" cols="30" rows="10" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="NewDetail" value="{{ old('NewDetail') }}"></textarea>
                    {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                @error('NewDetail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
                <div class="mb-6 text-black font-semibold">
                    <label for="NewMedia" class="inline-block text-lg mb-2">
                        Media
                    </label>
                    <input  accept="image/* video/*" wire:model="NewMedia" type="file" class="border border-gray-200 rounded p-2 w-full" />

                    @error('NewMedia')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    {{-- @if ($media)
                        <img class="img-fluid w-24 h-24" src="{{ $image->temporaryUrl() }}" alt="">
                    @endif --}}
                    <div wire:loading wire:target="media">
                        <span class="text-green-500 text-center">Uploading...</span>
                    </div>

</div>
                                <div class="mb-6 text-black font-semibold">
                        <label for="media_type" class="block text-sm font-medium text-gray-700 mb-1">Media Type</label>
                        <select wire:model="media_type" class="w-full border border-gray-300 rounded p-2 focus:ring-orange-400 focus:border-orange-400">
                            <option value="">Select Type</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>


        <div class="mb-6 text-black font-semibold">
            <button class="bg-laravel rounded py-2 px-4">
                Create
            </button>

            {{-- <a href="/" class="text-black ml-4"> Back </a> --}}
        </div>
    </form>
</x-card>