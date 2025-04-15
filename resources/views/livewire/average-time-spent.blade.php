<div class="chartjs-wrapper mt-4 relative">
    <select wire:model="period" id="period" class="rounded float-right text-gray-600 bg-gray-300">
        <option value="daily">Daily</option>
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
        <option value="yearly">Yearly</option>
    </select>
    <canvas id="pageViewStats"
        class="w-full h-full"></canvas>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        const ctx = document.getElementById('pageViewStats').getContext('2d');

        let chart;

        livewire.on('chartUpdated', function (chartData) {
            if(chart) chart.destroy();

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                        labels: 'Total Views',
                        data: chartData.views,
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.1)',
                    },
                    {
                        labels: 'Total Time Spent (Minutes)',
                        data: chartData.timeSpent,
                        borderColor: 'orange',
                        backgroundColor: 'rgba(255, 165, 0, 0.1)',
                    }
                ]
                },
                options: {
                    responsive: true,
                    scales:{
                        y: { beginAtZero: true },
                    }
                }
            });
        });
    });

</script>
