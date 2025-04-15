<div>

    <div class="text-center mx-auto mb-5 wow fadeInUp space-x-2" data-wow-delay="0.1s" style="max-width: 600px;">
        <p class="d-inline-block border rounded-pill py-1 px-4">Smart Cities</p>
        <h3>Top Cities in Africa</h3>
    </div>
    <div class="grid gap-5 lg:gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

        @unless (count($cities) == 0)


            @foreach ($cities as $city)
                <div class="box rounded-b-lg border border-b-2">
                    <div class="img-box rounded-t-xl">
                        <img class="h-64 w-screen object-cover" src="{{ asset('storage/' . $city->image) }}" alt="{{ $city->name }}">
                    </div>
                    <div class="detail-box justify-center text-center text-lg text-gray-600 bg-purple-200 p-3 space-x-2">
                        <h5>
                            {{ $city->name }}
                        </h5>
                        <h6 class="">
                            {{ $city->country }}
                        </h6>
                    </div>
                </div>
            @endforeach
        @else
            <p>No Cities Available</p>
        @endunless
    </div>

    {{-- @if (auth()->check() && auth()->user()->isMaster())
        <div class="relative p-5" x-data="{ show: false }" x-cloak>

            <x-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                    class="fa fa-add text-primary"></i>
                Add City</x-button>

            <div x-show="show" x-on:click.outside.prevent="show = false">
                @include('livewire.includes.city-create')
            </div>

        </div>
    @endif --}}

</div>


<!-- end team section -->
