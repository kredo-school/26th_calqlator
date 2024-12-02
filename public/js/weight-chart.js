fetch('/user/home/weight/chart')
    .then(response => response.json())
    .then(weightData => {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth(); 

        const startDate = new Date(year, month, 1);  
        const endDate = new Date(year, month + 1, 0); 
        
        const allDates = [];
        const showDates = [];

        for (let d = startDate; d <= endDate; d.setDate(d.getDate())) {
            allDates.push(new Date(d).toISOString().split('T')[0]);
            showDates.push(d.getDate()); 
        }

        const labels = showDates;  
 
        const weights = allDates.map(date => {
            const weightDataForDate = weightData.find(item => item.date === date);
            return weightDataForDate ? weightDataForDate.weight : null;  
        });

        const monthNames = [
            "January", "February", "March", "April", "May", "June", 
            "July", "August", "September", "October", "November", "December"
        ];

        const currentMonth = monthNames[month]; 

        const ctx = document.getElementById('weightChart').getContext('2d');
        const weightChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,  
                datasets: [{
                    label: '',
                    data: weights,  
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
                        position: 'top',
                        display: false
                    },
                    tooltip: {
                        mode: 'nearest',
                        intersect: false,
                    },
                    title: {
                        display: true,
                        text: ` ${currentMonth}` ,
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    x: {
                        type: 'category',
                        ticks: {
                        maxRotation: 0, 
                        minRotation: 0, 
                        callback: function(value) {
                            return value;  
                        }
                        },
                    },
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));