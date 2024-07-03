<?php

require_once('../Connections/connexion.php');

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_description = $_POST['p_description'];
   $p_cat = $_POST['p_cat'];
   

   $insert = "INSERT INTO dblCarte (title, price, parr, cat) VALUES('$p_name', '$p_price', '$p_description','$p_cat')";
       $upload = mysqli_query($con,$insert);

   if($insert){
      
      $message[] = 'produit ajouter correctement';
   }else{
      $message[] = "le produit n'a pas pu être ajouter";
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($con, "DELETE FROM dblCarte WHERE idCarte = $delete_id");
   if($delete_query){
      header('location:admin.php');
      $message[] = 'produit eliminer correctement';
   }else{
      header('location:admin.php');
      $message[] = "le produit n'a pas pu être eliminer";
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_parr = $_POST['update_p_parr'];
   $update_p_cat = $_POST['update_p_cat'];

   $update_query = mysqli_query($con, "UPDATE dblCarte SET title='$update_p_name', price='$update_p_price', parr='$update_p_parr', cat='$update_p_cat' WHERE idCarte = $update_p_id");
   
   if($update_query){
      $message[] = 'produit inserer correctement';
      header('location:admin.php');
   }else{
      $message[] = "le produit n'a pas pu être inserer";
      header('location:admin.php');
   }

}

$query_DatosConsulta2 = sprintf("SELECT * FROM dblCarte");
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
         <a href="admin.php">ajouter produit</a>
         <a href="admin_page.php">menu</a>
      </nav>


      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>

<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>ajouter un nouveau produit</h3>
   <input type="text" name="p_name" placeholder="entre le nom" class="box" required>
   <input type="number" name="p_price" min="0" step="0.01" placeholder="entre le prix" class="box" required>
   <input type="text" name="p_description" placeholder="entre la description" class="box">
   <select name="p_cat" id="" class="box">
      <option value="1">Petit dejeuner</option>
      <option value="2">autre plat</option>
      <option value="3">menu enfant</option>
      <option value="4">dessert</option>
      
   </select>
   <input type="submit" value="ajouter produit" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         
         <th>nom du produit</th>
         <th>prix du produit</th>
         <th>description du produit</th>
         <th>categorie</th>
         <th>action</th>
      </thead>

      <tbody>
      <?php if ($totalRows_DatosConsulta2 > 0) {  
    do { 
             ?>

         <tr>
           
            <td><?php echo $row_DatosConsulta2["title"]; ?></td>
            <td>€<?php echo $row_DatosConsulta2['price']; ?></td>
            <td><?php echo $row_DatosConsulta2['parr']; ?></td>
            <td><?php if ($row_DatosConsulta2['cat']==1){
               echo "Petit Dejeuner";
            }else if($row_DatosConsulta2['cat']==2){
               echo "Autre plat";
            }else if($row_DatosConsulta2['cat']==3){
               echo "Menu Enfant";
            }else if($row_DatosConsulta2['cat']==4){
               echo "Dessert";
            }; ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row_DatosConsulta2['idCarte']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> effacer </a>
               <a href="admin.php?edit=<?php echo $row_DatosConsulta2['idCarte']; ?>" class="option-btn"> <i class="fas fa-edit"></i> modifier </a>
            </td>
         </tr>

         <?php
            }while ($row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2));     
            }else{
               echo "<div class='empty'>aucun produit ajouter</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($con, "SELECT * FROM `dblCarte` WHERE idCarte = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['idCarte']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['title']; ?>">
      <input type="number" min="0" class="box" step="0.01" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="text" class="box"  name="update_p_parr" value="<?php echo $fetch_edit['parr']; ?>">
      <select name="update_p_cat" id="" class="box">
      <option value="1" <?php if($fetch_edit['cat']==1) echo "selected";?>>Petit dejeuner</option>
      <option value="2" <?php if($fetch_edit['cat']==2) echo "selected";?>>autre plat</option>
      <option value="3" <?php if($fetch_edit['cat']==3) echo "selected";?>>menu enfant</option>
      <option value="4" <?php if($fetch_edit['cat']==4) echo "selected";?>>dessert</option>
      
   </select>
      
      <input type="submit" value="modifier" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>