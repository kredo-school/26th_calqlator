fetch(`/user/home/workout/chart/${date}`)
            .then(response => response.json())
            .then(workoutData => {
                let barColor = 'rgba(54, 162, 235, 0.7)'; 
                let borderColor = 'black'; 
                let workoutCalories = workoutData.workoutCalories;
                let workoutGoal = workoutData.workoutGoal;

        
                if (workoutCalories < workoutGoal) {
                    barColor = 'rgba(255, 255, 0, 0.7)';  
                    borderColor = 'rgba(255, 255, 0, 1)';
                } else if (workoutCalories >= workoutGoal || workoutGoal === 0) {
                    barColor = 'rgba(54, 162, 235, 0.7)';  
                    borderColor = 'rgba(54, 162, 235, 1)';
                } 
console.log(workoutCalories);
console.log(workoutGoal);
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
                                            align:  'bottom',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if(workoutCalories === 0){
                                                    return " ";
                                                }else if (workoutCalories - workoutGoal < 800){
                                                    return "    ▲\n" + "   Total";
                                                }else{
                                                    return " ";
                                                }
                                            },  
                                            offset: 20, 
                                        },
                                        total2: {
                                            align:  'top',
                                            anchor: 'end',
                                            font: {
                                                weight: 'bold',  
                                                size: 14  
                                            },
                                            formatter: function(value, context) {
                                                if(workoutGoal === 0 || workoutCalories - workoutGoal > 800){
                                                    return "     Total\n" + "      ▼";
                                                }else{
                                                    return "";
                                                }
                                            },  
                                            offset: 20, 
                                        },
                                        calories: {
                                            align: 'center',  
                                            anchor: function(){
                                                if (workoutCalories < 1000) {
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
                                                if (1200 < workoutCalories ) {
                                                    return workoutCalories + " kcal";
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
                                data: [[ workoutCalories,workoutGoal ]],
                                borderColor: function(){
                                    if (workoutGoal === 0) {
                                        return 'transparent';
                                    }else if (workoutCalories < workoutGoal){
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
                                                if (workoutCalories < workoutGoal) {
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
                                                if(workoutGoal === 0){
                                                    return "";
                                                }else{
                                                    return "   Goal: \n"+ workoutGoal + "kcal";
                                                }
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
                                                if (workoutCalories === 0) {
                                                    return "      Total\n" + "      ▼";
                                                }else{
                                                    return "";
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
                                                if (400 < workoutCalories && workoutCalories <= 1200) {
                                                    return "      " +value[0].toFixed(0)+ "kcal";
                                                }else if (workoutCalories <= 400){
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
                                data: [workoutGoal + 1500],
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
