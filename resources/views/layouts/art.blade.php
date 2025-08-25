<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="Africa travel, African culture, African destinations, Explore Africa, travel blog, African art, African history, African cuisine.">
    <meta name="description"
        content="Discover the rich tapestry of Africa's diverse cultures, breathtaking landscapes, and umique experiences. Explore top travel destinations, art, history, and cuisine on AfrikaVibe.">
    <title>{{ config('app.name', 'Tembia') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- <link rel="preload" href="{{ asset('/css/style.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="preload" href="{{ asset('/css/tailwind.css') }}" rel="stylesheet"> --}}


    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            "50": "#eff6ff",
                            "100": "#dbeafe",
                            "200": "#bfdbfe",
                            "300": "#93c5fd",
                            "400": "#60a5fa",
                            "500": "#3b82f6",
                            "600": "#2563eb",
                            "700": "#1d4ed8",
                            "800": "#1e40af",
                            "900": "#1e3a8a",
                            "950": "#172554"
                        }
                    }
                },
                fontFamily: {
                    'body': [
                        'Inter',
                        'ui-sans-serif',
                        'system-ui',
                        '-apple-system',
                        'system-ui',
                        'Segoe UI',
                        'Roboto',
                        'Helvetica Neue',
                        'Arial',
                        'Noto Sans',
                        'sans-serif',
                        'Apple Color Emoji',
                        'Segoe UI Emoji',
                        'Segoe UI Symbol',
                        'Noto Color Emoji'
                    ],
                    'sans': [
                        'Inter',
                        'ui-sans-serif',
                        'system-ui',
                        '-apple-system',
                        'system-ui',
                        'Segoe UI',
                        'Roboto',
                        'Helvetica Neue',
                        'Arial',
                        'Noto Sans',
                        'sans-serif',
                        'Apple Color Emoji',
                        'Segoe UI Emoji',
                        'Segoe UI Symbol',
                        'Noto Color Emoji'
                    ]
                }
            }
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
          @auth
            @include('livewire.layout.navigation')
        @else
            @include('livewire.welcome.navigation')
        @endauth
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <x-sidebar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    {{ $slot }}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Vumbi Ventures</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2025. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

@livewireScripts

    {{-- @push('scripts') --}}

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    {{-- <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script> --}}
    <!-- endinject -->
    <!-- Custom js for this page-->
    {{-- <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('assets/js/dashboard.js') }}"></script> --}}
    {{-- <script src="{{ asset('/js/chart.js') }}"></script> --}}
    <script src="{{ asset('/resources/js/content-tracking.js') }}"></script>
    {{-- <script src="{{ asset('/resources/js/components/ActivityTrendChart.js') }}"></script> --}}

       {{-- @if (!empty($trends['data'])) --}}
       {{-- <script src="/node_modules/chart.js/dist/chart.js"></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Charts
        initCharts();

        // Setup filter event listeners
        setupFilters();
    });

    function initCharts() {
        // Content Views Chart
        @if (!empty($contentTrends))
            new Chart(document.getElementById('contentTrendsChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($contentTrends['labels'] ?? []) !!},
                    datasets: [{
                        label: 'Content Views',
                        data: {!! json_encode($contentTrends['data'] ?? []) !!},
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        @endif

        // User Activity Chart
        @if (!empty($activityTrends))
            new Chart(document.getElementById('activityTrendsChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($activityTrends['labels'] ?? []) !!},
                    datasets: [{
                        label: 'User Activities',
                        data: {!! json_encode($activityTrends['data'] ?? []) !!},
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        @endif
    }

  function setupFilters() {
    const dataSource = document.getElementById('dataSource');
    const contentType = document.getElementById('contentType');
    const timeRange = document.getElementById('timeRange');

    [dataSource, contentType, timeRange].forEach(select => {
        select.addEventListener('change', function() {
            const params = new URLSearchParams({
                range: timeRange.value,
                type: contentType.value,
                source: dataSource.value // This must be included
            });
            
            window.location.href = '{{ route('admin.admin') }}?' + params.toString();
        });
    });
}
</script>
   {{-- @endif --}}


    {{-- @if (!empty($trends['data'])) --}}
    <script src="/node_modules/chart.js/dist/chart.js"></script>
    {{-- <script>
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Activity',
                    data: @json($data),
                    borderColor: '#3B82F6',
                    backgroundColor: '#3B82F633', // #3B82F620
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }

                    }
                }
            }
        });

    </script> --}}
{{-- @endif --}}

{{-- @endpush --}}
{{-- @stack('modals') --}}


</body>

</html>
