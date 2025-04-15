<div class="row g-5">
        <div class="col-lg-6 d-flex flex-column wow fadeIn" data-wow-delay="0.1s">
            {{-- @if ($about->images) --}}
            <img class="img-fluid rounded w-75 align-self-end" src="{{ asset('storage/' . $about->images) }}"
                alt="">
            <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="{{ asset('storage/' . $about->images) }}"
                alt="" style="margin-top: -25%;">
            {{-- @endif --}}
        </div>

        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <p class="d-inline-block border rounded-pill py-1 px-4">About Us</p>
            <h1 class="mb-4">{{ $about->title }}</h1>
            <p>{{ $about->detail }}
            </p>

            <p><i class="far fa-check-circle text-primary me-3"></i>{{ $about->merit }}</p>

            <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">Read More</a>
        </div>
</div>
