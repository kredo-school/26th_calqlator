fetch('/user/home/calories/chart')
            .then(response => response.json())
            .then(totalCalories => {
                let barColor = 'rgba(75, 192, 192, 0.7)'; 
                let borderColor = 'black'; 
        
                if (totalCalories < 1000) {
                    barColor = 'rgba(255, 255, 0, 0.7)';  
                    borderColor = 'rgba(255, 255, 0, 1)';
                } else if (totalCalories >= 1000 && totalCalories < 2000) {
                    barColor = 'rgba(54, 162, 235, 0.7)';  
                    borderColor = 'rgba(54, 162, 235, 1)';
                } else {
                    barColor = 'rgba(255, 99, 132, 0.7)'; 
                    borderColor = 'rgba(255, 99, 132, 1)';
                }

                const ctx = document.getElementById('caloriesChart').getContext('2d');
                const caloriesChart = new Chart(ctx, {
                    plugins: [ChartDataLabels],
                    type: 'bar',
                    data: {
                        labels: ['totalCalories'],
                        datasets: [
                            {
                                data: [totalCalories],
                                backgroundColor: barColor,  
                                barPercentage: 0.6,
                                borderRadius: 10,
                                borderWidth: 2,
                                borderSkipped: 'right',
                                datalabels: {
                                    display: true,  
                                    color: 'black',
                                    labels: {
                                        total: {
                                            align:'top',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                const totalCalories = context.dataset.data[context.dataIndex];
                                                if ((1000 < totalCalories && totalCalories < 1500) || totalCalories > 2500) {
                                                    return "Total";
                                                } else {
                                                    return " ";
                                                }                                                       
                                            },
                                            offset:10
                                        },
                                        calories: {
                                            align: 'center',  
                                            anchor: 'center',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value,context) {
                                                const totalCalories = context.dataset.data[context.dataIndex];
                                                if ((1000 < totalCalories && totalCalories < 1500) || totalCalories > 2500) {
                                                    return value.toFixed(0) + " kcal";
                                                } else if (1500 <= totalCalories && totalCalories <= 2500) {
                                                    return "Total: " + value.toFixed(0) + " kcal";
                                                } else {
                                                    return "";
                                                }                                           
                                            },
                                            offset: 10
                                        },
                                    }
                                },
                                order:2,
                            },
                            {
                                data:function(context){
                                    if (totalCalories < 2000){
                                        return [[ totalCalories,2000 ]];
                                    } else {
                                        return [[ 2000,totalCalories ]];
                                    }
                                },
                                borderColor: 'rgba(255, 99, 132, 0.7)',
                                borderWidth: 2,
                                barPercentage: 0.6,
                                borderSkipped: function(value,context) {
                                    if (totalCalories === 0) {
                                        return 'right';
                                    } else {
                                        return false;
                                    }                   
                                },
                                borderRadius:function(value,context) {
                                    if (totalCalories === 0) {
                                        return 20;
                                    } else {
                                        return 0;
                                    }                                                
                                },
                                datalabels: {
                                    display: true,  
                                    color: 'black', 
                                    labels: {
                                        title: {
                                            align:'top',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value,context) {
                                                return "Goal";
                                            },
                                            offset:10,
                                        },
                                        calories: {
                                            align: 'top',  
                                            anchor: 'start', 
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value,context) {
                                                if (context.dataset.data[context.dataIndex][0] === 0) {
                                                    return "Total: 0kcal";
                                                } else {
                                                    return "";
                                                }
                                            },
                                            offset: 10,
                                        },
                                        total: {
                                            align:'top',
                                            anchor: 'start',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if (context.dataset.data[context.dataIndex][0] <= 1000) {
                                                    return "Total";
                                                } else {
                                                    return " ";
                                                }                                        
                                            },
                                            offset:15
                                        },
                                        calories2: {
                                            align:'bottom',
                                            anchor: 'start',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if (context.dataset.data[context.dataIndex][0] <= 1000) {
                                                    return "      " +value[0].toFixed(0)+ "kcal";
                                                } else {
                                                    return " ";
                                                }                                        
                                            },
                                            offset:15
                                        },
                                    },
                                },
                                order:2
                            },
                            {
                                data: [3000],
                                backgroundColor: 'rgba(255, 255, 255, 0)',
                                borderColor: 'black',        
                                barPercentage: 0.6,
                                borderRadius: 10,
                                borderWidth: 2,
                                borderSkipped: false,
                                datalabels: {
                                    display: false
                                },
                                order:1
                            },
                        ],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                display: false,
                                min:-50,
                            },
                            y: {
                                stacked: true,
                                display: false,
                            },
                            
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                        },
                        layout: {
                            padding: {
                                right: 50,
                            }
                        },
                    },
                });
                
            })
            .catch(error => console.error('Error fetching data:', error));
