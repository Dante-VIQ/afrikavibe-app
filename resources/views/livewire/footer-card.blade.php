<div class="container bg-purple-950 text-light mt-5 pt-4 wow fadeIn" data-wow-delay="0.1s">

    <div class="grid gap-5 lg:gap-16 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 items-center text-center">
        <div>
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
        <div>
            <h5 class="text-light mb-4 pl-3">Services</h5>

            @foreach ($services as $service)
                <div>
                    <i class="fa fa-arrow-right-long"></i>
                    <a class="btn text-light hover:spacing-1" href="">{{ $service->title }}</a>
                </div>
            @endforeach
        </div>
        <div>

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
        <div>
            <h5 class="text-light mb-4">Newsletter</h5>
            <p>Stay Updated by subscribing to our daily read.</p>
            <div class="col-12 col-sm-6 relative mx-auto" style="max-width: 600px;">
                <input class="form-control border-0 w-100 max-w-full" type="text" placeholder="Your email">
                <button type="submit" class=" btn btn-primary py-2 absolute top-0 end-0 mt-2">SignUp</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom text-white" href="#">Tembia</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end mb-3 mb-md-0">
                    Designed By <a class="border-bottom text-white" href="#">Daniel M. Maina</a>
                </div>
            </div>
        </div>
    </div>
</div>
