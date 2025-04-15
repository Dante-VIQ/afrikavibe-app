<div>
    <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
        @unless (count($testimonials) == 0)
            @foreach ($testimonials as $testimonial)
                <div wire:key="{{ $testimonial->id }}" class="testimonial-item text-center">
                    {{-- @if ($testimonial->image) --}}
                        <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4"
                            src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}"
                            style="width: 100px; height: 100px;">

                    {{-- @endif --}}

                    <div class="testimonial-text rounded text-center p-4">
                        <p>{{ $testimonial->remark }}</p>
                        <h5 class="mb-1">{{ $testimonial->name }}</h5>
                        <span class="fst-italic">{{ $testimonial->profession }}</span>
                    </div>
                </div>
            @endforeach
        @else
            <p> No Testimonials Available at the Moment</p>
        @endunless
    </div>

    <div class="relative p-5 mx-auto" x-data="{ show: false }" x-cloak>
        <x-danger-button x-on:click.prevent="show = true" class="px-4 py-2 text-light rounded bg-primary"><i
                class="fa fa-add text-primary pr-3"></i>
            Add Testimonial</x-danger-button>

        <div class="mx-auto z-9 top-1/3 left-1/3" x-show="show" x-on:click.outside.prevent="show = false">
            @include('livewire.includes.testimonial-create')
        </div>
    </div>
</div>
