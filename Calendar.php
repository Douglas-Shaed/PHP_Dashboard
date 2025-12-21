<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Templates/CSS/Calendar.css">
        <title>Calendar</title>
    </head>
    <body>
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>
        <div class="Calendar">
            <div class="month">
                <div class="date">
                    <h1></h1>
                    <p></p>
                </div>
            </div>
            <div class="week">
                <div>Sunday</div>
                <div>Monday</div>
                <div>Tuesday</div>
                <div>Wednesday</div>
                <div>Thursday</div>
                <div>Friday</div>
                <div>Saturday</div>
            </div>
            <div class="days">
            </div>
        </div>
        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>
        <script>
            const renderCalendar = () => {
                var textVar = "";
                var toDay = "";
                const date = new Date();
                const months = [
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
                    "December",
                ];

                //number suffix
                if (date.getDate() === 1 || date.getDate() === 21 || date.getDate() === 31) {
                    textVar = "st";
                } else if (date.getDate() === 2 || date.getDate() === 22) {
                    textVar = "nd";
                } else if (date.getDate() === 3 || date.getDate() === 23) {
                    textVar = "rd";
                } else {
                    textVar = "th";
                }

                //determine day
                switch(date.getDay()) {
                    case 0: toDay = "Sunday"; break;
                    case 1: toDay = "Monday"; break;
                    case 2: toDay = "Tuesday"; break;
                    case 3: toDay = "Wednesday"; break;
                    case 4: toDay = "Thursday"; break;
                    case 5: toDay = "Friday"; break;
                    case 6: toDay = "Saturday"; break;
                    default: today = "ERROR Day is Lost";
                }

                //set display date
                document.querySelector(".date h1").innerHTML = toDay;
                document.querySelector(".date p").innerHTML = months[date.getMonth()] + " " + date.getDate() + textVar;
            }

            renderCalendar()
        </script>
    </body>
</html>