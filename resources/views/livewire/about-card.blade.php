<div>
    {{-- <div class="row g-5"> --}}
    @foreach ($abouts as $about)
        <section class="bg-white">
            <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                <div class="font-light text-gray-500 sm:text-lg">
                    @if ($editingAboutID == $about->id)
                    <div class="mb-2 text-black font-semibold">
                        <label for="NewTitle" class="inline-block text-lg mb-2">title</label>
                        <input wire:model.live="NewTitle" type="text"
                            class="border border-gray-200 rounded p-2 w-full" name="NewTitle"
                            value="{{ old('NewTitle') }}" />

                        @error('NewTitle')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                        {{ $about->title }}</h2>
                    <p class="mb-4">{{ $about->detail }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">

                    <img class="w-full h-72 max-h-full max-w-full rounded-lg"
                        src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}">


                    {{-- <img class="w-full h-72 max-h-full max-w-full rounded-lg" src="{{ $about->image }}" alt="{{ $about->name}}" > --}}

                    <img class="mt-6 w-full h-72 max-h-full lg:mt-10 rounded-lg"
                        src="{{ asset('storage/' . $about->photo) }}" alt="{{ $about->title }}" />


                </div>
            </div>
            </section>
    @endforeach

    {{-- </div> --}}

     <div class="flex">
        @can('create', $about)
            <div class="relative p-2" x-data="{ show: false }">

                <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                        class="fa fa-add text-primary"></i>
                    Create About Us</x-button>

                <div x-show="show" x-on:click.outside.prevent="show = false">
                    @include('livewire.includes.about-create')
                </div>

            </div>
        @endcan
        @can('update', $about)
            <div class="relative p-2" x-data="{ show: false }" x-cloak>

                <x-button wire:click="edit({{ $about->id }})" x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                        class="fa fa-add text-primary"></i>
                    Update About Us</x-button>

                <div x-show="show" x-on:click.outside.prevent="show = false">
                    @include('livewire.includes.about-update')
                </div>

            </div>
        @endcand
    </div>
</div>
