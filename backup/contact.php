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

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Frijole&display=swap" rel="stylesheet">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="mobile">
        
        
     <section class="order" id="order">

        <h1 class="heading"> <span>Localisez</span>-nous </h1>

        <div class="row">

            <div class="image">
                <img src="images/order-img.jpg" alt="">
            </div>

            <form action="">

                <div class="inputBox">
                    <h4>Gazpacho</h4>
                    <h4><i class="fas fa-phone-alt"></i> 06 35 83 29 18</h4>
                </div>

                <div class="inputBox">
                    <h4><i class="fas fa-map-marker-alt"></i>Vente Ambulante </h4>
                    <h4>66000 Perpignan</h4>
                </div>

            </form>
            <div class="order__mobile">
            
            <a href="tel:+33601268013"><i class="fas fa-phone"></i>télèphone</a>
            <a href="https://api.whatsapp.com/send?phone=33601268013&text=Bonjour,%20je%20voudrais%20passer%20commande,%20merci"><i class="fab fa-whatsapp"></i>whatsapp</a>
        </div>
        </div>
        <div class="blank-image"></div>
    </section>
    
    <div class="nav__mobile">
        <ul>
            <a href="/"><li>
                <i class="fas fa-home"></i>
                <p>Accueil</p>
            </li></a>
            <a href="produit.php"><li>
                <i class="fas fa-utensils"></i>
                <p>Produits</p>
            </li></a>
            <a href="contact.php"><li class="selected">
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

   

    
    <!-- custom js file link  -->
    <script src="script.js"></script>
    <script src="animate.js"></script>
    <script src="form.js"></script>
   

</body>

</html>