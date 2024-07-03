<?php 
//ini_set('display_errors', '1'); 
require_once('Connections/connexion.php');

$query_DatosConsulta = sprintf("SELECT * FROM menu");
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $respuestaUsusario = $_POST["respuesta"];

    
    $msg = $_POST['comment'];
    $mensaje = "Le commentaire que vous allez envoyer est: \n " . $_POST['comment'];
    
  if($respuestaUsusario == "pin"){
        $insert = "INSERT INTO FeedBack (strComment) VALUES('$msg')";
    $upload = mysqli_query($con,$insert);
    }else{
        $message[]="La reponse est incorrect!!";
    }
    
  }
  
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
    <!-- favicon links web and device mobil -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

</head>

<body>


    <!-- header section starts  -->
    <div class="laptop">
        <header>

            <a href="#" class="logo"><img src="images/logo_new.svg" alt=""></a>

            <div id="menu-bar" class="fas fa-bars"></div>

            <nav class="navbar">
                <a href="#home">Accueil</a>
                <a href="#speciality">menu</a>
                <a href="#popular">carte</a>
                <a href="#gallery">gallerie</a>
                <a href="#order">localiser</a>
                <a href="tel:+33635832918">commander</a>
            </nav>

            <!-- <div class="icons">
        <!-- <div id="menu-btn" class="fas fa-bars"></div>
        <div id="user-btn" class="fas fa-user"></div>
        <div id="order-btn" class="fas fa-box"></div> 
        <div id="cart-btn" class="fas fa-shopping-cart" ><span></span></div> 
     </div>-->

        </header>

        <?php 
        if(isset($message)){
            foreach ($message as $message){
                echo $message;
            }

        }
        ?>

        <!-- header section ends -->
        <!--<div class="user-account">

    <section>
 
       <div id="close-account"><span>close</span></div>
 
       <div class="user">
          <p><span>vous n'êtes pas inscrits!</span></p>
       </div>
 
       <div class="display-orders">
          <p>pizza-1 <span>( $3/- x 2 )</span></p>
          <p>pizza 03 <span>( $2/- x 1 )</span></p>
          <p>pizza 06 <span>( $4/- x 4 )</span></p>
          <p>pizza 07 <span>( $2/- x 1 )</span></p>
       </div>
 
       <div class="flex">
 
          <form action="" method="post">
             <h3>login now</h3>
             <input type="email" name="email" required class="box" placeholder="enter your email" maxlength="50">
             <input type="password" name="pass" required class="box" placeholder="enter your password" maxlength="20">
             <input type="submit" value="login now" name="login" class="btn">
          </form>
 
          <form action="" method="post">
             <h3>register now</h3>
             <input type="text" name="name" required class="box" placeholder="enter your name" maxlength="20">
             <input type="email" name="email" required class="box" placeholder="enter your email" maxlength="50">
             <input type="password" name="pass" required class="box" placeholder="enter your password" maxlength="20">
             <input type="password" name="cpass" required class="box" placeholder="confirm your password" maxlength="20">
             <input type="submit" value="register now" name="register" class="btn">
          </form>
 
       </div>
 
    </section>
 
 </div>
 
 <div class="my-orders">
 
    <section>
 
       <div id="close-orders"><span>close</span></div>
 
       <h3 class="title"> my orders </h3>
 
       <div class="box">
          <p>placed on : <span>06/04/2022</span> </p>
          <p>name : <span>shaikh anas</span> </p>
          <p>number : <span>1234567890</span></p>
          <p>address : <span>flat no. 123, bulding no. 2, jogeshwari, mumbai, india - 400104</span></p>
          <p>payment method : <span>cash on delivery</span></p>
          <p>your orders : <span>pizza 01 $3/- x 2, pizza 03 $2/- x 1, pizza 06 $4/- x 4, pizza 07, $2/- x 1</span></p>
          <p>total price : <span>$11/-</span></p>
          <p>payment status : <span style="color: var(--red);">pending</span> </p>
       </div>
 
       <div class="box">
          <p>placed on : <span>06/04/2022</span> </p>
          <p>name : <span>shaikh anas</span> </p>
          <p>number : <span>1234567890</span></p>
          <p>address : <span>flat no. 123, bulding no. 2, jogeshwari, mumbai, india - 400104</span></p>
          <p>payment method : <span>cash on delivery</span></p>
          <p>your orders : <span>pizza 01 $3/- x 2, pizza 03 $2/- x 1, pizza 06 $4/- x 4, pizza 07, $2/- x 1</span></p>
          <p>total price : <span>$11/-</span></p>
          <p>payment status : <span style="color: var(--red);">pending</span> </p>
       </div>
 
    </section>
 
 </div>-->

        <!-- <div class="shopping-cart">

            <section>

                <div id="close-cart"><span>fermer</span></div>

                <div class="box">
                    <a href="#" class="fas fa-times"></a>
                    <img src="images/ensalada.jpg" alt="">
                    <div class="content">
                        <div id="result">Vide</div>
                        <div id="result2"></div>
                        <div id="result3"></div>
                        <form action="" method="post">
                            <input type="number" class="qty" name="qty" min="1" value="1" max="100">
                            <button type="submit" class="fas fa-edit" name="update_qty"></button>
                        </form>
                    </div>
                </div>

                <div class="box">
                    <a href="#" class="fas fa-times"></a>
                    <img src="images/plato.jpg" alt="">
                    <div class="content">
                        <div id="result4">Vide</div>
                        <div id="result5"></div>
                        <div id="result6"></div>
                        <form action="" method="post">
                            <input type="number" class="qty" name="qty" min="1" value="1" max="100">
                            <button type="submit" class="fas fa-edit" name="update_qty"></button>
                        </form>
                    </div>
                </div>

                <div class="box">
                    <a href="#" class="fas fa-times"></a>
                    <img src="images/postre.jpg" alt="">
                    <div class="content">
                        <div id="result7">Vide</div>
                        <div id="result8"></div>
                        <div id="result9"></div>
                        <form action="" method="post">
                            <input type="number" class="qty" name="qty" min="1" value="1" max="100">
                            <button type="submit" class="fas fa-edit" name="update_qty"></button>
                        </form>
                    </div>
                </div>

                <a href="#order" class="btn">commander</a>

            </section>

        </div> -->
        <!--home section starts  -->
  
        <section class="home" id="home">
            <div class="home__static">Bienvenue au Gazpacho!</div>

            <div>
                <div class="home__cursor cursor--1 block">
                    <div class="home__cursor-text">Menú du jour au choix</div>
                </div>
                <div class="home__cursor cursor--2">
                    <div class="home__cursor-text">Commander par téléphone</div>
                </div>
                <div class="home__cursor cursor--3">
                    <div class="home__cursor-text">Plats international</div>
                </div>
                <div class="home__cursor cursor--4">
                    <div class="home__cursor-text">Des nouveaux plat chaque semaine</div>
                </div>
            </div>

        </section>

        <!-- home section ends -->

        <!-- speciality section starts  -->

        <section class="speciality" id="speciality">
            <h1>Menu du Jour</h1>
            <p>(Composez votre menu, en choisissant une option de chaque partie)</p>
            <form action="" id="form_order" name="form_menu">
                <div class="container">

                    <div class="card">
                        <div class="content">
                            <h2>1º plats</h2>
                            <input type="checkbox" name="title" id="title">
                            <label for="title" class="title__label"><?php if ($row_DatosConsulta["titulo1_1"] != "")
                            {
                                echo $row_DatosConsulta["titulo1_1"]?> |
                                €<?php echo number_format($row_DatosConsulta["price1_1"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product1_1"]?></p>
                        

                            <input type="checkbox" name="title" id="title1">
                            <label for="title1" class="title__label1"><?php if ($row_DatosConsulta["titulo1_2"] != "")
                            {
                                echo $row_DatosConsulta["titulo1_2"]?> |
                                €<?php echo number_format($row_DatosConsulta["price1_2"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product1_2"]?></p>

                            <input type="checkbox" name="title" id="title2">
                            <label for="title2" class="title__label2"><?php if ($row_DatosConsulta["titulo1_3"] != "")
                            {
                            echo $row_DatosConsulta["titulo1_3"]?> |
                                €<?php echo number_format($row_DatosConsulta["price1_3"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product1_3"]?></p>

                            <input type="text" name="" id="pr" value="<?php echo $row_DatosConsulta["titulo1_1"]?>">
                            <input type="text" name="" id="pr1" value="<?php echo $row_DatosConsulta["titulo1_2"]?>">
                            <input type="text" name="" id="pr2" value="<?php echo $row_DatosConsulta["titulo1_3"]?>">

                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <h2>2º plats</h2>
                            <input type="checkbox" name="title" id="title3">
                            <label for="title3" class="title__label3"><?php if ($row_DatosConsulta["titulo2_1"] != "")
                            {
                                echo $row_DatosConsulta["titulo2_1"]?> |
                                €<?php echo number_format($row_DatosConsulta["price2_1"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product2_1"]?></p>

                            <input type="checkbox" name="title" id="title4">
                            <label for="title4" class="title__label4"><?php if ($row_DatosConsulta["titulo2_2"] != ""){
                            echo $row_DatosConsulta["titulo2_2"]?> |
                                €<?php echo number_format($row_DatosConsulta["price2_2"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product2_2"]?></p>

                            <input type="checkbox" name="title2" id="title5">
                            <label for="title5" class="title__label5"><?php  if ($row_DatosConsulta["titulo2_3"] != "") {
                                echo $row_DatosConsulta["titulo2_3"]?> |
                                €<?php echo number_format($row_DatosConsulta["price2_3"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product2_3"]?></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <h2>dessert</h2>
                            <input type="checkbox" name="title" id="title6">
                            <label for="title6" class="title__label6"><?php if ($row_DatosConsulta["titulo3_1"] != "") {
                                echo $row_DatosConsulta["titulo3_1"]?> |
                                €<?php echo number_format($row_DatosConsulta["price3_1"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product3_1"]?></p>

                            <input type="checkbox" name="title" id="title7">
                            <label for="title7" class="title__label7"><?php if ($row_DatosConsulta["titulo3_2"] != "") {
                                echo $row_DatosConsulta["titulo3_2"]?> |
                                €<?php echo number_format($row_DatosConsulta["price3_2"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product3_2"]?></p>

                            <input type="checkbox" name="title" id="title8">
                            <label for="title8" class="title__label8"><?php if ($row_DatosConsulta["titulo3_3"] != "") {
                                echo $row_DatosConsulta["titulo3_3"]?> |
                                €<?php echo number_format($row_DatosConsulta["price3_3"],2,",","");}?></label>
                            <p><?php echo $row_DatosConsulta["product3_3"]?></p>
                        </div>
                    </div>
            </form>
    </div>
    <div class="container-info">prix net | service compri | boisson incluse</div>
    <!-- <button class="btn__command" id="command-btn">Passer Commande</button> -->
    </section>

    <!-- speciality section ends -->

    <!-- popular section starts  -->

    <section class="popular" id="popular">
        <h1 class="heading"> <span>Notre </span>Carte </h1>
        <div class="popular__row-container">
            <div class="popular__row">

                <div class="popular__card">
                    <div class="card-content">
                        <h2>petit dejeuner</h2>
                        <?php include ("includes/card4.php");?>

                        <!--<div class="card-content_price">
                            <ul>
                                <li>Churros</li>
                                <li>€1,50</li>
                            </ul>
                        </div>
                         <div class="card-content_price">
                            <ul>
                                <div class="card-content_price-option">
                                    <li>Tostes</li>
                                    <p>(jambón serrano, Rillettes,Beurre, Sobresade...)</p>
                                </div>

                                <li>€3,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>croissants</li>
                                <li>€2,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Pain au chocolat</li>
                                <li>€2,50</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Pastéis de nata</li>
                                <li>€1,50</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Pingo</li>
                                <li>€2,00</li>
                            </ul>
                        </div> -->
                    </div>
                </div>

                <div class="popular__card">
                    <div class="card-content">
                        <h2>autre plats</h2>
                        <?php include ("includes/card1.php");?>
                        <!-- <div class="card-content_price">
                            <ul>
                                <li>Tacos Mexicain</li>
                                <li>€5,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Tortilla avec salade</li>
                                <li>€6,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Calamars à la Romaine</li>
                                <li>€6,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Croquettes (jambon, poulet)<br>et frites à la brava</li>
                                <li>€7,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Cheddar bites avec frites</li>
                                <li>€6,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Fingers poulet (sans gluten)<br>avec frites</li>
                                <li>€5,00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Crunchy poulet<br>avec frites</li>
                                <li>€5,00</li>
                            </ul>
                        </div>-->
                    </div>
                </div>

                <div class="popular__card">
                    <div class="card-content">
                        <h2>plats enfant</h2>
                        <?php include ("includes/card2.php");?>
                        <!-- <div class="card-content_price">
                            <ul>
                                <li>Lettres en frites</li>
                                <li>€3.00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Nuggets de poulet</li>
                                <li>€4.00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Cordon bleu espagnol</li>
                                <li>€3.00</li>
                            </ul>
                        </div>  -->
                    </div>
                </div>


                <div class="popular__card">
                    <div class="card-content">
                        <h2>dessert</h2>
                        <?php include ("includes/card3.php");?>
                        <!-- <div class="card-content_price">
                            <ul>
                                <li>pastéis de nata</li>
                                <li>€1.50</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Bras de venus</li>
                                <li>€3.00</li>
                            </ul>
                        </div>
                        <div class="card-content_price">
                            <ul>
                                <li>Banane Flambée</li>
                                <li>€4.00</li>
                            </ul>
                        </div> 
                    </div>-->
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- gallery section starts  -->

    <section class="gallery" id="gallery">
        <h1 class="heading"> <span>Notre </span>gallerie </h1>
        <div class="notif">(En vue de notre rotation, ces plats ne sont pas dans le menu)</div>
        <div class="gallery__container">
            <div class="container-file">
                <div class="container-file-1-3">
                    <div class="container-file-small">
                        <img src="images/g-3.jpg" alt="">
                    </div>
                    <div class="container-file-small">
                        <img src="images/1.png" alt="">
                    </div>
                </div>
                <div class="container-file-2-3">
                    <div class="container-file-normal">
                        <img src="images/L1.png" alt="">
                    </div>
                </div>
            </div>
            <div class="container-file">
                <div class="container-file-2-3">
                    <div class="container-file">
                        <div class="container-column-50">
                            <div class="container-file-large">
                                <img src="images/f2.png" alt="">
                            </div>
                        </div>
                        <div class="container-column-50">
                            <div class="container-file-small">
                                <img src="images/2.png" alt="">
                            </div>
                            <div class="container-file-small">
                                <img src="images/3.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="container-file-normal">
                        <img src="images/L2.png" alt="">
                    </div>
                </div>
                <div class="container-file-1-3">
                    <div class="container-file-small">
                        <img src="images/4.png" alt="">
                    </div>
                    <div class="container-file-large">
                        <img src="images/f3.png" alt="">
                    </div>
                    <div class="container-file-small">
                        <img src="images/5.png" alt="">
                    </div>
                </div>
            </div>

    </section>

    <!-- gallery section ends -->

    <!-- review section starts  -->

    <section class="review" id="review">


    </section>

    <!-- review section ends -->

    <!-- order section starts  -->

    <section class="order" id="order">

        <h1 class="heading"> <span>Aidez</span>-nous </h1>

        <div class="row">
        
        <form action="" method="post">
            
            <div class="inputBox">
                <h4>FeedBack</h4>
                <p>Aidez-nous á nous ameliorer, en nous laissans un commentaire, ou bien une suggestion, pour des futurs plats que vous aimeriez retrouver, ou bien pour ameliorer notre service. Les commentaires seront anonymes, et serviront simplement pour nous aider á ameliorer. Vous pourrez ainsi contribuez á que notre service soit de plus en plus perfectionner, et ainsi permettre de créer de nouveaux plats pour satisfaire la demande de notre clientèle. Merci une fois de plus. </p>
                <label class="label" for="">Description:</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" required></textarea>
                    <div class="inputBox2">
                    <label for="respuesta">Lequel n'est pas une couleur: Blue, rouge, pin ou rose</label>
                    <input type="text" id="respuesta" name="respuesta" class="inputResponse">
                    </div>
               
                    <input type="submit" name="add_product" class="btn" value="Envoyer" onclick="alert('Merci pour votre message')">
            </div>
        </form>
        



            <div class="image">
                <img src="images/feedback.png" alt="">
            </div>
        </div>

    </section>
    
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
                    <h4><i class="fas fa-map-marker-alt"></i> Vente ambulante </h4>
                    <h4>66000 Perpignan</h4>
                </div>

                



            </form>

        </div>

    </section>

    <!-- order section ends -->

    <!-- footer section  -->
    <section class="prefooter">
        <div></div>
    </section>
    <section class="footer" id="footer">

        <div class="share">
            <a href="#" class="btn2">facebook</a>
            <a href="#" class="btn2">instagram</a>
            <a href="https://api.whatsapp.com/send?phone=33635832918&text=Bonjour,%20je%20voudrais%20passer%20commande,%20merci"
                class="whatsapp"><i class="fab fa-whatsapp"></i></a>
        </div>


        <h1 class="credit"> created by <span> skyditec </span> | all rights reserved! </h1>

    </section>
    </div>

    <!-- section mobile -->
    <div class="mobile">
        <div class="header__mobile">
            <h2 class="title-mobile">Bienvenue au Gazpacho</h2>
            <p class="text__mobile">Des menus nouveau chaque jour,<br> avec la posibilité de commander</p>
        </div>
        <div class="menu__mobile">
            <h2 class="nav__mobile-title">Menu du jour</h2>

            <div class="menu__mobile-section">
                <img src="images/ensalada.jpg" alt="">
                <div class="ref">1 plat</div>
                <ul class="text-menu">
                    <li><?php echo $row_DatosConsulta["titulo1_1"]?> |
                        €<?php echo number_format($row_DatosConsulta["price1_1"],2,",","");?>
                        <p><?php echo $row_DatosConsulta["product1_1"]?></p>
                    </li>
                    <li><?php echo $row_DatosConsulta["titulo1_2"]?> |
                        €<?php echo number_format($row_DatosConsulta["price1_2"],2,",","")?>
                        <p><?php echo $row_DatosConsulta["product1_2"]?></p>
                    </li>

                    <li><?php echo $row_DatosConsulta["titulo1_3"]?> |
                        €<?php echo number_format($row_DatosConsulta["price1_3"],2,",","")?>
                        <p><?php echo $row_DatosConsulta["product1_3"]?></p>
                    </li>
                </ul>
            </div>
        
        <div class="menu__mobile-section">
            <img src="images/plato.jpg" alt="">
            <div class="ref">2 plat</div>
            <ul class="text-menu">
                <li><?php echo $row_DatosConsulta["titulo2_1"]?> |
                €<?php echo number_format($row_DatosConsulta["price2_1"],2,",","");?>
                <p><?php echo $row_DatosConsulta["product2_1"]?></p>
            </li>
            <li><?php echo $row_DatosConsulta["titulo2_2"]?> |
            €<?php echo number_format($row_DatosConsulta["price2_2"],2,",","")?>
            <p><?php echo $row_DatosConsulta["product2_2"]?></p>
        </li>
        
        <li><?php echo $row_DatosConsulta["titulo2_3"]?> |
        €<?php echo number_format($row_DatosConsulta["price2_3"],2,",","")?>
        <p><?php echo $row_DatosConsulta["product2_3"]?></p>
    </li>
</ul>
</div>


<div class="menu__mobile-section">
    
    <img src="images/postre.jpg" alt="">
    <div class="ref">Dessert</div>
        <ul class="text-menu">
            <li><?php echo $row_DatosConsulta["titulo3_1"]?> |
                €<?php echo number_format($row_DatosConsulta["price3_1"],2,",","");?>
                <p><?php echo $row_DatosConsulta["product3_1"]?></p>
            </li>
            <li><?php echo $row_DatosConsulta["titulo3_2"]?> |
                €<?php echo number_format($row_DatosConsulta["price3_2"],2,",","")?>
                <p><?php echo $row_DatosConsulta["product3_2"]?></p>
            </li>

            <li><?php echo $row_DatosConsulta["titulo3_3"]?> |
                €<?php echo number_format($row_DatosConsulta["price3_3"],2,",","")?>
                <p><?php echo $row_DatosConsulta["product3_3"]?></p>
            </li>
        </ul>
    </div>
    </div>

    
    
    <div class="nav__mobile">
        <ul>
            <a href="/"><li class="selected">
                <i class="fas fa-home"></i>
                <p>Accueil</p>
            </li></a>
            <a href="produit.php"><li >
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
    <section class="cookies">

        <h3 class="cookies__titulo">Pour améliorer votre expérience de navigation, nous utilisons des cookies de
            navigation.</h3>
        <p class="cookies__texto">Nous utilisons des cookies de navigation dans notre site, avec le but d'ameliorer
            votre expérience de navigation. Si accepter de continuez, les cookies utilisé seront eclusivement des
            cookies de navigation. Si vous souhaitez désactiver ces cookies vous voudrez vous rendre dans les paramétres
            de votre navigateur et les désactiver. Pour plus de renseignement, veuillez visiter notre <a
                href="cookies.html">politique de confidentialité</a>. </p>
        <div class="cookies__botones">
            <!-- Botón de negación -->
            <button class="cookies__boton-rojo cookies__boton--no">Refuser</button>
            <!-- Botón de afirmación -->
            <button class="cookies__boton-vert cookies__boton--si">Accepter</button>
        </div>
    </section>
    <!-- scroll top button  -->
    <a href="#home" class="fas fa-angle-up laptop" id="scroll-top"></a>

    <!-- loader  
<div class="loader-container">
    <img src="images/loader.gif" alt="">
</div>-->

    <!-- custom js file link  -->
    <script src="script.js"></script>
    <script src="animate.js"></script>
    <!-- <script src="form.js"></script> -->


</body>

</html>
