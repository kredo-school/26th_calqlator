'use strict';


console.clear();

{
    const today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth();

    function getCalendarHead(){
        const dates = [];
        const d = new Date(year, month, 0).getDate();
        const n = new Date(year, month, 1).getDay(); 

        for(let i = 0; i < n ; i++){
            dates.unshift({
                date: d-i,
                isToday: false,
                isDisabled: true,
            });
        }

        return dates;
    }

    function getCalendarBody(){
        const dates = [];
        const lastDate = new Date(year, month+1, 0).getDate();

        for(let i=1; i<=lastDate; i++){
            dates.push({
                date:i,
                isToday: false,
                isDisabled: false,
            });
        }

        if(year === today.getFullYear() && month === today.getMonth()){ 
        dates[today.getDate()-1].isToday = true; 
        }

        return dates;
    }

    function getCalendarTail(){
        const dates = [];
        const lastDay = new Date(year, month + 1, 0).getDay();

        for (let i = 1; i < 7-lastDay; i++){
            dates.push({
                date:i,
                isToday: false,
                isDisabled: true,
            });
        }

        return dates;
    }

    function clearCalendar(){
        const tbody = document.querySelector('tbody'); 

        while(tbody.firstChild){ 
            tbody.removeChild(tbody.firstChild); 
        }
    }

    function renderTitle(){
        let prev = `${String(month).padStart(2, '0')}`;
        const title = `${String(month+1).padStart(2, '0')}`;
        let next = `${String(month+2).padStart(2, '0')}`;
        const monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
   
        if(month === 11){
            next = '01';
        }
        if(month === 0){
            prev = '12';
        }

        document.getElementById('year').textContent = year; 
        document.getElementById('monthName').textContent = monthName[month]; 
        document.getElementById('title').textContent = title; 
        document.getElementById('prev').innerHTML = `${prev} &laquo;`;
        document.getElementById('next').innerHTML = `&raquo; ${next}`;
    }

    function renderWeeks(){
        const dates = [
            ...getCalendarHead(),
            ...getCalendarBody(),
            ...getCalendarTail()
        ];

        const weeks = [];
        const weeksCount = dates.length / 7;

        for(let i = 0; i < weeksCount; i++){
            weeks.push(dates.splice(0, 7)); 
        }

        weeks.forEach(week => {
            const tr = document.createElement('tr');
            week.forEach(date => {
                const td = document.createElement('td');

                const topSection = document.createElement('p');
                const bottomSection = document.createElement('div');
    
                topSection.classList.add('top');
                bottomSection.classList.add('bottom');

                topSection.textContent = `${String(date.date).padStart(2, ' ')}`; 

                var selectedDate = year+'-'+(month+1)+'-'+date.date;  

                if (selectedDate) {
                    $.ajax({
                        url: '/user/calendar/info/' + selectedDate,  
                        type: 'GET',
                        success: function(response) {
                            if(date.isDisabled === false){
                                if (response) {
                                    const weight = response.weight;
                                    const totalCalories = response.totalCalories;
                                    const condition = response.condition;

                                    if(weight === null){
                                        bottomSection.innerHTML = `${totalCalories} kcal <br> -- kg`;
                                    }
                                    else{
                                        if(condition === null){
                                            bottomSection.innerHTML = `  <br>${totalCalories} kcal <br> ${weight.weight} kg`;
                                        }else{
                                            if(condition.condition === 1){
                                                bottomSection.innerHTML = `😀<br>${totalCalories} kcal <br> ${weight.weight} kg`;
                                            }else if(condition.condition === 2){
                                                bottomSection.innerHTML = `😏<br>${totalCalories} kcal <br> ${weight.weight} kg`;
                                            }else if(condition.condition === 3){
                                                bottomSection.innerHTML = `😐<br>${totalCalories} kcal <br> ${weight.weight} kg`;
                                            }else if(condition.condition === 4){
                                                bottomSection.innerHTML = `😷<br>${totalCalories} kcal <br> ${weight.weight} kg`;
                                            }else if(condition.condition === 5){
                                                bottomSection.innerHTML = `😴<br>${totalCalories} kcal <br> ${weight.weight} kg`;
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data: ' + error);
                            console.log('XHR response:', xhr.responseText);
                            bottomSection.innerHTML='Error fetching data.';
                        }
                    });
                };

                td.appendChild(topSection);   
                td.appendChild(bottomSection);

                td.addEventListener('click', () => {
                    window.location.href = `/user/home/${selectedDate}`; 
                });
                td.style.cursor = 'pointer';

                if(date.isToday){
                    td.classList.add('today'); 
                }

                if(date.isDisabled){
                    td.classList.add('disabled'); 
                }

                tr.appendChild(td);
            });
            document.querySelector('tbody').appendChild(tr); 
        });
    }

    function createCalendar(){
        clearCalendar();
        renderTitle();
        renderWeeks();
    }

    document.getElementById('prev').addEventListener('click', () => { 
        month--; 
        if(month < 0){ 
            year--; 
            month = 11; 
        }
        createCalendar();
    });

    document.getElementById('next').addEventListener('click', () => { 
        month++; 
        if(month > 11){ 
            year++; 
            month = 0; 
        }
        createCalendar();
    });
    
    document.getElementById('today').addEventListener('click', () => { 
        year = today.getFullYear(); 
        month = today.getMonth(); 

        createCalendar();
    });

    createCalendar();
}