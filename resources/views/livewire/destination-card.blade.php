<div>
    <div>
        <form action="">
            <x-select  name="" id="">
                <option value="">Select Place</option>

                @unless (count($destinations) == 0)


                    @foreach ($this->destinations as $destination)
                        <option wire:model.live="destinationID" value="{{ $destination->id }}">{{ $destination->name }}</option>
                    @endforeach
                @else
                    <p class="text-black justify-center text-xl">No Destinations</p>
                @endunless
            </x-select>

            {{-- <x-select  name="" id="">
                <option value="">Select Place</option>

                @unless (count($destinations) == 0)


                    @foreach ($this->destinations as $destination)
                        <option wire:model.live="destinationID" value="{{ $destination->id }}">{{ $destination->name }}</option>
                    @endforeach
                @else
                    <p class="text-black justify-center text-xl">No Destinations</p>
                @endunless
            </x-select> --}}
        </form>
    </div>
{{-- @if(auth()->check() && auth()->user()->isMaster()) --}}

{{-- @can('create', $destination)
    <div class="relative p-5 mx-auto" x-data="{ show: false }" x-cloak>
        <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                class="fa fa-add text-primary"></i>
            Add Destination</x-button>

        <div class="mx-auto z-9 top-1/3 left-1/3 overflow-y-scroll" x-show="show" x-on:click.outside.prevent="show = false">
            @include('livewire.includes.Destination.destination-create')
        </div>
    </div>
    @endcan --}}
    {{-- @endif --}}
</div>
