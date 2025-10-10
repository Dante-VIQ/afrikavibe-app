<div>
    {{-- <!-- Header Start --> --}}

    <div>
        <livewire:header-page />
    </div>
    {{-- partner --}}
    {{-- @include('partner.index') --}}

    {{-- <!-- Header End --> --}}

    {{-- <!-- Service Start --> --}}
    <div class="container-xxl py-5">

        {{-- <div class="text-center mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Popular Destinations</p>
            <h3>Places to Visit In East Africa</h3>
        </div> --}}

        <div class="text-center mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

            <h2 class="text-2xl sm:text-3xl font-bold text-green-800 mb-4">
                Destinations
            </h2>
        </div>
        <div>
            {{-- <livewire:doctors-card lazy /> --}}
            <livewire:doctor-page />
        </div>


    </div>
    {{-- <div class="2xl:container container py-2">

    </div> --}}


    {{-- <!-- Service End --> --}}
    {{-- <!-- Destination Start --> --}}


    <div class="container-xxl py-5">

        <div class="text-center mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

            <h2 class="text-2xl sm:text-3xl font-bold text-green-800 mb-4">
                People and Culture
            </h2>
        </div>

        <div>
            <livewire:culture-page />
        </div>

    </div>
    {{-- <!-- Destination End --> --}}
    {{-- <x-splash-card   class="w-[400px] h-[300px] my-8" /> --}}
    {{-- <x-splash-card photo="/img/injera.png" mask="/img/logo1.png" title="Nyama Choma"
        caption="Kenya’s signature roasted meat, a dish that brings people together over laughter, stories, and spice."
        buttonText="Read More" buttonLink="/culture-cuisine/nyama-choma" /> --}}

    <div class="container-xxl py-5">

        <x-advertisers />

    </div>


    <section class="container-xxl py-5 bg-white">

        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-green-800 mb-4">
                Daily Read
            </h2>
        </div>
        <div>
            <livewire:blog-page />
        </div>

    </section>

    <div class="w-full flex justify-center my-4">
        @include('layouts.partials.ads')
    </div>

    {{-- <!-- Appointment Start --> --}}
    {{-- <div class="container-xxl py-3">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Appointment</p>
                    <h3 class="text-2xl sm:text-3xl text-gray-600 mb-4 mt-4">Book a tour round Africa. We offer the best
                        experiences ranging from cultural
                        dances, festivals, nature walks, wildfire and many more</h3>


                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form>
                            @csrf
                            <livewire:appointment-form />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <!-- Appointment End --> --}}



    <!-- Testimonial End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

</div>
