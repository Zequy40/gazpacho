<?php
//ini_set('display_errors', '1'); 

require_once('../Connections/connexion.php');
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {

  $updateSQL = sprintf("UPDATE menu SET titulo1_1=%s, price1_1=%s, product1_1=%s, titulo1_2=%s, price1_2=%s, product1_2=%s, titulo1_3=%s, price1_3=%s, product1_3=%s, titulo2_1=%s, price2_1=%s, product2_1=%s, titulo2_2=%s, price2_2=%s, product2_2=%s, titulo2_3=%s, price2_3=%s, product2_3=%s, titulo3_1=%s, price3_1=%s, product3_1=%s,titulo3_2=%s, price3_2=%s, product3_2=%s,titulo3_3=%s, price3_3=%s, product3_3=%s  WHERE id=1",
                       GetSQLValueString($_POST["titulo1_1"], "text"),
					   GetSQLValueString($_POST["price1_1"], "text"),
					   GetSQLValueString($_POST["product1_1"], "text"),
					   GetSQLValueString($_POST["titulo1_2"], "text"),
					   GetSQLValueString($_POST["price1_2"], "text"),
					   GetSQLValueString($_POST["product1_2"], "text"),
					   GetSQLValueString($_POST["titulo1_3"], "text"),
                       GetSQLValueString($_POST["price1_3"], "text"),
					   GetSQLValueString($_POST["product1_3"], "text"),
					   GetSQLValueString($_POST["titulo2_1"], "text"),
					   GetSQLValueString($_POST["price2_1"], "text"),
					   GetSQLValueString($_POST["product2_1"], "text"),
					   GetSQLValueString($_POST["titulo2_2"], "text"),
					   GetSQLValueString($_POST["price2_2"], "text"),
                       GetSQLValueString($_POST["product2_2"], "text"),
					   GetSQLValueString($_POST["titulo2_3"], "text"),
					   GetSQLValueString($_POST["price2_3"], "text"),
					   GetSQLValueString($_POST["product2_3"], "text"),
					   GetSQLValueString($_POST["titulo3_1"], "text"),
					   GetSQLValueString($_POST["price3_1"], "text"),
					   GetSQLValueString($_POST["product3_1"], "text"),
                       GetSQLValueString($_POST["titulo3_2"], "text"),
					   GetSQLValueString($_POST["price3_2"], "text"),
					   GetSQLValueString($_POST["product3_2"], "text"),
                       GetSQLValueString($_POST["titulo3_3"], "text"),
					   GetSQLValueString($_POST["price3_3"], "text"),
					   GetSQLValueString($_POST["product3_3"], "text"));
		
        //echo $updateSQL;
        $Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
        
        
          $insertGoTo = "admin_page.php";
          if (isset($_SERVER['QUERY_STRING'])) {
            $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
            $insertGoTo .= $_SERVER['QUERY_STRING'];
          }
          header(sprintf("Location: %s", $insertGoTo));
        }

$query_DatosConsulta = sprintf("SELECT * FROM menu");
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);


$user = $_POST['strUser'];
$usuario = $_POST['cUser'];

if ($user == $usuario && ($_POST['cpass'] == $_POST['strPassword']))
{?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <title>Admin</title>
</head>

<body>
   
    <header class="header">
        <h1>Administración</h1>
        <nav><a href="../index.php" class="btn">WEB</a>
        <a href="admin.php" class="btn">ajouter menu</a>
        <a href="comments.php" class="btn">comment -aire</a></nav>
    </header>

    <form action="admin_page.php" id="forminsertar" name="forminsertar" role="form" method="post">
        <div class="card__container">
            <div class="card__section">
                <h2>premier plat</h2>
                <div class="card__section-ind">
                <div class="card">
                    <label class="admin-label" for="">option 1:</label>
                    <input type="text" name="titulo1_1" value="<?php echo $row_DatosConsulta["titulo1_1"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product1_1" id="" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product1_1"]?>"><?php echo $row_DatosConsulta["product1_1"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price1_1" value="<?php echo $row_DatosConsulta["price1_1"]?>">
                </div>
                <div class="card">
                    <label class="admin-label" for="">option 2:</label>
                    <input type="text" name="titulo1_2" value="<?php echo $row_DatosConsulta["titulo1_2"]?>" class="title">
                    <label class="admin-label" for="" >Description:</label>
                    <textarea name="product1_2" id="" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product1_2"]?>"><?php echo $row_DatosConsulta["product1_2"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price1_2" value="<?php echo $row_DatosConsulta["price1_2"]?>">
                </div>
                <div class="card">
                    <label class="admin-label" for="">option 3:</label>
                    <input type="text" name="titulo1_3" value="<?php echo $row_DatosConsulta["titulo1_3"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product1_3" id="product1_3" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product1_3"]?>"><?php echo $row_DatosConsulta["product1_3"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price1_3" value="<?php echo $row_DatosConsulta["price1_3"]?>">
                </div>
            </div>
        </div>

            <div class="card__section">
            <h2>deuxième plat</h2>
            <div class="card__section-ind">
            <div class="card">
                    <label class="admin-label" for="">option 1:</label>
                    <input type="text" name="titulo2_1" value="<?php echo $row_DatosConsulta["titulo2_1"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product2_1" id="product2_1" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product2_1"]?>"><?php echo $row_DatosConsulta["product2_1"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price2_1" value="<?php echo $row_DatosConsulta["price2_1"]?>">
            </div>
            <div class="card">
                    <label class="admin-label" for="">option 2:</label>
                    <input type="text" name="titulo2_2" value="<?php echo $row_DatosConsulta["titulo2_2"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product2_2" id="product2_2" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product2_2"]?>"><?php echo $row_DatosConsulta["product2_2"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price2_2" value="<?php echo $row_DatosConsulta["price2_2"]?>">
            </div>
            <div class="card">
                    <label class="admin-label" for="">option 3:</label>
                    <input type="text" name="titulo2_3" value="<?php echo $row_DatosConsulta["titulo2_3"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product2_3" id="product2_3" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product2_3"]?>"><?php echo $row_DatosConsulta["product2_3"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price2_3" value="<?php echo $row_DatosConsulta["price2_3"]?>">
            </div>
            </div>
            </div>

            <div class="card__section">
            <h2>dessert</h2>
            <div class="card__section-ind">
            <div class="card">
                    <label class="admin-label" for="">option 1:</label>
                    <input type="text" name="titulo3_1" value="<?php echo $row_DatosConsulta["titulo3_1"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product3_1" id="product3_1" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product3_1"]?>"><?php echo $row_DatosConsulta["product3_1"]?></textarea>
                    <label class="admin-label" for="">prix</label>
                    <input type="text" name="price3_1" value="<?php echo $row_DatosConsulta["price3_1"]?>">
            </div>
            <div class="card">
                    <label class="admin-label" for="">option 2:</label>
                    <input type="text" name="titulo3_2" value="<?php echo $row_DatosConsulta["titulo3_2"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product3_2" id="product3_2" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product3_2"]?>"><?php echo $row_DatosConsulta["product3_2"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price3_2" value="<?php echo $row_DatosConsulta["price3_2"]?>">
            </div>
            <div class="card">
                    <label class="admin-label" for="">option 3:</label>
                    <input type="text" name="titulo3_3" value="<?php echo $row_DatosConsulta["titulo3_3"]?>" class="title">
                    <label class="admin-label" for="">Description:</label>
                    <textarea name="product3_3" id="product3_3" cols="30" rows="10" value="<?php echo $row_DatosConsulta["product3_3"]?>"><?php echo $row_DatosConsulta["product3_3"]?></textarea>
                    <label class="admin-label" for="">prix:</label>
                    <input type="text" name="price3_3" value="<?php echo $row_DatosConsulta["price3_3"]?>">
            </div>
            </div>
            </div>
            <input type="submit" value="Modificar">
            <input name="MM_insert" id="MM_insert" type="hidden" value="forminsertar">
            
        </div>
    </form>
</body>

</html>
    <?php
    }
    else
    {
        echo "No tienes permiso de acceso";
    };
    ?>
        

