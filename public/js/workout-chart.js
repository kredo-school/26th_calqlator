fetch(`/user/home/workout/chart/${date}`)
            .then(response => response.json())
            .then(workoutData => {
                let barColor = 'rgba(75, 192, 192, 0.7)'; 
                let borderColor = 'black'; 
                let workoutCalories = workoutData.workoutCalories;
                let workoutGoal = workoutData.workoutGoal;

        
                if (workoutCalories < workoutGoal) {
                    barColor = 'rgba(255, 218, 141, 1)';  
                    borderColor = 'rgba(255, 255, 0, 1)';
                } else if (workoutCalories >= workoutGoal || workoutGoal === 0) {
                    barColor = 'rgba(255, 164, 136, 1)';  
                    borderColor = 'rgba(54, 162, 235, 1)';
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
                                barPercentage: 0.5,
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
                                            align:  'top',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                    return ["Total: " + workoutCalories + "kcal","          ▼"];
                                            },
                                            offset: 10,
                                            color: '#D85F00',
                                        },
                                            },
                                            },
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                    },
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                },
                                order:3,
                            },
                            {
                                data: [[ workoutCalories,workoutGoal ]],
                                borderColor: '#3E5F75',
                                borderWidth: 2,
                                barPercentage: 0.5,
                                backgroundColor: function(){
                                    if(workoutCalories < workoutGoal){
                                        return 'rgb(193, 217, 230)';
                                    }else{
                                        return 'transparent';
                                    }
                                },
                                borderSkipped: function(){
                                    if(workoutCalories === 0){
                                        return false;
                                    }else if (workoutCalories < workoutGoal){
                                        return 'left';
                                    }else{
                                        return 'right';
                                    }
                                },
                                borderRadius: {
                                    topLeft: function(){
                                        if(workoutCalories <= 50 || workoutGoal === 0){
                                            return 10;
                                        }else if (workoutCalories <= 150){
                                            return 5;
                                        }else{
                                            return 0;
                                        }
                                    },
                                    bottomLeft: function(){
                                        if(workoutCalories <= 50 || workoutGoal === 0){
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
                                    color: '#3E5F75', 
                                    labels: {
                                        goal: {
                                            align:'bottom',
                                            anchor: function(){
                                                if (workoutCalories < workoutGoal) {
                                                    return 'end';
                                                }else{
                                                    return 'start';
                                                }
                                            },
                                            font: {
                                                weight: 'bold',  
                                                size: 14,
                                            },
                                            formatter: function(value, context) {
                                                return   "          ▲"+"\n"+"Goal: "+ workoutGoal + "kcal";
                                                },
                                            offset:15,
                                        },
                                    },
                                },
                                order:2
                            },
                            {
                                data: [workoutGoal + 1000],
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
                                min:-(workoutGoal + 1000)/4,
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
