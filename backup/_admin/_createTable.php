<?php
//ini_set('display_errors', '1'); 

require_once('../Connections/connexion.php');
// Crear una tabla
$sql = "CREATE TABLE FeedBack (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    strComment VARCHAR(150) NOT NULL,
    date TIMESTAMP DEFAULT NOW() 
    )";

if (mysqli_query($con, $sql)) {
    header("Location: admin_page.php");;
} else {
echo "Error al crear la tabla: " . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);

    ?>