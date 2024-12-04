const url = window.location.pathname;
const date = url.split('/').pop(); 
fetch(`/user/home/calories/chart/${date}`)
            .then(response => response.json())
            .then(chartData => {
                let barColor = 'rgba(75, 192, 192, 0.7)'; 
                let borderColor = 'black'; 
                let totalCalories = chartData.totalCalories;
                let goalCalories = chartData.goalCalories;
        
                if (totalCalories < 1000) {
                    barColor = 'rgba(255, 255, 0, 0.7)';  
                    borderColor = 'rgba(255, 255, 0, 1)';
                } else if (totalCalories >= 1000 && totalCalories <= 2000) {
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
                                barPercentage: 0.5,
                                borderColor: 'transparent',
                                borderRadius: {
                                    topLeft: function(){
                                        if(totalCalories <= 100){
                                            return 20;
                                        }else{
                                            return 10;
                                        }
                                    },
                                    bottomLeft: function(){
                                        if(totalCalories <= 50){
                                            return 20;
                                        }else if (totalCalories <= 100){
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
                                            align: 'bottom',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if(800 < totalCalories){
                                                    return "  ▲\n" + "Total";
                                                }else{
                                                    return "";
                                                }
                                            }, 
                                            offset: 20,
                                        },
                                        calories: {
                                            align: 'center',  
                                            anchor: function(){
                                                if (totalCalories < 1000) {
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
                                                if (1200 <= totalCalories ) {
                                                    return totalCalories + " kcal";
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
                                data: [[ totalCalories, goalCalories ]],
                                borderColor: function(){
                                    if (totalCalories < goalCalories) {
                                        return 'rgba(255, 99, 132, 0.7)';
                                    }else{
                                        return 'red';
                                    }
                                },
                                borderWidth: 2,
                                barPercentage: 0.5,
                                borderSkipped: false,
                                borderRadius: {
                                    topLeft: function(){
                                        if(totalCalories <= 50){
                                            return 10;
                                        }else if (totalCalories <= 150){
                                            return 5;
                                        }else{
                                            return 0;
                                        }
                                    },
                                    bottomLeft: function(){
                                        if(totalCalories <= 50){
                                            return 10;
                                        }else if (totalCalories <= 150){
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
                                                if (totalCalories < goalCalories) {
                                                    return 'end';
                                                }else{
                                                    return 'start';
                                                }
                                            },
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                    return "   Goal: \n"+ goalCalories + "kcal";
                                            },
                                            offset:20,
                                        },
                                        total: {
                                            align:'top',
                                            anchor: 'start',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if (totalCalories <= 800) {
                                                    return "      Total\n"+"      ▼";
                                                } else {
                                                    return " ";
                                                }                                        
                                            },
                                            offset:15
                                        },
                                        calories2: {
                                            align:'center',
                                            anchor: 'start',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if (400 < totalCalories && totalCalories <= 1200) {
                                                    return "      " +value[0].toFixed(0)+ "kcal";
                                                }else if (totalCalories <= 400){
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
                                data: [goalCalories + 1500],
                                backgroundColor: 'rgba(255, 255, 255, 0)',
                                borderColor: 'black',        
                                barPercentage: 0.5,
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
                        animation:{
                            duration:0,
                        },
                    },
                });
            })
            .catch(error => console.error('Error fetching data:', error));
