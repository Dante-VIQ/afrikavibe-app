<div class="row flex-grow">
    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
      <div class="card bg-primary card-rounded">
        <div class="card-body pb-0">
            <h4 class="card-title card-title-dash text-white mb-4">
                Status Summary</h4>
            <div class="row">
                <div class="col-sm-4">
                    <p class="status-summary-ight-white mb-1 whitespace-nowrap">
                        Engagement Rate</p>
                    <h2 class="text-info">{{ $stats['engagement_rate'] ?? 0 }}%</h2>
                </div>
                <div class="col-sm-8">
                    <div class="status-summary-chart-wrapper pb-4">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div
                            class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                            <div class="circle-progress-width">
                                <div id="totalVisitors"
                                    class="progressbar-js-circle pr-2">
                                </div>
                            </div>
                            <div>
                                <p class="text-small mb-2">Unique
                                    Visitors</p>
                                <h4 class="mb-0 fw-bold">{{ number_format($stats['unique_visitors'] ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div
                            class="d-flex justify-content-between align-items-center">
                            <div class="circle-progress-width">
                                <div id="visitperday"
                                    class="progressbar-js-circle pr-2">
                                </div>
                            </div>
                            <div>
                                <p class="text-small mb-2">Total Views</p>
                                <h4 class="mb-0 fw-bold">{{ number_format($stats['total_views'] ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @push('scripts') --}}

    {{-- @endpush --}}
