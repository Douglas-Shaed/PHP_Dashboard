<?php
    $mydir = 'Gallery/Images/Testing';
    $galImages = scandir($mydir);

    $connect = mysqli_connect('localhost', 'Drake', 'Password1234', 'taskstorage');

    if(!$connect){
        echo 'Connection Error: ' . mysqli_connect_error();
    }

    $mainResult = mysqli_query($connect, 'SELECT * FROM maintask ORDER BY taskDue');
    $subResult = mysqli_query($connect, 'SELECT * FROM subtask');

    $mainTasks = mysqli_fetch_all($mainResult, MYSQLI_ASSOC);
    $subTasks = mysqli_fetch_all($subResult, MYSQLI_ASSOC);
    
    mysqli_free_result($mainResult);
    mysqli_free_result($subResult);

    mysqli_close($connect);
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Templates/CSS/Design.css">
        <link rel="stylesheet" href="/Templates/CSS/IndexDesign.css">

        <title>Dashboard Testing</title>
    </head>
    <body>
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>

    <!-- Calendar -->
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

    <!-- List of Images -->        
        <div class = "Gallery">
            <h1 class="galTitle">Gallery</h1>
            <div class="img">
            </div>
        </div>

    <!-- List of Tasks -->
        <div class="Task">
            <?php foreach($mainTasks as $main){ ?>
                <div class = "Tasks">
                    <div class="Head">
                        <h2><?php echo htmlspecialchars($main['taskName']) ?></h2>
                        <h3><?php echo htmlspecialchars($main['taskDue']) ?> - XX Days Due</h3>
                    </div>
                    <p><?php echo htmlspecialchars($main['taskDesc']) ?></p>
                    <div class="Sub">
                        <?php foreach($subTasks as $sub){ ?>
                            <?php if($sub['subParent'] == $main['taskID']) { ?>
                                <input id="<?php echo htmlspecialchars($sub['subID']) ?>" onclick="checkClick(<?php echo htmlspecialchars($sub['subID']) ?>)" type="checkbox" name='<?php echo htmlspecialchars($sub['subID']) ?>' value='<?php echo htmlspecialchars($sub['subTask']) ?>'>
                                <label id="label<?php echo htmlspecialchars($sub['subID']) ?>" for='<?php echo htmlspecialchars($sub['subID']) ?>'><?php echo htmlspecialchars($sub['subTask']) ?></label></br>
                        <?php }} ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>
        
        

        <script>
            //Generate Gallery
            var imageArray = <?php echo json_encode($galImages) ?>;
            const imgList = document.querySelector(".img");
            
            let imgElements = "";

            for(var i = 2; i < imageArray.length; i++){
                if(imageArray[i] != 'Gallery.php') {
                    imgElements += `<div><img src="/Gallery/Images/Testing/${imageArray[i]}"></div>`;
                }
            }

            imgList.innerHTML = imgElements;
            
            function checkClick(unitID) {
                tempID = "label" + unitID;
                if( document.getElementById(unitID).checked == true) {
                    document.getElementById(tempID).classList.add('clicked');
                } else {
                    document.getElementById(tempID).classList.remove('clicked');
                }
            }
        </script>

        <script src="script.js"></script>
    </body>
</html>