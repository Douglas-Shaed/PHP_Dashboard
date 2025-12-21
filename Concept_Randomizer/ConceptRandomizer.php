<?php
    $connect = mysqli_connect('localhost', 'Drake', 'Password1234', 'concepts');

    if(!$connect){
        echo 'Connection Error: ' . mysqli_connect_error();
    }

    $focusRaceResult = mysqli_query($connect, 'SELECT raceName FROM races');
    $focusClassResult = mysqli_query($connect, 'SELECT className FROM class');
    $focusAttributeResult = mysqli_query($connect, 'SELECT attrName FROM attributes');
    $focusAnimalResult = mysqli_query($connect, 'SELECT famName FROM familiars');
    $focusWeaponResult = mysqli_query($connect, 'SELECT weaponName FROM modweapon');
    $focusPokeResult = mysqli_query($connect, 'SELECT pokeType FROM poketypes');
    $focusClanResult = mysqli_query($connect, 'SELECT clanClass FROM clan');
    $focusEvolResult = mysqli_query($connect, 'SELECT evolName FROM evolution');
    $focusBiomeResult = mysqli_query($connect, 'SELECT biomeName FROM biomes');
    $focusAdjResult = mysqli_query($connect, 'SELECT adjName FROM adjectives');
    $focusFeatResult = mysqli_query($connect, 'SELECT featName FROM features');

    $focusRace = mysqli_fetch_all($focusRaceResult, MYSQLI_ASSOC);
    $focusClass = mysqli_fetch_all($focusClassResult, MYSQLI_ASSOC);
    $focusAttribute = mysqli_fetch_all($focusAttributeResult, MYSQLI_ASSOC);
    $focusAnimal = mysqli_fetch_all($focusAnimalResult, MYSQLI_ASSOC);
    $focusWeapon = mysqli_fetch_all($focusWeaponResult, MYSQLI_ASSOC);
    $focusPoke = mysqli_fetch_all($focusPokeResult, MYSQLI_ASSOC);
    $focusClan = mysqli_fetch_all($focusClanResult, MYSQLI_ASSOC);
    $focusEvol = mysqli_fetch_all($focusEvolResult, MYSQLI_ASSOC);
    $focusBiome = mysqli_fetch_all($focusBiomeResult, MYSQLI_ASSOC);
    $focusAdj = mysqli_fetch_all($focusAdjResult, MYSQLI_ASSOC);
    $focusFeat = mysqli_fetch_all($focusFeatResult, MYSQLI_ASSOC);

    mysqli_free_result($focusRaceResult);
    mysqli_free_result($focusClassResult);
    mysqli_free_result($focusAttributeResult);
    mysqli_free_result($focusAnimalResult);
    mysqli_free_result($focusWeaponResult);
    mysqli_free_result($focusPokeResult);
    mysqli_free_result($focusClanResult);
    mysqli_free_result($focusEvolResult);

    mysqli_close($connect);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Templates/CSS/RandomizerDesign.css">
        <script src="conceptScript.js" defer></script>
        <title>Concept Randomizer</title>
    </head>
    <body class="Random">
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>
        
        <div class="Container" id="Concepts">
            <div class="ConceptGroup">
                <h2>Character Generator</h2>
                <div class="dropdown">
                    <button class="link" onclick="populateOption('Race', 'Character')">Race</button>
                    <button class="link" onclick="populateOption('Class', 'Character')">Class</button>
                    <button class="link" onclick="populateOption('Clan', 'Character')">Clan</button>
                    <button class="link" id="character" onclick="generateConcept('Boop', 'Character')">Random Gen</button>
                </div>
            </div>

            <div class="ConceptGroup">
                <h2>Familiar Generator</h2>
                <div class="dropdown">
                    <button class="link" onclick="populateOption('Attr', 'Familiar')">Attribute</button>
                    <button class="link" onclick="populateOption('Animal', 'Familiar')">Animal</button>
                    <button class="link" onclick="populateOption('Evol', 'Familiar')">Evo-Path</button>
                    <button class="link" onclick="generateConcept('Boop', 'Familiar')">Random Gen</button>
                </div>
            </div>

            <div class="ConceptGroup">
                <h2>Weapon Generator</h2>
                <div class="dropdown">
                    <button class="link" onclick="populateOption('Attr', 'Modular')">Attribute</button>
                    <button class="link" onclick="populateOption('Weap', 'Modular')">Weapon Type</button>
                    <button class="link" onclick="populateOption('Trick', 'Modular')">Trick Switch</button>
                    <button class="link" onclick="generateConcept('Boop', 'Modular')">Random Gen</button>
                </div>
            </div>

            <div class="ConceptGroup">
                <h2>Fake'mon Generator</h2>
                <div class="dropdown">
                    <button class="link" onclick="populateOption('Type', 'Poke')">Type One</button>
                    <button class="link" onclick="populateOption('Num', 'Poke')"># of Evo's</button>
                    <button class="link" onclick="populateOption('Animal', 'Poke')">Animal</button>
                    <button class="link" onclick="generateConcept('Boop', 'Poke')">Random Gen</button>
                </div>
            </div>

            <div class="ConceptGroup">
                <h2>Environment Generator</h2>
                <div class="dropdown">
                    <button class="link" onclick="populateOption('Biome', 'Envi')">Biome</button>
                    <button class="link" onclick="populateOption('Adj', 'Envi')">Adjective</button>
                    <button class="link" onclick="populateOption('Feature', 'Envi')">Feature</button>
                    <button class="link" onclick="generateConcept('Boop', 'Envi')">Random Gen</button>
                </div>
            </div>
            <div>
                <h2>Miscellaneous</h2>
                <div>
                    <button class="link" onclick="populateOption('Guild', 'Misc')">Guild</button>
                    <button class="link">Blank</button>
                    <button class="link">Blank</button>
                    <button class="link">Blank</button>
                </div>
            </div>
        </div>
        
        <div class="Container option" id="option-select">
        </div>

        <div class="Container result">
            <div class="ConceptGroup">
                <h2>Your Concept is:</h2>
                <div class="output">
                    <!-- Output One -->
                    <p id="final-one">Myeah</p>
                </div>
                <div class="output">
                    <!-- Output Two -->
                    <p id="final-two">See</p>
                </div>
                <div class="output">
                    <!-- Output Three -->
                    <p id="final-thr">Myeah</p>
                </div>
            </div>
        </div>

        <script>
            function populateOption(focus, gener) { 
                const optionOutput = document.getElementById('option-select');

                while (optionOutput.firstChild) {
                    optionOutput.removeChild(optionOutput.lastChild);
                }

                function genElement(name) {
                    btn = document.createElement("button");
                    btn.innerHTML = name;
                    btn.type = 'button'
                    btn.className = 'option-gen'
                    btn.onclick = function () {
                        generateConcept(name, gener)
                    };
                    optionOutput.appendChild(btn);
                }

                RaceArray = <?php echo json_encode($focusRace) ?>;
                ClassArray = <?php echo json_encode($focusClass) ?>;
                AttributeArray = <?php echo json_encode($focusAttribute) ?>;
                AnimalArray = <?php echo json_encode($focusAnimal) ?>;
                WeaponArray = <?php echo json_encode($focusWeapon) ?>;
                PokeArray = <?php echo json_encode($focusPoke) ?>;
                ClanArray = <?php echo json_encode($focusClan) ?>;
                EvoArray = <?php echo json_encode($focusEvol) ?>;
                TrickArray = <?php echo json_encode($focusWeapon) ?>;
                BiomeArray = <?php echo json_encode($focusBiome) ?>;
                AdjArray = <?php echo json_encode($focusAdj) ?>;
                FeatArray = <?php echo json_encode($focusFeat) ?>;
                NumArray = [0, 1, 2, 3, 4, 5];
                GuildArray = ['Hunter', 'Mage', 'Adventurer'];


                if (focus === 'Animal') {
                    for (i=0; i < AnimalArray.length; i++) {
                        genElement(AnimalArray[i].famName);
                    }
                } else if (focus === 'Type') {
                    for (i=0; i < PokeArray.length; i++) {
                        genElement(PokeArray[i].pokeType);
                    }
                } else if (focus === 'Evol') {
                    for (i=0; i < EvoArray.length; i++) {
                        genElement(EvoArray[i].evolName);
                    }
                } else if (focus === 'Race') {
                    for (i=0; i < RaceArray.length; i++) {
                        genElement(RaceArray[i].raceName);
                    }
                } else if (focus === 'Class') {
                    for (i=0; i < ClassArray.length; i++) {
                        genElement(ClassArray[i].className);
                    }
                } else if (focus === 'Clan') {
                    for (i=0; i < ClanArray.length; i++) {
                        genElement(ClanArray[i].clanClass);
                    }
                } else if (focus === 'Attr') {
                    for (i=0; i < AttributeArray.length; i++) {
                        genElement(AttributeArray[i].attrName);
                    }
                } else if (focus === 'Num') {
                    for (i=0; i < NumArray.length; i++) {
                        genElement(i.toString());
                    }
                } else if (focus === 'Weap') {
                    for (i=0; i < WeaponArray.length; i++) {
                        genElement(WeaponArray[i].weaponName);
                    }
                } else if (focus === 'Trick') {
                    for (i=0; i < TrickArray.length; i++) {
                        genElement(TrickArray[i].weaponName);
                    }
                } else if (focus === 'Biome') {
                    for (i=0; i < BiomeArray.length; i++) {
                        genElement(BiomeArray[i].biomeName);
                    }
                } else if (focus === 'Adj') {
                    for (i=0; i < AdjArray.length; i++) {
                        genElement(AdjArray[i].adjName);
                    }
                } else if (focus === 'Feature') {
                    for (i=0; i < FeatArray.length; i++) {
                        genElement(FeatArray[i].featName);
                    }
                } else if (focus === 'Guild') {
                    for (i=0; i < GuildArray.length; i++) {
                        genElement(GuildArray[i]);
                    }
                } else {
                    throw "Error " + focus + " Not Recognized"
                }
            }


            
            function  generateConcept(focus, Generate) {
                function genX(focusItem, focusGroup, focusParent) {
                    testItem = [];
                    objProps = [];
                    objProps.push(Object.getOwnPropertyNames(focusParent[0][0]));
                    objProps.push(Object.getOwnPropertyNames(focusParent[1][0]));
                    objProps.push(Object.getOwnPropertyNames(focusParent[2][0]));

                    if (focusParent === parentFor) {
                        if (focusGroup === 0) {
                            testItem[0] = focusItem;
                            testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[1] += " " + focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2][5])];9
                        } else if (focusGroup === 1) {
                            testItem[0] = focusParent[0][Math.floor(Math.random()*focusParent[0].length)][objProps[0]];
                            testItem[1] = focusItem;
                            testItem[1] += " " + focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2][5])];9
                        } else if (focusGroup === 2) {
                            testItem[0] = focusParent[0][Math.floor(Math.random()*focusParent[0].length)][objProps[0]];
                            testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[1] += " " + focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[2] = focusItem;
                        } else {
                            testItem[0] = focusParent[0][Math.floor(Math.random()*focusParent[0].length)][objProps[0]];
                            testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[1] += " " + focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2][5])];
                        }
                        return testItem;
                    }

                    if (focusParent === parentSix) {
                        if (focusGroup === 0) {
                            testItem[0] = focusItem;
                            testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                            testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2].length)];
                        }
                        return testItem;
                    }

                    if (focusGroup === 0) {
                        testItem[0] = focusItem;
                        testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                        testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2].length)][objProps[2]];
                    } else if (focusGroup === 1) {
                        testItem[0] = focusParent[0][Math.floor(Math.random()*focusParent[0].length)][objProps[0]];
                        testItem[1] = focusItem;
                        testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2].length)][objProps[2]];
                    } else if (focusGroup === 2) {
                        testItem[0] = focusParent[0][Math.floor(Math.random()*focusParent[0].length)][objProps[0]];
                        testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                        testItem[2] = focusItem;
                    } else {
                        testItem[0] = focusParent[0][Math.floor(Math.random()*focusParent[0].length)][objProps[0]];
                        testItem[1] = focusParent[1][Math.floor(Math.random()*focusParent[1].length)][objProps[1]];
                        testItem[2] = focusParent[2][Math.floor(Math.random()*focusParent[2].length)][objProps[2]];
                    }
                    return testItem;
                }

                RaceArray = <?php echo json_encode($focusRace) ?>;
                ClassArray = <?php echo json_encode($focusClass) ?>;
                ClanArray = <?php echo json_encode($focusClan) ?>;
                AttributeArray = <?php echo json_encode($focusAttribute) ?>;
                AnimalArray = <?php echo json_encode($focusAnimal) ?>;
                WeaponArray = <?php echo json_encode($focusWeapon) ?>;
                PokeArray = <?php echo json_encode($focusPoke) ?>;
                EvoArray = <?php echo json_encode($focusEvol) ?>;
                TrickArray = <?php echo json_encode($focusWeapon) ?>;
                BiomeArray = <?php echo json_encode($focusBiome) ?>;
                AdjArray = <?php echo json_encode($focusAdj) ?>;
                FeatArray = <?php echo json_encode($focusFeat) ?>;
                NumArray = [0, 1, 2, 3, 4, 5];
                GuildArray = ['Hunter', 'Mage', 'Adventurer'];
                ColorArray = ['Red', 'Orange', 'Yellow', 'Green', 'Blue', 'Purple', 'Black', 'White'];

                parentOne = [RaceArray, ClassArray, ClanArray];
                parentTwo = [AnimalArray, AttributeArray, EvoArray];
                parentThr = [WeaponArray, AttributeArray, TrickArray];
                parentFor = [AnimalArray, PokeArray, NumArray];
                parentFiv = [BiomeArray, AdjArray, FeatArray];
                parentSix = [GuildArray, AnimalArray, ColorArray]
                
                const OutputOne = document.getElementById('final-one');
                const OutputTwo = document.getElementById('final-two');
                const OutputThr = document.getElementById('final-thr');

                
                if (Generate === 'Character') {
                    if (RaceArray.find(x => x.raceName === focus) != undefined) {
                        finalOutput = genX(focus, 0, parentOne);
                    } else if (ClassArray.find(x => x.className === focus) != undefined) {
                        finalOutput = genX(focus, 1, parentOne);
                    } else if (ClanArray.find(x => x.clanClass === focus) != undefined) {
                        finalOutput = genX(focus, 2, parentOne);
                    } else {
                        finalOutput = genX(focus, 3, parentOne);
                    }
                }
                
                else if (Generate === 'Familiar') {
                    if (AnimalArray.find(x => x.famName === focus) != undefined) {
                        finalOutput = genX(focus, 0, parentTwo);
                    } else if (AttributeArray.find(x => x.attrName === focus) != undefined) {
                        finalOutput = genX(focus, 1, parentTwo);
                    } else if (EvoArray.find(x => x.evolName === focus) != undefined) {
                        finalOutput = genX(focus, 2, parentTwo);
                    } else {
                        finalOutput = genX(focus, 3, parentTwo);
                    }
                }
                
                else if (Generate === 'Modular') {
                    if (WeaponArray.find(x => x.weaponName === focus) != undefined) {
                        finalOutput = genX(focus, 0, parentThr);
                    } else if (AttributeArray.find(x => x.attrName === focus) != undefined) {
                        finalOutput = genX(focus, 1, parentThr);
                    } else if (TrickArray.find(x => x.weaponName === focus) != undefined) {
                        finalOutput = genX(focus, 2, parentThr);
                    } else {
                        finalOutput = genX(focus, 3, parentThr);
                    }
                }

                else if (Generate === 'Poke') {
                    if (AnimalArray.find(x => x.famName === focus) != undefined) {
                        finalOutput = genX(focus, 0, parentFor);
                    } else if (PokeArray.find(x => x.pokeType === focus) != undefined) {
                        finalOutput = genX(focus, 1, parentFor);
                    } else if (!isNaN(focus)) {
                        finalOutput = genX(focus, 2, parentFor);
                    } else {
                        finalOutput = genX(focus, 3, parentFor);
                    }
                }

                else if (Generate === 'Envi') {
                    if (BiomeArray.find(x => x.biomeName === focus) != undefined) {
                        finalOutput = genX(focus, 0, parentFiv);
                    } else if (BiomeArray.find(x => x.adjName === focus) != undefined) {
                        finalOutput = genX(focus, 1, parentFiv);
                    } else if (BiomeArray.find(x => x.featName === focus) != undefined) {
                        finalOutput = genX(focus, 2, parentFiv);
                    } else {
                        finalOutput = genX(focus, 3, parentFiv);
                    }
                }

                else if (Generate === 'Misc') {
                    if (GuildArray.find(x => x === focus) != undefined) {
                        finalOutput = genX(focus, 0, parentSix);
                    }
                }

                
                else {throw "ERROR: " + Generate + " " + focus}

                OutputOne.innerHTML = finalOutput[0];
                OutputTwo.innerHTML = finalOutput[1];
                OutputThr.innerHTML = finalOutput[2];
            }
        </script>

        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>
    </body>
</html>