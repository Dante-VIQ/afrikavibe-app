@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv);

    // $titles = explode(',', $titlesCsv);
@endphp
@foreach ($tags as $tag)
    <div class="d-flex align-items-center">
        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
            style="width: 55px; height: 55px;">
            <i class="fa fa-user-md text-primary"></i>
        </div>

        <div class="ms-4">
            @foreach ($this->titles as $title)
                <p class="text-white mb-2">{{ $feature->title }}</p>
                <h5 class="text-white mb-0">{{ $tag }}</h5>
            @endforeach
          
        </div>

    </div>
@endforeach
