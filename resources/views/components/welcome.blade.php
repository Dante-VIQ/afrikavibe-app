<div wire:navigate.keep-alive>
    {{-- <!-- Header Start --> --}}
    <div class="container-fluid header p-0 mb-2">
        <div>
            <livewire:header-card />
        </div>
    </div>
    {{-- <!-- Header End --> --}}

    {{-- <div>
        @include('Partials._search')
    </div> --}}
    {{-- @if (auth()->check() && auth()->user()->isMaster())
        <a href="/Analysis" class="text-2xl text-center font-semiBold">Admin</a>
    @endif --}}
    {{-- <!-- Service Start --> --}}
    <div class="2xl:container container py-2">

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4 text-lg">Our Services</p>
            {{-- <h1>Travellers Options</h1> --}}
        </div>
        <div>
            <livewire:service-list lazy />
        </div>
    </div>
    {{-- <!-- Service End --> --}}
    {{-- <!-- Destination Start --> --}}
    <div class="container-xxl py-5">

        <div class="text-center mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Popular Destinaions</p>
            {{-- <h3>Places to Visit In East Africa</h3> --}}
        </div>

        <div>
            <livewire:doctors-card lazy />
        </div>

    </div>

    <div class="container-xxl py-5">

        <div class="text-center mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">People & Cultures</p>
            {{-- <h3>Places to Visit In East Africa</h3> --}}
        </div>

        <div>
            <livewire:culture-card lazy />
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

    <section class="container-xxl py-5 bg-white dark:bg-gray-900">
        {{-- <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6"> --}}
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <p class="d-inline-block border rounded-pill py-1 px-4">Daily read</p>

                {{-- <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p> --}}
            </div>
            <div>
                <livewire:blog-card lazy />
            </div>
        {{-- </div> --}}
    </section>



    {{-- <!-- Appointment Start --> --}}
    <div class="container-xxl py-3">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Appointment</p>
                    <h3 class="mb-4">Book A tour round Africa. We offer the best experirnces ranging from cultural
                        dances, festivals, nature walks, wildfire and many more</h3>
                    {{-- <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center     justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Call Us Now</p>
                            <h5 class="mb-0">+254 762 407 853</h5>
                        </div>
                    </div> --}}
                    {{-- <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Mail Us Now</p>
                            <h5 class="mb-0">go.africa@gmail.com</h5>
                        </div>
                    </div> --}}
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
    <livewire:footer-card />
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

</div>
