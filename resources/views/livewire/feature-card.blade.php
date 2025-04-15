<div>

    <div class="container">
        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <p class="d-inline-block border rounded-pill py-1 px-4 text-lg">Events</p>
        </div>
        <div class="grid lg:grid-cols-4 gap-4 border ">


            @unless (count($features) == 0)

                @foreach ($features as $feature)
                    @include('livewire.includes.events')
                @endforeach
            @else
                <p class="text-black text-lg text-center italic">Events Are Not Available At The Moment.</p>
            @endunless
        </div>
    </div>

    {{-- @can('create', $feature)
        <div class="relative p-5 mx-auto" x-data="{ show: false }" x-cloak>
            <x-button x-on:click.prevent="show = true" class=" justify-center px-4 py-2 text-light rounded bg-primary"><i
                    class="fa fa-add text-primary"></i>
                Create Event</x-button>

            <div x-show="show" x-on:click.outside.prevent="show = false">
                @include('livewire.includes.feature-create')
            </div>
        </div>
    @endcan --}}



</div>
