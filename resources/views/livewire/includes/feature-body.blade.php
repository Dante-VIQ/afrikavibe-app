<div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">

    <div class=" p-lg-5 ps-lg-0">
        <p class="d-inline-block border rounded-pill text-light py-1 px-4">Features</p>
        <h1 class="text-white mb-4">Why Choose Us!</h1>
        <p class="text-white mb-4 pb-2">{{ $feature->description }}</p>

        <div class="row g-4">
            <div class="col-6">


                    {{-- <x-feature-tags :tagsCsv="$feature->tags" /> --}}


            </div>

        </div>
    </div>
</div>

<div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s"  style="min-height: 400px;">

        <div class="position-relative h-100 d-flex">
            {{-- <img class="position-absolute img-fluid w-100 h-100" src="img/feature.jpg"
            style="object-fit: cover;" alt=""> --}}

            <img class="absolute img-fluid w-100 h-100 max-w-full max-h-full" src="{{ asset('storage/' . $feature->image) }}"
                alt="{{ $feature->title }}" style="object-fit: cover;" />
        </div>
</div>
