@php
    $filters = $filters ?? ['range' => 30, 'type' => null, 'useContentView' => true];
@endphp


<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Analytics Dashboard</h1>
        <div class="flex gap-4">
            <!-- Data Source Toggle -->
         
  <select id="dataSource" class="border rounded px-3 py-1">
                <option value="content" {{ $filters['useContentView'] ?? true ? 'selected' : '' }}>Content Views</option>
                <option value="activity" {{ !($filters['useContentView'] ?? true) ? 'selected' : '' }}>User Activities</option>
            </select>

            <select id="contentType" class="border rounded px-3 py-1">
                <option value="">All Content</option>
                <option value="blog" {{ $filters['type'] === 'blog' ? 'selected' : '' }}>Blogs</option>
                <option value="destination" {{ $filters['type'] === 'destination' ? 'selected' : '' }}>Destinations</option>
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Content Views Stats -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Total Content Views</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['content_views'] ?? 0) }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Unique Content Visitors</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['content_unique_visitors'] ?? 0) }}</p>
        </div>

        <!-- User Activity Stats -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Total Activities</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['total_activities'] ?? 0) }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Active Users</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['activity_unique_users'] ?? 0) }}</p>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Content Views Trend -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Content Views Trend</h3>
            @if (!empty($contentTrends['data']))
                <canvas id="contentTrendsChart" height="250"></canvas>
            @else
                <p class="text-gray-500">No content view data available</p>
            @endif
        </div>

        <!-- User Activity Trend -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">User Activity Trend</h3>
            @if (!empty($activityTrends['data']))
                <canvas id="activityTrendsChart" height="250"></canvas>
            @else
                <p class="text-gray-500">No activity data available</p>
            @endif
        </div>
    </div>

    <!-- Top Content and Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Top Content -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Top Content</h3>
            @if (!empty($topContent) && count($topContent) > 0)
                <div class="space-y-3">
                    @foreach ($topContent as $item)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <div>
                                <a href="{{ $item['url'] }}" class="text-blue-600 hover:underline font-medium">
                                    {{ $item['title'] }}
                                </a>
                                <span class="text-xs text-gray-500 ml-2">({{ $item['type'] }})</span>
                            </div>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ number_format($item['views']) }} views
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No content viewed in this period</p>
            @endif
        </div>

        <!-- Top Actions -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Top User Actions</h3>
            @if (!empty($topActions) && count($topActions) > 0)
                <div class="space-y-3">
                    @foreach ($topActions as $action)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <div>
                                <span class="font-medium text-gray-800">{{ $action['action'] }}</span>
                                @if ($action['description'])
                                    <p class="text-sm text-gray-600">{{ $action['description'] }}</p>
                                @endif
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ number_format($action['count']) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No user activities in this period</p>
            @endif
        </div>
    </div>

    <!-- Recent User Activity -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h3 class="text-lg font-semibold mb-4">Recent User Activity</h3>
        @if (!empty($userActivity) && count($userActivity) > 0)
            <div class="space-y-3">
                @foreach ($userActivity as $activity)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-800">{{ $activity['user'] }}</span>
                                <span class="text-sm text-gray-500">• {{ $activity['time'] }}</span>
                            </div>
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">{{ $activity['action'] }}</span>:
                                {{ $activity['description'] }}
                            </p>
                            <span class="text-xs text-gray-500">IP: {{ $activity['ip'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No recent user activity</p>
        @endif
    </div>
</div>

<!-- JavaScript for Charts and Filters -->

