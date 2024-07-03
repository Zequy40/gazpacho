<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Asegúrate de incluir DELETE aquí
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


function connectDB(){
        $server = "db5007399484.hosting-data.io";
        $user = "dbu1824151";
        $pass = "db_2403/pk_22";
        $bd = "dbs6097793";

    $conexion = mysqli_connect($server, $user, $pass,$bd);

        if($conexion){
            //echo 'La conexion de la base de datos se ha hecho satisfactoriamente';
        }else{
            //echo 'Ha sucedido un error inexperado en la conexion de la base de datos';
        }

    return $conexion;
}

$conexionBD = connectDB();


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM dblCarte WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])) {
    // Sanitizar y escapar el valor de $_GET["borrar"] para prevenir inyecciones SQL
    $nameToDelete = mysqli_real_escape_string($conexionBD, $_GET["borrar"]);

    // Crear la consulta preparada
    $stmt = mysqli_prepare($conexionBD, "DELETE FROM command WHERE commandNumber = ?");
    
    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt, "s", $nameToDelete);

    // Ejecutar la consulta
    $success = mysqli_stmt_execute($stmt);

    // Verificar si la consulta se ejecutó con éxito
    if ($success) {
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["success" => 0, "error" => mysqli_error($conexionBD)]);
    }

    // Cerrar la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexionBD);

    exit();
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $lastName=$data->lastName;
    $dateCommand=$data->date;
    $productData=$data->product;
    $commandeNumber=$data->commandNumber;


        if(($name!="")&&($lastName!="")&& !empty($productData)){
            $productJson = json_encode($productData);
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO command(name,lastName,date,product,commandNumber) VALUES('$name','$lastName','$dateCommand','$productJson','$commandeNumber') ");
    
        echo json_encode(["success" => 1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $nameToUpdate = mysqli_real_escape_string($conexionBD, $_GET["actualizar"]);

    // Crear la consulta preparada
    $stmt = mysqli_prepare($conexionBD, "UPDATE command SET status=1 WHERE commandNumber= ?");
    
    // Vincular el parámetro
    mysqli_stmt_bind_param($stmt, "s", $nameToUpdate);
    
    $success = mysqli_stmt_execute($stmt);

    // Verificar si la consulta se ejecutó con éxito
    if ($success) {
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["success" => 0, "error" => mysqli_error($conexionBD)]);
    }

    // Cerrar la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexionBD);

    exit();
}
// Actualiza solamente la hora del pedido

if(isset($_GET["actualizarHora"]) && isset($_GET["numeroPedido"])) {
    // Obtener los parámetros y escapar cualquier carácter peligroso
    $dateToUpdate = mysqli_real_escape_string($conexionBD, $_GET["actualizarHora"]);
    $commandToUpdate = mysqli_real_escape_string($conexionBD, $_GET["numeroPedido"]);

    // Crear la consulta preparada
    $stmt = mysqli_prepare($conexionBD, "UPDATE command SET date = ? WHERE commandNumber = ?");
    
    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ss", $dateToUpdate, $commandToUpdate);
    
    // Ejecutar la consulta
    $success = mysqli_stmt_execute($stmt);

    // Verificar si la consulta se ejecutó con éxito
    if ($success) {
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["success" => 0, "error" => mysqli_error($conexionBD)]);
    }

    // Cerrar la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexionBD);

    exit();
} else {
    echo json_encode(["success" => 0, "error" => "Faltan parámetros"]);
}

// Consulta todos los registros de la tabla dblCarte
$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM dblCarte ");
if(mysqli_num_rows($sqlEmpleaados) > 0){
    $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }


?>
