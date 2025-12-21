const date = new Date();

function renderCalendar() {
    const monthDays = document.querySelector(".days");

    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

    const currDay = date.getDay();
    const currDate = date.getDate();

    const monthArray = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    switch(currDay){
        case 0:
            weekStart = currDate;
            weekEnd = currDate + 6;
            break;
        
        case 1:
            weekStart = currDate - 1;
            weekEnd = currDate + 5;
            break;
            
        case 2:
            weekStart = currDate - 2;
            weekEnd = currDate + 4;
            break;
            
        case 3:
            weekStart = currDate-3;
            weekEnd = currDate + 3;
            break;
                    
        case 4:
            weekStart = currDate-4;
            weekEnd = currDate + 2;
            break;
                
        case 5:
            weekStart = currDate-5;
            weekEnd = currDate + 1;
            break;
                
        case 6:
            weekStart = currDate-6;
            weekEnd = currDate;
            break;
    }

    document.querySelector(".date h1").innerHTML = monthArray[date.getMonth()];
    document.querySelector(".date p").innerHTML = new Date().toDateString();

    let dayDiv = "";

    for (let i = weekStart; i <= weekEnd; i++) {
        if(i === new Date().getDate() && date.getMonth() === new Date().getMonth()){
            dayDiv += `<div class="today">${i}</div>`;
        } else if(i > lastDayIndex) {
            dayDiv += `<div>${i-lastDayIndex}</div>`;
        } else {
            dayDiv += `<div>${i}</div>`;
        }
    }

    monthDays.innerHTML = dayDiv;
}

renderCalendar();