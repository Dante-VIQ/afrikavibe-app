import { Line } from 'vue-chartjs';
import { Chart  as ChartJS, Title,Tooltip,Legend, LineElement, LinearScale, PointElement, CategoryScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale )

export default {
    extends: Line,
    props: {
        days: { type: Number, default: 30 },
        contentType: {type: String, default: null }
    },
    data() {
        return {
            chartData: {
                labels: [],
                datasets: []
            },
            options:{
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
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
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }
            }
        }
    },

    async mounted() {
        await this.fetchData()
    },
    methods: {
        async fetchData() {
            try {
                const params = new URLSearchParams()
                params.append('days', this.days)
                if (this.contentType) params.append('type', this.contentType)

                    const response = await axios.get('/api/analytics/activity-trends?${params}')
                    this.chartData = {
                        labels: response.data.labels,
                        datasets: response.data.datasets
                    }
                    this.renderChart(this.chartData, this.options)
            } catch (error) {
                console.error('Error loading chart data:', error)
            }
        }
    },

    watch: {
        days() {
            this.fetchData()
        },
        contentType() {
            this.fetchData()
        }
    }
}
