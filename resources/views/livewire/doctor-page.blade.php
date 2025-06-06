<div>
    <section class="bg-white">
        <div class="px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-6">
            <div class="grid gap-5 lg:gap-16 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 wow FadeInUp"
                data-wow-delay="0.1s">

                @unless (count($doctors) == 0)
                    @foreach ($doctors as $doctor)
                        <x-destination-card>
                            @include('livewire.includes.doctor-show')                           
                        </x-destination-card>
                    @endforeach
                @else
                    <p class="text-black-italic text-lg text-center">No Destinations At The Moment</p>
                @endunless

            </div>
            <div class="mt-12 text-center">
                <a href="/eco-trails"
                    class="inline-block bg-green-700 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-green-800 transition">
                    Discover More Destinations
                </a>
            </div>
        </div>
    </section>

</div>