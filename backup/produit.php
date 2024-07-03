<?php 
require_once('Connections/connexion.php');

$query_DatosConsulta = sprintf("SELECT * FROM menu");
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gazpacho </title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Frijole&display=swap" rel="stylesheet">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
<div class="mobile">
        <div class="header__mobile">
            <h2 class="title-mobile">Bienvenue au Gazpacho</h2>
            <p class="text__mobile">Des menus nouveau chaque jour,<br> avec la posibilité de commander</p>
        </div>
        <div class="menu__mobile2">
            <h2 class="nav__mobile-title">Nos produits</h2>

            <?php include ("includes/card5.php");?>
        
            <div class="blank-image"></div>
        
    
    
    <div class="nav__mobile">
        <ul>
            <a href="/"><li>
                <i class="fas fa-home"></i>
                <p>Accueil</p>
            </li></a>
            <a href="produit.php"><li class="selected">
                <i class="fas fa-utensils"></i>
                <p>Produits</p>
            </li></a>
            <a href="contact.php"><li>
                <i class="fas fa-user"></i>
                <p>Contact</p>
            </li></a>
            <a href="maps.php"><li>
            <i class="fas fa-image"></i>
                <p>Photos</p>
            </li></a>
        </ul>
    </div>
    </div>

    <!-- loader  
<div class="loader-container">
    <img src="images/loader.gif" alt="">
</div>-->

    <!-- custom js file link  -->
    <script src="script.js"></script>
    <script src="animate.js"></script>
    <script src="form.js"></script>
   

</body>

</html>