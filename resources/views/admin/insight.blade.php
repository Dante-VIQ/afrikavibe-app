<div class="row">
    <div class="col-sm-12">
        <div
            class="statistics-details d-flex align-items-center justify-content-between px-5">
            <div>
                <p class="statistics-title">Bounce Rate</p>
                <h3 class="rate-percentage text-success text-center">0%</h3>
                {{-- <p class="text-danger d-flex text-xl"><i
                        class="mdi mdi-menu-down"></i><span>-0.5%</span></p> --}}
            </div>
           
            {{-- <div>
                <p class="statistics-title">New Sessions</p>
                <h3 class="rate-percentage">{{ $newSessions }}</h3>
                <p class="text-danger d-flex"><i
                        class="mdi mdi-menu-down"></i><span>68.8</span></p>
            </div> --}}
            <div class="d-none d-md-block">
                <p class="statistics-title">Avg. Time on Site</p>
                <h3 class="rate-percentage text-success text-center">{{ isset($stats['avg_time']) ? gmdate('i:s', $stats['avg_time']) : '0:00' }}</h3>
                {{-- <p class="text-success d-flex"><i
                        class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
            </div>
            <div>
                <p class="statistics-title">Cultures</p>
              
                <h3 class="rate-percentage text-success text-center"><span>{{ $cultureCount }}</span></h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Blogs</p>

                <h3 class="rate-percentage text-success text-center">{{ $this->blogCount }}</h3>

                {{-- <p class="text-danger d-flex"><i
                        class="mdi mdi-menu-down"></i><span>68.8</span></p> --}}
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Destinations</p>
                <h3 class="rate-percentage text-success text-center">{{ $this->doctorCount }}</h3>
                {{-- <p class="text-success d-flex"><i
                        class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
            </div>
        </div>
    </div>
</div>