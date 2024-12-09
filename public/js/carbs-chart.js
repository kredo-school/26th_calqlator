fetch(`/user/home/carbs/chart/${date}`)
    .then(response => response.json())
    .then(carbsData => {
        let barColor = 'rgba(75, 192, 192, 0.7)'; 
        let borderColor = 'black'; 
        let totalCarbs = carbsData.totalCarbs;
        let carbsMin = carbsData.carbsMinMax[0];
        let carbsMax = carbsData.carbsMinMax[1];

        if (totalCarbs < carbsMin) {
            barColor = 'rgba(255, 218, 141, 1)';  
            borderColor = 'rgba(255, 255, 0, 1)';
        } else if (carbsMin <= totalCarbs && totalCarbs <= carbsMax) {
            barColor = 'rgba(255, 164, 136, 0.6)';  
            borderColor = 'rgba(54, 162, 235, 1)';
        } else {
            barColor = 'rgba(255, 99, 132, 0.8)'; 
            borderColor = 'rgba(255, 99, 132, 1)';
        }

        const ctx = document.getElementById('carbsChart').getContext('2d'); 
        const gradientBg = ctx.createLinearGradient(0, 0, 250, 0);
        gradientBg.addColorStop(0.2,'rgba(255, 164, 136, 0.6)');
        gradientBg.addColorStop(1,'rgba(255, 50, 50, 0.8)');
        const carbsChart = new Chart(ctx, {
            plugins: [ChartDataLabels],
            type: 'bar',
            data: {
                labels: ['totalCarbs'],
                datasets: [
                    {
                        data: [totalCarbs],
                        backgroundColor: function(){
                            if(totalCarbs > carbsMax){
                                return gradientBg;
                            }else{
                                return barColor;
                            }  
                        },
                        barPercentage: 0.5,
                        borderColor: 'transparent',
                        borderRadius: {
                            topLeft: function(){
                                if(totalCarbs <= 10){
                                    return 20;
                                }else{
                                    return 10;
                                }
                            },
                            bottomLeft: function(){
                                if(totalCarbs <= 5){
                                    return 20;
                                }else if (totalCarbs <= 10){
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
                                            return ["         Total: " + totalCarbs + "g","            ▼"];
                                    }, 
                                    offset: 10,
                                    color: '#D85F00',
                                },
                            },
                        },
                        order:2,
                    },
                    {
                        data: [[ carbsMin, carbsMax ]],
                        borderColor: '#3E5F75',
                        borderWidth: 2,
                        barPercentage: 0.5,
                        backgroundColor: 'rgb(193, 217, 230,0.5)',
                        borderSkipped: false,
                        borderRadius: 0,
                        datalabels: {
                            display: true,  
                            color: '#3E5F75', 
                            labels: {
                                Min: {
                                    align:'bottom',
                                    anchor: 'start',
                                    font: {
                                        weight: 'bold',  
                                        size: 14  
                                    },
                                    formatter: function(value, context) {
                                        return   "▲";
                                    },
                                    offset:10,
                                },
                                Max: {
                                    align:'bottom',
                                    anchor: 'end',
                                    font: {
                                        weight: 'bold',  
                                        size: 14  
                                    },
                                    formatter: function(value, context) {
                                        return   "▲";
                                    },
                                    offset:10,
                                },
                                Grams: {
                                    align:'bottom',
                                    anchor: 'center',
                                    font: {
                                        weight: 'bold',  
                                        size: 14  
                                    },
                                    formatter: function(value, context) {
                                        return   ["Min ~ Max",carbsMin + "g" + "~" + carbsMax + "g"];
                                    },
                                    offset:23,
                                },
                            },
                        },
                        order:3
                    },
                    {
                        data: [1000],
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
                        min:-100,
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
