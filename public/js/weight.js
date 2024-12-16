// document.addEventListener('DOMContentLoaded', function() {
    // fetch('/user/weight/chart')
    //     .then(response => {
    //         console.log("Response:", response);
    //         return response.json();
    //     })
    //     .then(weightData => {
    //         const limitedData = weightData.slice(0, 180);

    //         displayChart(limitedData);

    //             function displayChart(data) {
    //                 const today = new Date();
    //                 const year = today.getFullYear();
    //                 const month = today.getMonth();

    //                 const startDate = new Date(year, month -1, 1);
    //                 const endDate = today;

    //                 const allDates = [];
    //                 const showDates = [];

    //                 for (let d = startDate; d <= endDate; d.setDate(d.getDate() +1)) {
    //                     allDates.push(new Date(d).toISOString().split('T')[0]);
    //                     showDates.push(d.getDate());
    //                 }

    //                 const labels = showDates;

    //                 const weights = allDates.map(date => {
    //                     const weightDataForDate = data.find(item => item.date === date);
    //                     return weightDataForDate ? weightDataForDate.weight : null;
    //                 });

    //                 const minWeight = Math.min(...weights.filter(w => w !== null));
    //                 const maxWeight = Math.max(...weights.filter(w => w !== null));

    //                 const monthNames = [
    //                     "January", "February", "March", "April", "May", "June",
    //                     "July", "August", "September", "October", "November", "December"
    //                 ];

    //                 const currentMonth = monthNames[month];

//                     const ctx = document.getElementById('weightChart').getContext('2d');
//                     const weightChart = new Chart(ctx, {
//                         type: 'line',
//                         data: {
//                             labels: labels,
//                             datasets: [{
//                                 label: '',
//                                 data: weights,
//                                 borderColor: 'rgba(75, 192, 192, 1)',
//                                 backgroundColor: 'rgba(75, 192, 192, 0.2)',
//                                 fill: false,
//                                 tension: 0.1,
//                                 spanGaps: true
//                             }]
//                         },
//                         options: {
//                             responsive: true,
//                             plugins: {
//                                 legend: {
//                                     position: 'top',
//                                     display: false
//                                 },
//                                 tooltip: {
//                                     mode: 'nearest',
//                                     intersect: false,
//                                 },
//                                 title: {
//                                     display: true,
//                                     text: ` ${currentMonth}` ,
//                                     font: {
//                                         size: 16,
//                                         weight: 'bold'
//                                     }
//                                 }
//                             },
//                             scales: {
//                                 x: {
//                                     type: 'category',
//                                     ticks: {
//                                     maxRotation: 0,
//                                     minRotation: 0,
//                                     callback: function(value) {
//                                         return value;
//                                     }
//                                     },
//                                 },
//                                 y: {
//                                     beginAtZero: true,
//                                     min: minWeight - 10,
//                                     max: maxWeight + 10,
//                                 }
//                             }
//                         }
//                     });
//             }
//         })
//         .catch(error => console.error('Error fetching data:', error));
// });

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

                        weightChart.options.scales.y.min = minWeight - 10;
                        weightChart.options.scales.y.max = maxWeight + 10;

                        weightChart.options.scales.x.time.unit = unit;

                        const formattedStartDate = formatDate(startDate);
                        const formattedEndDate = formatDate(today);

                        weightChart.options.plugins.title.text = `${formattedStartDate} - ${formattedEndDate}`;

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
