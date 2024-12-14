const url = window.location.pathname;
const date = url.split('/').pop(); 
fetch(`/user/home/calories/chart/${date}`)
            .then(response => response.json())
            .then(chartData => {
                let barColor = 'rgba(75, 192, 192, 0.7)'; 
                let borderColor = 'black'; 
                let totalCalories = chartData.totalCalories;
                let goalCalories = chartData.goalCalories;
                let BMR = chartData.BMR;
        
                if (totalCalories < BMR) {
                    barColor = 'rgba(255, 218, 141, 1)';  
                    borderColor = 'rgba(255, 255, 0, 1)';
                } else if (goalCalories-500 <= totalCalories && totalCalories <= goalCalories+500) {
                    barColor = 'rgba(255, 164, 136, 1)';  
                    borderColor = 'rgba(54, 162, 235, 1)';
                } else {
                    barColor = 'rgba(255, 99, 132, 0.8)'; 
                    borderColor = 'rgba(255, 99, 132, 1)';
                }

                const ctx = document.getElementById('caloriesChart').getContext('2d'); 
                const gradientBg = ctx.createLinearGradient(0, 0, 250, 0);
                gradientBg.addColorStop(0.2,'rgba(255, 164, 136, 0.7)');
                gradientBg.addColorStop(1,'rgba(255, 50, 50, 0.9)');
                const caloriesChart = new Chart(ctx, {
                    plugins: [ChartDataLabels],
                    type: 'bar',
                    data: {
                        labels: ['totalCalories'],
                        datasets: [
                            {
                                data: [totalCalories],
                                backgroundColor: function(){
                                    if(totalCalories > goalCalories){
                                        return gradientBg;
                                    }else{
                                        return barColor;
                                    }  
                                },
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
                                borderSkipped: false,
                                datalabels: {
                                    display: true,  
                                    color: 'black',
                                    labels: {
                                        total: {
                                            align: 'top',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                    return ["         Total: " + totalCalories + "kcal","               ▼"];
                                            }, 
                                            offset: 10,
                                            color: '#D85F00',
                                        },
                                    },
                                },
                                order:3,
                            },
                            {
                                data: [[ totalCalories, goalCalories ]],
                                borderColor: '#3E5F75',
                                borderWidth: 2,
                                barPercentage: 0.5,
                                backgroundColor: function(){
                                    if(totalCalories < goalCalories){
                                        return 'rgb(193, 217, 230)';
                                    }else{
                                        return 'transparent';
                                    }
                                },
                                borderSkipped: function(){
                                    if (totalCalories === 0){
                                        return false;
                                    }else if (totalCalories < goalCalories){
                                        return 'left';
                                    }else{
                                        return 'right';
                                    }
                                },
                                borderRadius: {
                                    topLeft: function(){
                                        if(totalCalories <= 50 || totalCalories === 0){
                                            return 10;
                                        }else if (totalCalories <= 150){
                                            return 5;
                                        }else{
                                            return 0;
                                        }
                                    },
                                    bottomLeft: function(){
                                        if(totalCalories <= 50|| totalCalories === 0){
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
                                    color: '#3E5F75', 
                                    labels: {
                                        goal: {
                                            align:'bottom',
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
                                                return   ["          ▲","Goal: "+ goalCalories + "kcal"];
                                            },
                                            offset:15,
                                        },
                                    },
                                },
                                order:2
                            },
                            {
                                data: [goalCalories +1000],
                                backgroundColor: 'rgba(255, 255, 255, 0)',
                                borderColor: 'black',        
                                barPercentage: 0.5,
                                borderRadius: 10,
                                borderWidth: 2,
                                borderSkipped: false,
                                datalabels: {
                                    display: false,  
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
                                min:-(goalCalories +1000)/4,
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
