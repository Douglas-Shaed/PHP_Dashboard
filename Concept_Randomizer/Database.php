<?php
    $connect = mysqli_connect('localhost', 'Drake', 'Password1234', 'concepts');

    if(!$connect){
        echo 'Connection Error: ' . mysqli_connect_error();
    }

    $Race = mysqli_query($connect, 'SELECT raceName FROM races ORDER BY raceName ASC');
    $Class = mysqli_query($connect, 'SELECT className FROM class ORDER BY className ASC');
    $Attr = mysqli_query($connect, 'SELECT attrName FROM attributes');
    $Animal = mysqli_query($connect, 'SELECT famName FROM familiars ORDER BY famName ASC');
    $Weapon = mysqli_query($connect, 'SELECT weaponName FROM modweapon ORDER BY weaponName ASC');
    $Poke = mysqli_query($connect, 'SELECT pokeType FROM poketypes');
    $Clan = mysqli_query($connect, 'SELECT clanClass FROM clan');
    $Evol = mysqli_query($connect, 'SELECT evolName FROM evolution');

    $dataRace = mysqli_fetch_all($Race, MYSQLI_ASSOC);
    $dataClass = mysqli_fetch_all($Class, MYSQLI_ASSOC);
    $dataAttr = mysqli_fetch_all($Attr, MYSQLI_ASSOC);
    $dataAnimal = mysqli_fetch_all($Animal, MYSQLI_ASSOC);
    $dataWeapon = mysqli_fetch_all($Weapon, MYSQLI_ASSOC);
    $dataPoke = mysqli_fetch_all($Poke, MYSQLI_ASSOC);
    $dataClan = mysqli_fetch_all($Clan, MYSQLI_ASSOC);
    $dataEvol = mysqli_fetch_all($Evol, MYSQLI_ASSOC);

    mysqli_free_result($Race);
    mysqli_free_result($Class);
    mysqli_free_result($Attr);
    mysqli_free_result($Animal);
    mysqli_free_result($Weapon);
    mysqli_free_result($Poke);
    mysqli_free_result($Clan);
    mysqli_free_result($Evol);

    mysqli_close($connect);
?>

<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="/Templates/CSS/DatabaseDesign.css">
        <title>Database Mod</title>
    </head>
    <body>
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>

        <div class="Container">
            <h2>Races</h2>
            <div class="Data" id="Race"></div>
        </div>

        <div class="Container">
            <h2>Classes</h2>
            <div class="Data" id="Class"></div>
        </div>

        <div class="Container">
            <h2>Attributes</h2>
            <div class="Data" id="Attr"></div>
        </div>

        <div class="Container">
            <h2>Familiars</h2>
            <div class="Data" id="Familiar"></div>
        </div>

        <div class="Container">
            <h2>Weapons</h2>
            <div class="Data" id="Weapon"></div>
        </div>

        <div class="Container">
            <h2>Clans</h2>
            <div class="Data" id="Clan"></div>
        </div>

        <div class="Container">
            <h2>Evolutions</h2>
            <div class="Data" id="Evol"></div>
        </div>

        <div class="Container">
            <h2>Pokemon Types</h2>
            <div class="Data" id="Types"></div>
        </div>

        <div class="Container">
            <h2>Modify Database</h2>
            <form action="../insert.php" method="POST">

                <label for="database">Database: </label>
                <select id="database" name="database" onchange="displayForm()">
                    <option value="default">--SELECT DATABASE--</option>
                    <option value="races">Races</option>
                    <option value="class">Classes</option>
                    <option value="attributes">Attributes</option>
                    <option value="familiars">Familiars</option>
                    <option value="modweapon">Weapons</option>
                    <option value="poketypes">Pokemon Types</option>
                    <option value="clan">Clans</option>
                    <option value="evolution">Evolutions</option>
                </select>
                
                <div class="Info" id="Info"></div>

                <input type="hidden" name="address" value="Database">
                
            </form>
        </div>
        
        <script>
            //Populate Divs with Database Information
            
            function displayData() {
                RaceArray = <?php echo json_encode($dataRace) ?>;
                ClassArray = <?php echo json_encode($dataClass) ?>;
                AttributeArray = <?php echo json_encode($dataAttr) ?>;
                AnimalArray = <?php echo json_encode($dataAnimal) ?>;
                WeaponArray = <?php echo json_encode($dataWeapon) ?>;
                PokeArray = <?php echo json_encode($dataPoke) ?>;
                ClanArray = <?php echo json_encode($dataClan) ?>;
                EvoArray = <?php echo json_encode($dataEvol) ?>;

                function genElement(name) {
                    console.log();
                    lbl = document.createElement("p");
                    lbl.innerHTML = name;
                    lbl.className = "data-display";
                    optionOutput.appendChild(lbl);
                }

                for (i=0; i < RaceArray.length; i++) {
                    optionOutput = document.getElementById('Race');
                    genElement(RaceArray[i].raceName);
                }
                for (i=0; i < ClassArray.length; i++) {
                    optionOutput = document.getElementById('Class');
                    genElement(ClassArray[i].className);
                }
                for (i=0; i < AttributeArray.length; i++) {
                    optionOutput = document.getElementById('Attr');
                    genElement(AttributeArray[i].attrName);
                }
                for (i=0; i < AnimalArray.length; i++) {
                    optionOutput = document.getElementById('Familiar');
                    genElement(AnimalArray[i].famName);
                }
                for (i=0; i < WeaponArray.length; i++) {
                    optionOutput = document.getElementById('Weapon');
                    genElement(WeaponArray[i].weaponName);
                }
                for (i=0; i < PokeArray.length; i++) {
                    optionOutput = document.getElementById('Types');
                    genElement(PokeArray[i].pokeType);
                }
                for (i=0; i < ClanArray.length; i++) {
                    optionOutput = document.getElementById('Clan');
                    genElement(ClanArray[i].clanClass);
                }
                for (i=0; i < EvoArray.length; i++) {
                    optionOutput = document.getElementById('Evol');
                    genElement(EvoArray[i].evolName);
                }
            }

            function displayForm() {
                SelectParent = document.getElementById("database");
                database = SelectParent.options[SelectParent.selectedIndex].text;

                infoOutput = document.getElementById("Info");

                function clearForm() {
                    while (infoOutput.firstChild) {
                        infoOutput.removeChild(infoOutput.lastChild);
                    }
                }

                switch (database) {
                    case('Races'):
                        clearForm();
                        //dispaly race info
                        lblRace = document.createElement('label');
                        lblRace.innerHTML = "Race's Name: ";
                        lblRace.setAttribute('for', 'raceName');

                        inputRace = document.createElement('input');
                        inputRace.type = 'text';
                        inputRace.setAttribute('id', 'raceName');
                        inputRace.setAttribute('name', 'raceName');

                        lblDesc = document.createElement('label');
                        lblDesc.innerHTML = "Race Desc: ";
                        lblDesc.setAttribute('for', 'raceDesc');

                        inputDesc = document.createElement('input');
                        inputDesc.type = 'text';
                        inputDesc.setAttribute('id', 'raceDesc');
                        inputDesc.setAttribute('name', 'raceDesc');

                        infoOutput.appendChild(lblRace);
                        infoOutput.appendChild(inputRace);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblDesc);
                        infoOutput.appendChild(inputDesc);

                        break;
                    case('Classes'):
                        clearForm();
                        //dispaly class info
                        lblClass = document.createElement('label');
                        lblClass.innerHTML = "Class' Name: ";
                        lblClass.setAttribute('for', 'className');

                        inputClass = document.createElement('input');
                        inputClass.type = 'text';
                        inputClass.setAttribute('id', 'className');
                        inputClass.setAttribute('name', 'className')

                        lblType = document.createElement('label');
                        lblType.innerHTML = "Class Desc: ";
                        lblType.setAttribute('for', 'classType');

                        inputType = document.createElement('input');
                        inputType.type = 'text';
                        inputType.setAttribute('id', 'classType');
                        inputType.setAttribute('name', 'classType')

                        infoOutput.appendChild(lblClass);
                        infoOutput.appendChild(inputClass);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblType);
                        infoOutput.appendChild(inputType);

                        break;
                    case('Attributes'):
                        clearForm();
                        //dispaly attribute info
                        lblName = document.createElement('label');
                        lblName.innerHTML = "Attribute's Name: ";
                        lblName.setAttribute('for', 'attrName');

                        inputName = document.createElement('input');
                        inputName.type = 'text';
                        inputName.setAttribute('id', 'attrName');
                        inputName.setAttribute('name', 'attrName');

                        lblClass = document.createElement('label');
                        lblClass.innerHTML = "Attribute Desc: ";
                        lblClass.setAttribute('for', 'attrClass');

                        inputClass = document.createElement('input');
                        inputClass.type = 'text';
                        inputClass.setAttribute('id', 'attrClass');
                        inputClass.setAttribute('name', 'attrClass');

                        infoOutput.appendChild(lblName);
                        infoOutput.appendChild(inputName);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblClass);
                        infoOutput.appendChild(inputClass);

                        break;
                    case('Familiars'):
                        clearForm();
                        //dispaly familiars info
                        lblName = document.createElement('label');
                        lblName.innerHTML = "Animal's Name: ";
                        lblName.setAttribute('for', 'famName');

                        inputName = document.createElement('input');
                        inputName.type = 'text';
                        inputName.setAttribute('id', 'famName');
                        inputName.setAttribute('name', 'famName');

                        infoOutput.appendChild(lblName);
                        infoOutput.appendChild(inputName);

                        break;
                    case('Weapons'):
                        clearForm();
                        //dispaly weapon info
                        lblName = document.createElement('label');
                        lblName.innerHTML = "Weapon's Name: ";
                        lblName.setAttribute('for', 'weaponName');

                        inputName = document.createElement('input');
                        inputName.type = 'text';
                        inputName.setAttribute('id', 'weaponName');
                        inputName.setAttribute('name', 'weaponName');

                        lblParts = document.createElement('label');
                        lblParts.innerHTML = "# of Weapon Parts: ";
                        lblParts.setAttribute('for', 'weaponParts');

                        inputParts = document.createElement('input');
                        inputParts.type = 'text';
                        inputParts.setAttribute('id', 'weaponParts');
                        inputParts.setAttribute('name', 'weaponParts');

                        lblPartOne = document.createElement('label');
                        lblPartOne.innerHTML = "Part One: ";
                        lblPartOne.setAttribute('for', 'partOne');

                        inputPartOne = document.createElement('input');
                        inputPartOne.type = 'text';
                        inputPartOne.setAttribute('id', 'partOne');
                        inputPartOne.setAttribute('name', 'partOne');
                        
                        lblPartTwo = document.createElement('label');
                        lblPartTwo.innerHTML = "Part Two: ";
                        lblPartTwo.setAttribute('for', 'partTwo');

                        inputPartTwo = document.createElement('input');
                        inputPartTwo.type = 'text';
                        inputPartTwo.setAttribute('id', 'partwo');
                        inputPartTwo.setAttribute('name', 'partTwo');
                        
                        lblPartThree = document.createElement('label');
                        lblPartThree.innerHTML = "Part Three: ";
                        lblPartThree.setAttribute('for', 'partThr');

                        inputPartThree = document.createElement('input');
                        inputPartThree.type = 'text';
                        inputPartThree.setAttribute('id', 'partThr');
                        inputPartThree.setAttribute('name', 'partThr');

                        lblPartFour = document.createElement('label');
                        lblPartFour.innerHTML = "Part Four: ";
                        lblPartFour.setAttribute('for', 'partFour');

                        inputPartFour = document.createElement('input');
                        inputPartFour.type = 'text';
                        inputPartFour.setAttribute('id', 'partFour');
                        inputPartFour.setAttribute('name', 'partFour');

                        infoOutput.appendChild(lblName);
                        infoOutput.appendChild(inputName);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblParts);
                        infoOutput.appendChild(inputParts);
                        infoOutput.appendChild(document.createElement("br"));
                        
                        infoOutput.appendChild(lblPartOne);
                        infoOutput.appendChild(inputPartOne);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblPartTwo);
                        infoOutput.appendChild(inputPartTwo);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblPartThree);
                        infoOutput.appendChild(inputPartThree);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblPartFour);
                        infoOutput.appendChild(inputPartFour);

                        break;
                    case('Pokemon Types'):
                        clearForm();
                        //dispaly pokemon info
                        lblType = document.createElement('label');
                        lblType.innerHTML = "Pokemon Type: ";
                        lblType.setAttribute('for', 'pokeType');

                        inputType = document.createElement('input');
                        inputType.type = 'text';
                        inputType.setAttribute('id', 'pokeType');
                        inputType.setAttribute('name', 'pokeType');

                        infoOutput.appendChild(lblType);
                        infoOutput.appendChild(inputType);

                        break;
                    case('Clans'):
                        clearForm();
                        //dispaly clans info
                        lblName = document.createElement('label');
                        lblName.innerHTML = "Clan's Name: ";
                        lblName.setAttribute('for', 'clanName');

                        inputName = document.createElement('input');
                        inputName.type = 'text';
                        inputName.setAttribute('id', 'clanName');
                        inputName.setAttribute('name', 'clanName');

                        lblClass = document.createElement('label');
                        lblClass.innerHTML = "Clan Class: ";
                        lblClass.setAttribute('for', 'clanClass');

                        inputClass = document.createElement('input');
                        inputClass.type = 'text';
                        inputClass.setAttribute('id', 'clanClass');
                        inputClass.setAttribute('name', 'clanClass');

                        infoOutput.appendChild(lblName);
                        infoOutput.appendChild(inputName);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblClass);
                        infoOutput.appendChild(inputClass);

                        break;
                    case('Evolutions'):
                        clearForm();
                        //dispaly evolution info
                        lblName = document.createElement('label');
                        lblName.innerHTML = "Evolution's Name: ";
                        lblName.setAttribute('for', 'evolName');

                        inputName = document.createElement('input');
                        inputName.type = 'text';
                        inputName.setAttribute('id', 'evolName');
                        inputName.setAttribute('name', 'evolName');

                        lblType = document.createElement('label');
                        lblType.innerHTML = "Evolution Type: ";
                        lblType.setAttribute('for', 'evolType');

                        inputType = document.createElement('input');
                        inputType.type = 'text';
                        inputType.setAttribute('id', 'evolType');
                        inputType.setAttribute('name', 'evolType');

                        infoOutput.appendChild(lblName);
                        infoOutput.appendChild(inputName);
                        infoOutput.appendChild(document.createElement("br"));
                        infoOutput.appendChild(lblType);
                        infoOutput.appendChild(inputType);

                        break;
                    default:
                        clearForm();
                        break;
                }
                
                btn = document.createElement("input");
                btn.type = 'submit';
                btn.setAttribute('name', 'submit');

                infoOutput.appendChild(document.createElement("br"));
                infoOutput.appendChild(btn);
            }
            
            displayData();
        </script>

        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>
    </body>
</html>