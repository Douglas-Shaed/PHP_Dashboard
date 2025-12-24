<?php
	$connect = mysqli_connect('localhost', 'Drake', 'Password1234', 'daylight');
    $mydir = "/Coding/Projects/Dashboard/Gallery/Daylight";

	if(!$connect){
		echo 'Connection Error: ' . mysqli_connect_error();
	}

	$dbdNameResult = mysqli_query($connect, 'SELECT charName, charType FROM dbdnames');
	$dbdAddonResult = mysqli_query($connect, 'SELECT aoName, aoRarity, aoLimit FROM dbdaddons');
	$dbdOfferingResult = mysqli_query($connect, 'SELECT offerName, offerRarity, offerLimit FROM dbdofferings');


	$dbdName = mysqli_fetch_all($dbdNameResult, MYSQLI_ASSOC);
	$dbdAddon = mysqli_fetch_all($dbdAddonResult, MYSQLI_ASSOC);
	$dbdOffering = mysqli_fetch_all($dbdOfferingResult, MYSQLI_ASSOC);
	$dbdImages = scandir($mydir);

	mysqli_free_result($dbdNameResult);
	mysqli_free_result($dbdAddonResult);
	mysqli_free_result($dbdOfferingResult);

	mysqli_close($connect);
?>

<!DOCTYPE HTML>
<html>
	<head>
	<link rel="stylesheet" href="/Templates/CSS/Design.css">
	<link rel="stylesheet" href="/Templates/CSS/DbDesign.css">
	<title>DbDIM</title>
	</head>

	<body>
		<?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>

		<div id="char-list">
			<ul id="surv">
			</ul>

			<ul id="kill">
			</ul>
		</div>

		<div class="inventory">
			<h1 class="hidden">Survivor Items</h1>
			<div class="items" id="S_Items">
			</div>

			<h1 class="hidden">Add-Ons</h1>
			<div class="items" id="item_add">
			</div>

			<h1 class="hidden">Offerings</h1>
			<div class="items" id="item_offer">
			</div>
		</div>
	
		<?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>

		<script>
			var save_Data = [];
			load_Data();
			populateOptions();

			function load_Data() {
				loadData = fetch("dbdData.txt").then((data) => data.text()).then((text) => {
					charKey = text.split('\r\n')
					charKey.forEach(x => {
						temp = x.split(",")
						save_Data.push([temp[0],temp[1],temp[2],temp[3]])
					})
				});
			}

			function populateOptions() {
				NameArray = <?php echo json_encode($dbdName) ?>;//list of character names stored in db

				for (i=0; i < NameArray.length; i++) {//generates clickable list items
					listItem = document.createElement("li");
					listItem.id = NameArray[i].charName;
					listItem.innerHTML = NameArray[i].charName;
					listItem.addEventListener("click", function() {
						headers = document.getElementsByTagName('h1');
						clear_char();
						gen_items(this.innerHTML);
						gen_addons(this.innerHTML);
						gen_offerings(this.innerHTML);
						if (this.className === 'survivor') {
							for(c=0; c<headers.length; c++){
								headers[c].classList.add('survivor');
								headers[c].classList.remove('killer');
								headers[c].classList.remove('hidden');

							}
						} else if (this.className === 'killer') {
							for(c=0; c<headers.length; c++){
								headers[c].classList.remove('hidden');
								if (c === 0){
									headers[c].classList.add('hidden');
								}
								headers[c].classList.add('killer');
								headers[c].classList.remove('survivor');
							}
						} else {throw "Error this isnt a killer nor survivor"}
					});

					if (NameArray[i].charType === 'Survivor') {
						listItem.className = 'survivor';
						document.getElementById('surv').appendChild(listItem);
					} else if (NameArray[i].charType === 'Killer') {
						listItem.className = 'killer';
						document.getElementById('kill').appendChild(listItem);
					} else {
						throw "Error " + NameArray[i] + " Not Recognized"
					}
				}
			}

			//image generation
			function genImage(name, quantity, rarity, killer) {
				imageArray = <?php echo json_encode($dbdImages)?>;

				group = document.createElement("div");
				manip = document.createElement("div");
				images = document.createElement("div");

				overlay = document.createElement("img");
				colorblock = document.createElement("div");
				underlay = document.createElement("img");

				quant = document.createElement("label");
				addQ = document.createElement("button");
				subQ = document.createElement("button");
				
				//find and set image
				overlay.src = "/Gallery/Daylight/"+ killer + '/dbd_'+ name.toString().replace(/ +/g, "")+'.png';

				images.className = 'images';
				overlay.className = 'icon overlay';
				overlay.alt = name;
				colorblock.className = 'icon colour';
				underlay.src = "/Gallery/Daylight/dbd_Z_Addon_Ph.png";
				underlay.className = 'icon underlay';

				//set rarity color
				if (rarity === 'Brown') {colorblock.style.background = '#382d12';}
				else if (rarity === 'Yellow') {colorblock.style.background = '#edce00';}
				else if (rarity === 'Green') {colorblock.style.background = '#25850d';}
				else if (rarity === 'Purple') {colorblock.style.background = '#650d85';}
				else if (rarity === 'Iridescent') {colorblock.style.background = '#de0950';}
				else if (rarity === 'Event') {colorblock.style.background = '#ffbc1f';}
				else {throw "rarity not recognized " + rarity}



				group.className = 'itemGroup';
				manip.className = 'baby';

				quant.className = 'quantity';
				quant.innerHTML = quantity

				addQ.className = 'plusNum';
				addQ.innerHTML = '+';
				addQ.onclick = function () {
					content = this.parentNode.childNodes;
					value = content[1].innerHTML;
					value++;
					content[1].innerHTML = value;
				};

				subQ.className = 'subNum';
				subQ.innerHTML = '-';
				subQ.onclick = function () {
					content = this.parentNode.childNodes;
					value = content[1].innerHTML;
					if (value != 0){value--;}
					content[1].innerHTML = value;
				};
				
				group.appendChild(images);
				group.appendChild(manip);

				images.appendChild(underlay);
				images.appendChild(colorblock);
				images.appendChild(overlay);

				manip.appendChild(addQ);
				manip.appendChild(quant);
				manip.appendChild(subQ);

				return group;
			}
			//generate survivor items
			function gen_items(charKey) {
				index = 0;
				charIdentity = document.getElementById(charKey).parentNode.id;
				ItemArray = [
					['Flashlight', 'Yellow'],['Sports Flashlight', 'Green'],['Utility Flashlight', 'Purple'],["Will O' Wisp", 'Event'],
					['Broken Key', 'Green'],['Dull Key', 'Purple'],['Skeleton Key', 'Iridescent'],
					['Map', 'Green'], ['Rainbow Map', 'Iridescent'],
					['Camping Aid Kit', 'Brown'], ['First Aid Kit', 'Yellow'], ['Emergency Med-Kit', 'Green'], ['Ranger Med-Kit', 'Purple'], ["All Hallows' Eve Lunchbox", 'Event'],
					['Worn-Out Tools', 'Brown'], ['Toolbox', 'Yellow'], ['Commodious Toolbox', 'Green'], ["Mechanic's Toolbox", 'Green'], ["Alex's Toolbox", 'Purple'], ["Engineer's Toolbox", 'Purple']
				];
				
				if (charIdentity === 'surv') {
					//save data
					for (i=0; i < save_Data.length; i++) {
						if (save_Data[i][0] === charKey) {
							item_Data = save_Data[i][1].split(" ");
						}
					}

					//image generation for survivor items
					ItemArray.forEach(x => {
						document.getElementById('S_Items').appendChild(genImage(x[0], item_Data[index], ItemArray[index][1], 'Survivors'));
						index++;
					});
				}
			}
			//generate addons
			function gen_addons(charKey) {
				index = 0;
				AddonArray = <?php echo json_encode($dbdAddon)?>;
				charIdentity = document.getElementById(charKey).parentNode.id;
				charName = charKey.split(" ");

				for (i=0; i < save_Data.length; i++) {
					if (save_Data[i][0] === charKey) {
						addon_Data = save_Data[i][2].split(" ");
					}
				}

				if (charIdentity === 'surv') {
					AddonArray.forEach(x => {
						if (x.aoLimit === 'Flashlight' || x.aoLimit === 'Key' || x.aoLimit === 'Map' || x.aoLimit === 'Med-Kit' || x.aoLimit === 'Toolbox') {
							document.getElementById('item_add').appendChild(genImage(x.aoName, addon_Data[index], x.aoRarity, 'Add-Ons'));
							index++;
						}
					});
				} else if (charIdentity === 'kill') {
					AddonArray.forEach(x => {
						if (x.aoLimit === charName[1]) {
							document.getElementById('item_add').appendChild(genImage(x.aoName, addon_Data[index], x.aoRarity, x.aoLimit));
							index++;
						}
					});
				} else {
					throw "Error " + charIdentity + " Not Recognized"
				}
			}
			//generate offerings
			function gen_offerings(charKey) {
				index = 0;
				OfferArray = <?php echo json_encode($dbdOffering)?>;
				charIdentity = document.getElementById(charKey).parentNode.id;

				for (i=0; i < save_Data.length; i++) {
					if (save_Data[i][0] === charKey) {
						offering_Data = save_Data[i][3].split(" ");
					}
				}

				if (charIdentity === 'surv') {
					OfferArray.forEach(x => {
						if (x.offerLimit === 'Survivor' || x.offerLimit === 'Any') {
							document.getElementById('item_offer').appendChild(genImage(x.offerName, offering_Data[index], x.offerRarity, 'Offerings'));
						}
					});
				} else if (charIdentity === 'kill') {
					OfferArray.forEach(x => {
						if (x.offerLimit === 'Killer' || x.offerLimit === 'Any') {
							document.getElementById('item_offer').appendChild(genImage(x.offerName, offering_Data[index], x.offerRarity, 'Offerings'));
						}
					});
				} else {
					throw "Error " + charIdentity + " Not Recognized"
				}
			}
			//clears groups of elements
			function clear_char() {
				item = document.getElementById('S_Items');
				addon = document.getElementById('item_add');
				offering = document.getElementById('item_offer');

				while (item.firstChild) {
					item.removeChild(item.lastChild);
				}

				while (addon.firstChild) {
					addon.removeChild(addon.lastChild);
				}

				while (offering.firstChild) {
					offering.removeChild(offering.lastChild);
				}
			}
		</script>
	</body>
</html>