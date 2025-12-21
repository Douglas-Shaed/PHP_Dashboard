<?php
    $connect = mysqli_connect('localhost', 'Drake', 'Password1234', 'taskstorage');

    if(!$connect) {
        echo 'Connection Error: ' . mysqli_connect_error();
    }

    $mainResult = mysqli_query($connect, 'SELECT * FROM maintask ORDER BY taskDue');
    $subResult = mysqli_query($connect, 'SELECT * FROM subtask');

    $maxParentQuery = mysqli_query($connect, 'SELECT taskID FROM maintask ORDER BY taskID DESC LIMIT 0, 1');

    $maxSubQuery = mysqli_query($connect, "SELECT subID FROM subtask ORDER BY subID DESC LIMIT 0, 1");

    $mainTasks = mysqli_fetch_all($mainResult, MYSQLI_ASSOC);
    $subTasks = mysqli_fetch_all($subResult, MYSQLI_ASSOC);

    $maxParent = mysqli_fetch_all($maxParentQuery, MYSQLI_ASSOC);
    $maxSub = mysqli_fetch_all($maxSubQuery, MYSQLI_ASSOC);
    
    mysqli_free_result($mainResult);
    mysqli_free_result($subResult);
    mysqli_free_result($maxParentQuery);
    mysqli_free_result($maxSubQuery);

    mysqli_close($connect);
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Task List Testing</title>
        <link rel="stylesheet" href="/Templates/CSS/TaskListDesign.css">
    </head>
    <body>
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>

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
                                <input onclick="checkClick(<?php echo htmlspecialchars($sub['subID']) ?>)" id="<?php echo htmlspecialchars($sub['subID']) ?>" type="checkbox" name='<?php echo htmlspecialchars($sub['subID']) ?>' value='<?php echo htmlspecialchars($sub['subTask']) ?>'>
                                <label id="label<?php echo htmlspecialchars($sub['subID']) ?>" for='<?php echo htmlspecialchars($sub['subID']) ?>'><?php echo htmlspecialchars($sub['subTask']) ?></label></br>
                        <?php }} ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="TaskGen">
            <form action="./insert.php" method="POST">
                <h2>Create Task</h2>
                <label for="taskTitle">Task Name: </label>
                <input name="taskTitle" type="text" value="">
                <br>

                <label for="taskDesc">Task Description :</label>
                <textarea name="taskDesc" cols="30" rows="10"></textarea>
                <br>

                <div id="subTask">
                    <label for="taskTitle1">Subtask: </label>
                    <input name="taskTitle1" type="text" value="">
                    <br>

                    <label for="taskTitle2">Subtask: </label>
                    <input name="taskTitle2" type="text" value="">
                    <br>
                </div>

                <label for="taskDate">Due Date: </label>
                <input name="taskDate" type="date">

                <input type="hidden" name="address" value="TaskList">

                <br/>

                <input type="button" onclick="addSubtask()" value="Add Subtask">
                <input type="submit" name="submit" value="Submit Task">
            </form>
        </div>

        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>

        <script>
            taskCount = 3;

            function checkClick(unitID) {
                tempID = "label" + unitID;
                if( document.getElementById(unitID).checked == true) {
                    document.getElementById(tempID).classList.add('clicked');
                } else {
                    document.getElementById(tempID).classList.remove('clicked');
                }
            }

            function addSubtask() {
                subName = "taskTitle" + taskCount;
                parentDiv = document.getElementById('subTask');

                subText = document.createElement("input");
                subText.setAttribute("type", "text");
                subText.setAttribute("name", subName);
                subText.setAttribute("value", "")

                subTitle = document.createElement("label");
                subTitle.setAttribute("for", subName);
                subTitle.innerHTML = "Subtask: ";

                parentDiv.appendChild(subTitle);
                parentDiv.appendChild(subText);

                taskCount += 1;
            }
            
        </script>
    </body>
</html>