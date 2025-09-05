<div class="bg-purple-950 text-white mt-5 pt-4 p-4 wow fadeIn">

    <div class="grid gap-5 lg:gap-12 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 text-center"
        data-wow-delay="0.1s">

        <div class="text-gray-200">
            <h5 class="text-light mb-4">Address</h5>
            <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Free Area - Nakuru City</p>
            <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+254 734591543</p>
            <p class="mb-2"><i class="fa fa-envelope me-3"></i>damalide20@gmail.com</p>
            <div class="d-flex pt-2 justify-around">
                <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                        class="fab fa-tiktok"></i></a>
                <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                        class="fab fa-youtube"></i></a>
                <a class="btn btn-outline-light btn-social rounded-circle" href=""><i
                        class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="text-gray-200">
            <h5 class="text-light mb-4 pl-3">Services</h5>

            @foreach ($services as $service)
                <div>
                    <i class="fa fa-arrow-right-long"></i>
                    <a class="btn text-light hover:spacing-1" href="">{{ $service->title }}</a>
                </div>
            @endforeach
        </div>

        <div class="text-gray-200">

            <h5 class="text-light mb-4 pl-3">Quick Links</h5>
            <div class="inline-block">
                <div>
                    <i class="fa fa-arrow-right-long"></i>
                    <a class="btn text-light" href="/about">About Us</a>
                </div>
                <div>
                    <i class="fa fa-arrow-right-long"> <a class="btn text-light" href="/contact"></i>Contact
                    Us</a>
                </div>
                <div>
                    <i class="fa fa-arrow-right-long"> <a class="btn text-light" href="/services"></i>Our
                    Services</a>
                </div>
                <div>
                    <i class="fa fa-arrow-right-long"><a class="btn text-light" href=""></i>Support</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start text-gray-100 mb-3 mb-md-0 justify-around">
                    &copy; <a class="border-bottom text-white" href="#">Tembia</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end mb-3 mb-md-0">
                    Designed By <a class="border-bottom text-white" href="#">Daniel M. Maina</a>
                </div>
            </div>
        </div>
    </div>
</div>
