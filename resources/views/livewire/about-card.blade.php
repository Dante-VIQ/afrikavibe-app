<div>
    {{-- <div class="row g-5"> --}}
    @foreach ($abouts as $about)
        @include('about-fig')
    @endforeach

    {{-- </div> --}}

     <div class="flex">

            <div class="relative p-2" x-data="{ show: false }">

                <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-black rounded bg-primary"><i
                        class="fa fa-add text-primary"></i>
                    Create About Us</x-button>

                <div x-show="show" x-on:click.outside.prevent="show = false">
                    @include('livewire.includes.about-create')
                </div>

            </div>

        @can('update', $about)
            <div class="relative p-2" x-data="{ show: false }" x-cloak>

                <x-button wire:click="edit({{ $about->id }})" x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                        class="fa fa-add text-primary"></i>
                    Update About Us</x-button>

                <div x-show="show" x-on:click.outside.prevent="show = false">
                    @include('livewire.includes.about-update')
                </div>

            </div>
        @endcan
    </div>
</div>
