    <div class="container-fluid bg-purple-950 text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5 mx-auto">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Free Area - Nakuru City</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+254 734591543</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>damalide20@gmail.com</p>
                    <div class="d-flex pt-2 justify-between">
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
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4 pl-3">Services</h5>

                    @foreach ($services as $service)
                        <div>
                            <i class="fa fa-arrow-right-long"></i>
                            <a class="btn text-light hover:spacing-1" href="">{{ $service->title }}</a>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-6 block">

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
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Stay Updated by subscribing to our daily read.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom text-white" href="#">Tembia</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a class="border-bottom text-white" href="#">Daniel M. Maina</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
