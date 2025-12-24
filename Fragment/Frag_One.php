<?php
    $connect = mysqli_connect('localhost', 'Drake', 'Password1234', 'concepts');

    if(!$connect){
        echo 'Connection Error: ' . mysqli_connect_error();
    }

    $AnimalResult = mysqli_query($connect, 'SELECT famName FROM familiars');
    $AttributeResult = mysqli_query($connect, 'SELECT attrName FROM attributes');
    $NameResult = mysqli_query($connect, 'SELECT userName FROM names');

    $Animal = mysqli_fetch_all($AnimalResult, MYSQLI_ASSOC);
    $Attribute = mysqli_fetch_all($AttributeResult, MYSQLI_ASSOC);
    $Name = mysqli_fetch_all($NameResult, MYSQLI_ASSOC);

    mysqli_free_result($AnimalResult);
    mysqli_free_result($AttributeResult);
    mysqli_free_result($NameResult);

    mysqli_close($connect);
?>

<!DOCTYPE html>
<!-- 
    <li><a href="#">Famliiar</a></li>
    <li><a href="#">Garden</a></li>
    <li><a href="#">Inventory</a></li>
 -->
<html>
    <head>
        <link rel="stylesheet" href="/Templates/CSS/Design.css">
        <link rel="stylesheet" href="/Templates/CSS/FragDesign.css">
        <title>Fragments</title>
    </head>
    <body>
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>
        
        <div id="frag-list"> 
            <ul>
                <li class="tab" id="fam"><label>Fragment One: Familiars</label></li>
                <li class="tab" id="grdn"><label>Fragment Two: Garden</label></li>
                <li class="tab" id="invt"><label>Fragment Three: Inventory</label></li>
            </ul>
        </div>

        <div class="fragments">
            <div id="familiar" style="display: block;">
                <div>
                    <button onclick="genFamiliar()">random familiar</button>

                    <button onclick="breedFamiliar(document.getElementById('famOne').value,document.getElementById('famTwo').value)">Breed</button>
                    <input type="text" id="famOne" placeholder="Parent One">
                    <input type="text" id="famTwo" placeholder="Parent Two">

                    
                    <button onclick="findFamiliar(document.getElementById('search').value)">Find</button>
                    <input type="text" id="search" placeholder="search">
                </div>
                <div id="fam-display"></div>
            </div>
            
            <hr> <!--Fragment Two - Garden Interaction-->
            <div id="garden" style="display: none;">
                <button onclick="genFarm()">Till Plot</button>
                <div id="farm-display"></div>
            </div>

            <hr> <!--Fragment Three - Inventory Storage-->
            <div id="inventory" style="display: none;">
                <p style="color: white;">THIS IS THE INVENTORY</p>
            </div>
        </div>

        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>

        <script>
            var famCount = 0;
            var famStore = [];

            var famDisplay = document.getElementById("fam-display");
            var tabList = document.getElementsByClassName("tab");

            for (var i=0; i < tabList.length; i++) {
                tabList[i].addEventListener('click', function() {
                    var famili = document.getElementById("familiar");
                    var garden = document.getElementById("garden");
                    var invent = document.getElementById("inventory");
                    
                    if (this.id == "fam") {
                        famili.style.display = 'block';
                        garden.style.display = 'none';
                        invent.style.display = 'none';
                    } else if (this.id == "grdn") {
                        famili.style.display = 'none';
                        garden.style.display = 'block';
                        invent.style.display = 'none';
                    } else if (this.id =="invt") {
                        famili.style.display = 'none';
                        garden.style.display = 'none';
                        invent.style.display = 'block';
                    }
                }, false);
            }

            function randomNum() {
                number = Math.floor(Math.random()*30);
                return number;
            }

            function flipCoin() {
                dice = Math.floor(Math.random()*2);
                return dice;
            }

            function genFamiliar() {
                if (famCount <= 23) {

                    nameArray = <?php echo json_encode($Name) ?>;
                    animalArray = <?php echo json_encode($Animal) ?>;
                    attrArray = <?php echo json_encode($Attribute) ?>;

                    randomName = nameArray[Math.floor(Math.random()*nameArray.length)].userName;
                    randomSpec = animalArray[Math.floor(Math.random()*animalArray.length)].famName;
                    randomAttr = attrArray[Math.floor(Math.random()*attrArray.length)].attrName;

                    const familiar = {
                        ID: famCount+1,
                        Name: randomName,
                        Species: randomSpec,
                        Affinity: randomAttr,
                        HP: randomNum(),
                        PAtk: randomNum(),
                        MAtk: randomNum(),
                        PDef: randomNum(),
                        MDef: randomNum()
                    }

                    format =
                        "Name: " + familiar.Name +
                        "<br>Species: " + familiar.Species + 
                        "<br>Affinity: " + familiar.Affinity +
                        "<br>HP: " + familiar.HP +
                        "<br>Phys. Atk: " + familiar.PAtk +
                        "<br>Mag. Atk: " + familiar.MAtk +
                        "<br>Phys. Def: " + familiar.PDef +
                        "<br>Mag. Def: " + familiar.MDef;

                    container = document.createElement("div");
                    container.className = 'fam-plate';

                    idPlate = document.createElement("p");
                    idPlate.setAttribute("id", familiar.ID);
                    idPlate.innerHTML = "ID: " + familiar.ID;

                    output = document.createElement("p");
                    output.setAttribute("id", familiar.Name)
                    output.className = 'familiar';
                    output.innerHTML = format;

                    dismiss = document.createElement("button");
                    dismiss.setAttribute("onclick", 'dismissFamiliar(this.parentNode)');
                    dismiss.innerHTML = "dismiss";

                    container.appendChild(idPlate);
                    container.appendChild(output);
                    container.appendChild(dismiss);
                    famDisplay.appendChild(container);

                    famCount++;
                    famStore.push(familiar);
                }
            }

            function breedFamiliar(famOne, famTwo) {
                if (famCount <= 23) {

                    parentOne = famStore[famOne];
                    parentTwo = famStore[famTwo];
                    genePool = [parentOne, parentTwo];

                    nameArray = <?php echo json_encode($Name) ?>;
                    randomName = nameArray[Math.floor(Math.random()*nameArray.length)].userName;
                
                    const familiar = {
                        ID: famCount,
                        Name: randomName,
                        Species: randomSpec,
                        Affinity: randomAttr,
                        HP: randomNum(),
                        PAtk: randomNum(),
                        MAtk: randomNum(),
                        PDef: randomNum(),
                        MDef: randomNum()
                    }

                    familiar.Name = randomName;
                    familiar.Species = genePool[flipCoin()].Species;
                    familiar.Affinity = genePool[flipCoin()].Affinity;
                    familiar.HP = genePool[flipCoin()].HP;
                    familiar.PAtk = genePool[flipCoin()].PAtk;
                    familiar.MAtk = genePool[flipCoin()].MAtk;
                    familiar.PDef = genePool[flipCoin()].PDef;
                    familiar.MDef = genePool[flipCoin()].MDef;

                    format =
                        "Name: " + familiar.Name +
                        "<br>Species: " + familiar.Species + 
                        "<br>Affinity: " + familiar.Affinity +
                        "<br>HP: " + familiar.HP +
                        "<br>Phys. Atk: " + familiar.PAtk +
                        "<br>Mag. Atk: " + familiar.MAtk +
                        "<br>Phys. Def: " + familiar.PDef +
                        "<br>Mag. Def: " + familiar.MDef;

                    container = document.createElement("div");
                    container.className = 'fam-plate';

                    idPlate = document.createElement("p");
                    idPlate.setAttribute("id", familiar.ID);
                    idPlate.innerHTML = "ID: " + familiar.ID;

                    output = document.createElement("p");
                    output.setAttribute("id", familiar.Name)
                    output.className = 'familiar';
                    output.innerHTML = format;

                    dismiss = document.createElement("button");
                    dismiss.setAttribute("onclick", 'dismissFamiliar(this.parentNode)');
                    dismiss.innerHTML = "dismiss";

                    container.appendChild(idPlate);
                    container.appendChild(output);
                    container.appendChild(dismiss);
                    famDisplay.appendChild(container);


                    famCount++;
                    famStore.push(familiar);
                }
            }

            function findFamiliar(search) {
                NodeList.prototype.forEach = Array.prototype.forEach;
                parent = document.getElementById('fam-display');
                children = parent.childNodes;
                console.log(children);

                found = document.getElementById(search).parentNode;

                if(found) {
                    found.classList.toggle("fam-plate");
                    found.classList.toggle("found");
                } else {console.log('Null')}

                interval = 1500;
                expected = Date.now() + interval;
                setTimeout(step, interval);
                function step() {
                    var dt = Date.now() - expected;
                    if (dt > interval) {
                        console.log("Something went Wrong?")
                    }
                    found.classList.toggle("fam-plate");
                    found.classList.toggle("found");
                    expected += interval;
                }
            }

            function dismissFamiliar(oldBud) {
                console.log(famCount);
                famCount--;
                console.log(oldBud);
                console.log("Dismissed " + oldBud);
                oldBud.remove();
                console.log(famCount);
            }
            
        </script>
    </body>
</html>