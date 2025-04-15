<x-card class="p-10 max-w-lg" style="top: 10%; left: 30%;">
    <header class="text-center text-black">
        <h2 class="text-2xl font-bold uppercase mb-1">About</h2>
        {{-- <p class="mb-4 font-semibold">Post a gig</p> --}}
    </header>


        <form>
            @csrf
            <div class="flex space-x-2">
                <div class="mb-6 text-black font-semibold">
                    <label for="NewTitle" class="inline-block text-lg mb-2">title</label>
                    <input wire:model.live="NewTitle" type="text"
                        class="border border-gray-200 rounded p-2 w-full" name="NewTitle"
                        value="{{ old('NewTitle') }}" />

                    @error('NewTitle')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 text-black font-semibold">
                    <label for="NewDetail" class="inline-block text-lg mb-2">Detail</label>
                    <input wire:model.live="NewDetail" type="text"
                        class="border border-gray-200 rounded p-2 w-full" name="NewDetail"
                        value="{{ old('NewDetail') }}" />

                    @error('NewDetail')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex space-x-2">
                <div class="mb-6 text-black font-semibold">
                    <label for="NewMerit" class="inline-block text-lg mb-2">merit</label>
                    <input wire:model.live="NewMerit" type="text"
                        class="border border-gray-200 rounded p-2 w-full" name="NewMerit"
                        value="{{ old('NewMerit') }}" />

                    @error('NewMerit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 text-black font-semibold">
                    <label for="NewImage" class="inline-block text-lg mb-2">
                        Image
                    </label>
                    <input wire:model="NewImage" accept="image/png, image/jpeg, image/jfif, image/jpg"
                        type="file" class="border border-gray-200 rounded p-2 w-full" />

                    @error('NewImage')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    @if ($NewImage)
                        {{-- @foreach ($images as $image) --}}
                        <img class="img-fluid w-24 h-24" src="{{ $image->temporaryUrl() }}" alt="" />
                        {{-- @endforeach --}}
                    @endif
                    <div wire:loading wire:target="NewImage">
                        <span class="text-green-500 text-center">Uploading...</span>
                    </div>
                </div>
            </div>
            <div class="mb-6 text-black font-semibold">
                <label for="NewPhoto" class="inline-block text-lg mb-2">
                    photo
                </label>
                <input wire:model="NewPhoto" accept="image/png, image/jpeg, image/jfif, image/jpg" type="file"
                    class="border border-gray-200 rounded p-2 w-full" />

                @error('NewPhoto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if ($NewPhoto)
                    {{-- @foreach ($images as $image) --}}
                    <img class="img-fluid w-24 h-24" src="{{ $NewPhoto->temporaryUrl() }}" alt="" />
                    {{-- @endforeach --}}
                @endif
                <div wire:loading wire:target="NewPhoto">
                    <span class="text-green-500 text-center">Uploading...</span>
                </div>
            </div>
            <div class="mb-6 text-black font-semibold">

                <x-button wire:click.prevent="update"
                    class="bg-laravel rounded py-2 px-4">
                    Update
                </x-button>

            </div>
        </form>

</x-card>
