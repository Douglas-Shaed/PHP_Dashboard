<?php 
    $mydir = "/Coding/Projects/Dashboard/Gallery/Images/Mine";
    $galImages = scandir($mydir);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/Templates/CSS/Design.css">
        <link rel="stylesheet" href="/Templates/CSS/GalleryDesign.css">
        <title>Gallery</title>
    </head>
    <body>
        <?php include '/Coding/Projects/Dashboard/Templates/Header.php' ?>
        <div class="display"></div>

        <script>
            //Generate Gallery
            var imageArray = <?php echo json_encode($galImages) ?>;
            var imageDesc = ["Test", "Error"];
            const imgList = document.querySelector(".display");

            for(var i = 2; i < imageArray.length; i++) {
                imageDesc[i] = imageArray[i].slice(0,-4);
            }
            
            let imgElements = "";

            for(var i = 2; i < imageArray.length; i++){
                if(imageArray[i] != 'Gallery.php') {
                    imgElements += `<div class="gallery"><img src="/Gallery/Images/Mine/${imageArray[i]}" onclick="zoomIn(this.id)" id="img${i}"><div class="desc"><p>${imageDesc[i]}</p></div></div>`;
                }
            }

            imgList.innerHTML = imgElements;

            function zoomIn(imgId) {
                img = document.getElementById(imgId);
                img.style.transform = "scale(1.5)";
                img.style.transition = "transform 0.25s ease";
                img.onclick = function () {zoomOut(imgId);};
            }

            function zoomOut(imgId) {
                img = document.getElementById(imgId);
                img.style.transform = "scale(1)";
                img.style.transition = "transform 0.25s ease";
                img.onclick = function () {zoomIn(imgId);};
            }
        </script>
        
        <?php include '/Coding/Projects/Dashboard/Templates/Footer.php' ?>
    </body>
</html>