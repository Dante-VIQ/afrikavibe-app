<div class="container-fluid header bg-light p-0 mb-5">
    <div class="row g-0 align-items-center flex-column flex-lg-row">
        <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
            <x-our-blog />
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            @unless (count($headers) == 0)

            @foreach ($headers as $header)
            <div class="owl-carousel header-carousel">
                <div class="owl-carousel-item relative">
                    <img class="img-fluid" src="{{ asset('storage/' . $header->image) }}" alt="{{ $header->name }}">
                    <div class="owl-carousel-text">
                        <h1 class="display-1 text-white mb-0">{{ $header->name }}</h1>
                    </div>
                </div>

            </div>
            @endforeach
            @endunless
        </div>

    </div>

    {{-- @if (auth()->check() && auth()->user()->isMaster())
        <div class="relative p-5 mx-auto" x-data="{ show: false }" x-cloak>
            <button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                    class="fa fa-add text-primary"></i>
                Add Header</button>

            <div class="mx-auto z-9 top-1/3 left-1/3" x-show="show" x-on:click.outside.prevent="show = false">
                @include('livewire.includes.header-show')
            </div>
        </div>
    @endif --}}
</div>
