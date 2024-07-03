<?php

require_once('../Connections/connexion.php');


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($con, "DELETE FROM FeedBack WHERE id = $delete_id");
   if($delete_query){
      header('location:comments.php');
      $message[] = 'produit eliminer correctement';
   }else{
      header('location:comments.php');
      $message[] = "le produit n'a pas pu être eliminer";
   };
};


$query_DatosConsulta2 = sprintf("SELECT * FROM FeedBack");
$DatosConsulta2 = mysqli_query($con,  $query_DatosConsulta2) or die(mysqli_error($con));
$row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2);
$totalRows_DatosConsulta2 = mysqli_num_rows($DatosConsulta2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<header class="header">

   <div class="flex">

      <a href="../index.php" class="logo">Gazpacho</a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
      </nav>


      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>

<div class="container">


<section class="display-product-table">

   <table>

      <thead>
         
         <th>Commentaire</th>
         <th>Date</th>
         <th>Action</th>
        
      </thead>

      <tbody>
      <?php if ($totalRows_DatosConsulta2 > 0) {  
    do { 
             ?>

         <tr>
           
            
            <td class="td"><?php echo $row_DatosConsulta2['strComment']; ?></td>
            <td class="td"><?php echo $row_DatosConsulta2['date']; ?></td>
            
            <td>
            
               <a href="comments.php?delete=<?php echo $row_DatosConsulta2['id']; ?>" class="delete-btn" onclick="return confirm(`Tu es sûr d'éffacer le message?`);"> <i class="fas fa-trash"></i> effacer </a>
               
            </td>
         </tr>

         <?php
            }while ($row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2));     
            }else{
               echo "<div class='empty'>aucun commentaire</div>";
            };
         ?>
      </tbody>
   </table>

</section>



</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>