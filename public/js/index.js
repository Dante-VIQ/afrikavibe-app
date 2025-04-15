document.addEventListener('livewire:load', function () {
        const ctx = document.getElementById('averageTimeChart').getContext('2d');

        let chart;

        livewire.on('chartUpdated', function (chartData) {
            if(chart) chart.destroy();

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                        labels: 'Average Time Spent (Minutes)',
                        data: chartData.averageTimeSpent,
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.1)',
                    },
                    {
                        labels: 'Percent Change',
                        data: chartData.percentChange,
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
