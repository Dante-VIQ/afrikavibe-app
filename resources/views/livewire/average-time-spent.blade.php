<div>
@section('content')
<div class="chartjs-wrapper mt-4 relative">
    <select id="timeRange" class="rounded text-gray-600 bg-gray-300">
        <option value="1">Daily</option>
        <option value="7">Weekly</option>
        <option value="30">Monthly</option>
        <option value="90">Yearly</option>
    </select>
    <select id="contentType" class="rounded text-gray-600 bg-gray-300 px-3 py-1">
        <option value="">All Content Types</option>
        <option value="App\Models\Blog">Blogs</option>
        <option value="App\Models\Doctor">Destinations</option>
        <option value="App\Models\Culture">Cultures</option>
    </select>

    <div class="chart-container" style="height: 400px; width: 100%">
        
        <activity-trend-chart
            ref="trendChart"
            :days="selectedDays"
            :content-type="selectedType">

    </activity-trend-chart>
    </div>
</div>
@endsection

@push('scripts')
<script>
    new Vue({
        el: '#app',
        data: {
            selectedDays: 30,
            selectedType: null
        },
        mounted() {
            document.getElementById('timeRange').addEventListener('change', (e) => {
                this.selectedDays = e.target.value;
            });

            document.getElementById('contentType').addEventListener('change', (e) => {
                this.selectedType = e.target.value || null;
            });
        }
    });
    </script>
@endpush

</div>
