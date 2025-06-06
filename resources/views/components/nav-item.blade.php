<div class="navbar navbar-expand-lg  navbar-light sticky-top wow fadeIn" data-wow-delay="0.1s">

    {{-- <x-button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </x-button> --}}

    {{-- <div class="collapse navbar-collapse" id="navbarCollapse"> --}}
    <div class="navbar ms-auto p-5 p-lg-0 text-gray-600 lg:flex text-lg sm:text-xsm space-x-2">
        <a wire:navigate href="/dashboard" class="nav-link text-slate-800 active">Home</a>
        <a wire:navigate href="/destination" class="nav-link">Destinations</a>
        <a wire:navigate href="/culture" class="nav-link">Culture</a>
        <a wire:navigate href="/main" class="nav-link">Blogs</a>

        @if (auth()->check() && auth()->user()->isMaster())
            <a wire:navigate href="/Analysis" class="nav-link">Analytics</a>
        @endif
     
    

            {{-- <a wire:navigate  href="/appointment" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Book Now<i class="fa fa-arrow-right ms-3"></i></a> --}}
    </div>
    {{-- </div> --}}




</div>
