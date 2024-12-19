document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('weightChart').getContext('2d');
    const chartConfig = {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Weight',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false,
                tension: 0.1,
                spanGaps: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: '',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            },
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day',
                        displayFormats: {
                            day: 'MM/d',
                            week: 'MM/d',
                            month: 'MMM yyyy'
                        }
                    },
                    ticks: {
                        maxRotation: 0,
                        minRotation: 0
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 2
                    }
                }
            }
        }
    };

    const weightChart = new Chart(ctx, chartConfig);

    function formatDate(date) {
        const options = { month: 'short', day: 'numeric' };
        return new Intl.DateTimeFormat('en-US', options).format(new Date(date));
    }

    function updateChart(days, unit) {
        const today = new Date();
        const startDate = new Date(today);
        startDate.setDate(today.getDate() - days);

        fetch('/user/weight/chart')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(weightData => {
                const allDates = [];
                const weights = [];
                const limitedData = weightData.slice(0, 200);

                for (let d = new Date(startDate); d <= today; d.setDate(d.getDate() + 1)) {
                    const dateStr = new Date(d).toISOString().split('T')[0];
                    allDates.push(dateStr);

                    const dataForDate = limitedData.find(item => item.date === dateStr);
                    weights.push(dataForDate ? dataForDate.weight : null);
                }

                weightChart.data.labels = allDates;
                weightChart.data.datasets[0].data = weights;

                const minWeight = Math.min(...weights.filter(w => w !== null));
                const maxWeight = Math.max(...weights.filter(w => w !== null));

                const scales = weightChart.options.scales;
                    scales.y.min = minWeight - 10;
                    scales.y.max = maxWeight + 10;
                    scales.x.time.unit = unit;

                const formattedStartDate = formatDate(startDate);
                const formattedEndDate = formatDate(today);

                const plugins = weightChart.options.plugins;
                    plugins.title.text = `${formattedStartDate} - ${formattedEndDate}`;

                weightChart.update();
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    document.getElementById('btn-7d').addEventListener('click', () => updateChart(7, 'day'));
    document.getElementById('btn-1m').addEventListener('click', () => updateChart(30, 'week'));
    document.getElementById('btn-3m').addEventListener('click', () => updateChart(90, 'week'));
    document.getElementById('btn-6m').addEventListener('click', () => updateChart(180, 'month'));

    updateChart(30, 'week');

});
