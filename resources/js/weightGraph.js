document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('weightGraph').getContext('2d');
    var weightGraph = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Weight',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    }
                }
            }
        }
    });

    function updateGraph(period) {

    }

    window.updateChart = updateChart;
});
