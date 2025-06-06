@php
    $filters = $filters ?? ['range' => 30, 'type' => null];
@endphp
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Content Analytics</h1>
            <div class="flex gap-4">
                <select id="contentType" class="border rounded px-3 py-1">
                    <option value="">All Content</option>
                    <option value="blog" {{ $filters['type'] === 'blog' ? 'selected' : '' }}>Blogs</option>
                    <option value="destination" {{ $filters['type'] === 'destination' ? 'selected' : '' }}>Destinations
                    </option>
                    <option value="culture" {{ $filters['type'] === 'culture' ? 'selected' : '' }}>Cultures</option>
                </select>
                <select id="timeRange" class="border rounded px-3 py-1">
                    <option value="7" {{ $filters['range'] == 7 ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="30" {{ $filters['range'] == 30 ? 'selected' : '' }}>Last 30 Days</option>
                    <option value="90" {{ $filters['range'] == 90 ? 'selected' : '' }}>Last 90 Days</option>
                </select>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Total Views</h3>
                <p class="text-3xl font-bold">{{ number_format($stats['total_views'] ?? 0) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Unique Visitors</h3>
                <p class="text-3xl font-bold">{{ number_format($stats['unique_visitors'] ?? 0) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Avg. Time Spent</h3>
                <p class="text-3xl font-bold">{{ isset($stats['avg_time']) ? gmdate('i:s', $stats['avg_time']) : '0:00' }}
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Engagement Rate</h3>
                <p class="text-3xl font-bold">{{ $stats['engagement_rate'] ?? 0 }}%</p>
            </div>
        </div>

        <!-- Trends Graph -->
        <div class="bg-white p-6 rounded-lg shadow">
            @if (!empty($trends['data']))
                <canvas id="trendsChart" height="300"></canvas>
            @else
                <p class="text-gray-500">No data available</p>
            @endif
        </div>
        {{-- top content --}}
        <div class="bg-white p-6 rounded-lg shadow">
            @if (!empty($topContent))
                <div class="space-y-4">
                    @foreach ($topContent as $item)
                    <div class="flex justify-between items-center">
                        <a href="{{ $item['url'] }}" class="text-blue-600 hover:underline">{{ $item['title'] }}</a>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">{{ number_format($item['views']) }}</span>
                    </div>
                    @endforeach

                </div>
            @else
                <p class="text-gray-500">No content viewed in this period</p>
            @endif
        </div>
    </div>

    @push('scripts')
        @if (!empty($trends['data']))
            <script src="/node_modules/chart.js/dist/chart.js"></script>
            <script>
                const ctx = document.getElementById('trendsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($trends['labels'] ?? []),
                        datasets: [{
                            label: 'Views',
                            data: @json($trends['data'] ?? []),
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

                // Filter controls
                document.getElementById('contentType').addEventListener('change', updateFilters);
                document.getElementById('timeRange').addEventListener('change', updateFilters);

                function updateFilters() {
                    const params = new URLSearchParams({
                        type: document.getElementById('contentType').value,
                        range: document.getElementById('timeRange').value
                    });
                    window.location.href = `${window.location.pathname}?${params.toString()}`;
                }
            </script>
        @endif
    @endpush
@endsection
