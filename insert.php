<?php
    $connectDB = mysqli_connect('localhost', 'Drake', 'Password1234', 'concepts');
    $connectTS = mysqli_connect('localhost', 'Drake', 'Password1234', 'taskstorage');


    if(isset($_POST['submit'])){
        //Database Management
        
        if (!empty($_POST['database'])) {
            $database = $_POST['database'];
        } else {
            $database = 'boop';
        }

        if ($database == 'races') {
            $raceName = $_POST['raceName'];
            $raceDesc = $_POST['raceDesc'];
            $sql = "INSERT INTO races(raceID, raceName, raceDesc) SELECT max(raceID)+1, '$raceName', '$raceDesc' FROM races";
            $inputTest = "SELECT raceName FROM races WHERE raceName = '$raceName'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'class') {
            $className = $_POST['className'];
            $classType = $_POST['classType'];
            $sql = "INSERT INTO class(classID, className, classType) SELECT max(classID)+1, '$className', '$classType' FROM class";
            $inputTest = "SELECT className FROM class WHERE className = '$className'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'attributes') {
            $attrName = $_POST['attrName'];
            $attrClass = $_POST['attrClass'];
            $sql = "INSERT INTO attributes(attrID, attrName, attrClass) SELECT max(attrID)+1, '$attrName', '$attrClass' FROM attributes";
            $inputTest = "SELECT attrName FROM attributes WHERE attrName = '$attrName'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'familiars') {
            $famName = $_POST['famName'];
            $sql = "INSERT INTO familiars(famID, famName) SELECT max(famID)+1, '$famName' FROM familiars";
            $inputTest = "SELECT famName FROM familiars WHERE famName = '$famName'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'modweapon') {
            $weaponName = $_POST['weaponName'];
            $weaponParts = $_POST['weaponParts'];
            $partOne = $_POST['partOne'];
            $partTwo = $_POST['partTwo'];
            $partThree = $_POST('partThree');
            $partFour = $_POST['partFour'];
            $sql = "INSERT INTO modweapon(modID, weaponName, weaponParts, partOne, partTwo, partThr, partFour) SELECT max(modID)+1, '$weaponName', '$weaponParts', '$partOne', '$partTwo', '$partThree', '$partFour' FROM modweapon";
            $inputTest = "SELECT weaponName FROM modweapon WHERE weaponName = '$weaponName'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'poketypes') {
            $pokeType = $_POST['pokeType'];
            $sql = "INSERT INTO poketypes(pokeID, pokeType) SELECT max(pokeID)+1, '$pokeType' FROM poketypes";
            $inputTest = "SELECT pokeType FROM poketypes WHERE pokeType = '$pokeType'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'clan') {
            $clanName = $_POST['clanName'];
            $clanClass = $_POST['clanClass'];
            $sql = "INSERT INTO clan(clanID, clanName, clanClass) SELECT max(clanID)+1, '$clanName', '$clanClass' FROM clan";
            $inputTest = "SELECT clanName FROM clan WHERE clanName = '$clanName'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'evolution') {
            $evolName = $_POST['evolName'];
            $evolType = $_POST['evolType'];
            $sql = "INSERT INTO evolution(evolID, evolName, evolType) SELECT max(evolID)+1, '$evolName', '$evolType' FROM evolution";
            $inputTest = "SELECT evolName FROM evolutions WHERE evolName = '$evolName'";

            insertAll($connectDB, $inputTest, $sql);

        } else if ($database == 'boop') {
            //Task List Management
            $taskTitle = $_POST['taskTitle'];
            $taskDesc = $_POST['taskDesc'];
            $taskDate = $_POST['taskDate'];

            $insertMain = "INSERT INTO maintask (taskID, taskName, taskDesc, taskDue) SELECT max(taskID)+1, '$taskTitle', '$taskDesc', '$taskDate' FROM maintask";
            
            mysqli_query($connectTS, $insertMain);

            for ($subCount = 1; !empty($_POST['taskTitle'.$subCount]); ++$subCount) {
                $subTitle = $_POST['taskTitle'.$subCount];
                $insertSub = "INSERT INTO subtask (subID, subTask, subParent) SELECT max(subID)+1, '$subTitle', (SELECT taskID FROM maintask WHERE taskName = '$taskTitle') FROM subtask;";
                mysqli_query($connectTS, $insertSub);
            }
        } else {
            echo "<script>console.log('ERROR')</script>";
            printAll();
        }

        

        
    }

    function insertAll($connection, $test, $input) {
        if (empty(mysqli_query($connection, $test))) {
            echo "Already Exists";
            printAll();
        } else {
            mysqli_query($connection, $input);
        }
    }

    function printAll() {
        foreach ($_POST as $key => $value) {
            echo '   ' . $key . ': ' . $value. '   ';
        }
    }

    mysqli_close($connectDB);
    mysqli_close($connectTS);

    if ($_POST['address'] == 'Database') {
        header("Location: Concept_Randomizer/Database.php");
    } else {
        header("Location: TaskList.php");
    }

?>