fetch('/user/weight/chart')
    .then(response => response.json())
    .then(chartData => {
        const labels = chartData.map(item => item.date); 
        const weights = chartData.map(item => item.weight);  

        console.log(labels);
        console.log(weights);

        const ctx = document.getElementById('weightChart').getContext('2d');
        const weightChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,  // x-axis: dates
                datasets: [{
                    label: 'Weight',
                    data: weights,  // y-axis: weight values
                    borderColor: 'rgba(75, 192, 192, 1)',  // Line color
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Background color
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'nearest',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        type: 'category',
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Weight (kg)'
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));