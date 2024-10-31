<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>

document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('weightGraph').getContext('2d');

    var maxWeight = Math.max( ...priceData) + 5;
    var minWeight = Math.min( ...priceData) - 5;

    var weightGraph = new Chart(ctx, {
        type: 'line',
        data: {
            labels: nameData,
            datasets: [{
                label: 'Weight',
                data: priceData,
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
                },
                y: {
                    min: minWeight,
                    max: maxWeight,
                    ticks: {
                        stepSize: 0.1,
                        callback: function(value) {
                            return value + 'kg';
                        }
                    },
                    grid: {
                        drawTicks: true,
                        color: "rgba(0, 0, 0, 0.1)"
                    }
                }
            }
        }
    });

    function updateChart(period) {
        let data;
        switch(period) {
            case '1w':
                data = getDataForPeriod(7);
                break;
            case '1m':
                data = getDataForPeriod(30);
                break;
            case '3m':
                data = getDataForPeriod(90);
                break;
            case '6m':
                data = getDataForPeriod(180);
                break;
        }

        weightGraph.data.labels = data.labels;
        weightGraph.data.datasets[0].data = data.values;
        weightGraph.update();

        updateButtonColors(period);
    }

    function getDataForPeriod(days) {
        let labels = [];
        let values = [];
        return { labels, values };
    }


    function updateButtonColors(activePeriod) {
        let buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            if (button.getAttribute('onclick').includes(activePeriod)) {
                button.classList.add('active-button');
            } else {
                button.classList.remove('active-button');
            }
        });
    }

    window.updateChart = updateChart;
});
