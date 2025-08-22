<div wire:poll.keep-alive.2s>
    {{-- <!-- Header Start --> --}}

    <div>
        <livewire:header-page />
    </div>

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

        <div>
            {{-- <livewire:service-list lazy /> --}}
            <x-eco--tours />
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

    {{-- events --}}
    {{-- <div class="container-fluid overflow-hidden my-5 px-lg-0">

        <div class="container feature px-lg-0">
            <div>
                <livewire:feature-card lazy />

            </div>
        </div>

    </div> --}}

    {{-- <!-- Feature Start --> --}}

    {{-- <!-- Feature End --> --}}

    <section class="container-xxl py-5 bg-white">
        {{-- <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6"> --}}
        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-green-800 mb-4">
                Daily Read
            </h2>
        </div>
        <div>
            <livewire:blog-page />
        </div>
        {{-- </div> --}}
    </section>



    {{-- <!-- Appointment Start --> --}}
    <div class="container-xxl py-3">
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
    </div>
    {{-- <!-- Appointment End --> --}}


    <!-- Testimonial Start -->
    <div class="container-xxl py-3">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Testimonials</p>
                <h1>What our travellers say!</h1>
            </div>

            <livewire:testimonial-card />


        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div>
        <livewire:footer-card />
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-success btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

</div>
