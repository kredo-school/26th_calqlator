fetch(`/user/home/workout/chart/${date}`)
            .then(response => response.json())
            .then(workoutCalories => {
                let barColor = 'rgba(75, 192, 192, 0.7)'; 
                let borderColor = 'black'; 
        
                if (workoutCalories < 1000) {
                    barColor = 'rgba(255, 255, 0, 0.7)';  
                    borderColor = 'rgba(255, 255, 0, 1)';
                } else if (workoutCalories >= 1000 && workoutCalories < 2000) {
                    barColor = 'rgba(54, 162, 235, 0.7)';  
                    borderColor = 'rgba(54, 162, 235, 1)';
                } else {
                    barColor = 'rgba(255, 99, 132, 0.7)'; 
                    borderColor = 'rgba(255, 99, 132, 1)';
                }

                const ctx = document.getElementById('workoutChart').getContext('2d');
                const workoutChart = new Chart(ctx, {
                    plugins: [ChartDataLabels],
                    type: 'bar',
                    data: {
                        labels: ['workoutCalories'],
                        datasets: [
                            {
                                data: [workoutCalories],
                                backgroundColor: barColor,  
                                barPercentage: 0.6,
                                borderColor: 'transparent',
                                borderRadius: {
                                    topLeft: function(){
                                        if(workoutCalories <= 100){
                                            return 20;
                                        }else{
                                            return 10;
                                        }
                                    },
                                    bottomLeft: function(){
                                        if(workoutCalories <= 50){
                                            return 20;
                                        }else if (workoutCalories <= 100){
                                            return 20;
                                        }else{
                                            return 10;
                                        }
                                    },
                                },
                                borderWidth: 1,
                                borderSkipped: 'right',
                                datalabels: {
                                    display: true,  
                                    color: 'black',
                                    labels: {
                                        total: {
                                            align: function(value, context) {
                                                if (workoutCalories < 1200 || 2800 < workoutCalories) {
                                                    return 'top';
                                                } else {
                                                    return 'bottom';
                                                }                                                       
                                            },
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if(800 < workoutCalories){
                                                    return "Total";
                                                }else{
                                                    return " ";
                                                }
                                            },   
                                            offset: function(value, context) {
                                                if (workoutCalories < 1200 || 2800 < workoutCalories) {
                                                    return '10';
                                                } else {
                                                    return '15';
                                                }
                                            }
                                        },
                                        calories: {
                                            align: 'center',  
                                            anchor: function(){
                                                if (workoutCalories < 1600) {
                                                    return 'end';
                                                }else{
                                                    return 'center';
                                                }
                                            },
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value,context) {
                                                if (1000 < workoutCalories ) {
                                                    return value.toFixed(0) + " kcal";
                                                } else {
                                                    return "";
                                                }                    
                                            },
                                            offset: 10
                                        },
                                    },
                                },
                                order:2,
                            },
                            {
                                data: [[ workoutCalories,2000 ]],
                                borderColor: function(){
                                    if (workoutCalories < 2000) {
                                        return 'rgba(255, 99, 132, 0.7)';
                                    }else{
                                        return 'red';
                                    }
                                },
                                borderWidth: 2,
                                barPercentage: 0.6,
                                borderSkipped: false,
                                borderRadius: {
                                    topLeft: function(){
                                        if(workoutCalories <= 50){
                                            return 10;
                                        }else if (workoutCalories <= 150){
                                            return 5;
                                        }else{
                                            return 0;
                                        }
                                    },
                                    bottomLeft: function(){
                                        if(workoutCalories <= 50){
                                            return 10;
                                        }else if (workoutCalories <= 150){
                                            return 5;
                                        }else{
                                            return 0;
                                        }
                                    },
                                },
                                datalabels: {
                                    display: true,  
                                    color: 'black', 
                                    labels: {
                                        goal: {
                                            align:'top',
                                            anchor: function(){
                                                if (workoutCalories < 2000) {
                                                    return 'end';
                                                }else{
                                                    return 'start';
                                                }
                                            },
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function() {
                                                    return "Goal";
                                            },
                                            offset:10,
                                        },
                                        total: {
                                            align:'top',
                                            anchor: 'start',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if (workoutCalories <= 800) {
                                                    return "        Total";
                                                } else {
                                                    return " ";
                                                }                                        
                                            },
                                            offset:10
                                        },
                                        calories2: {
                                            align:'bottom',
                                            anchor: 'start',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if (300 < workoutCalories && workoutCalories <= 1000) {
                                                    return "      " +value[0].toFixed(0)+ "kcal";
                                                }else if (workoutCalories <= 300){
                                                    return "            " +value[0].toFixed(0)+ "kcal";
                                                }else {
                                                    return " ";
                                                }                                        
                                            },
                                            offset:10
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
                                // function(value,context) { 
                                //     if (workoutCalories > 100 || workoutCalories === 0) {
                                //         return 10;                                        
                                //     }else{
                                //         return 0;
                                //     }
                                // },
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
                        animation:{
                            duration:0,
                        },
                    },
                });
                
            })
            .catch(error => console.error('Error fetching data:', error));