<?php
//este es el script que queremos que se ejecute
//proteger ejecución de script
$id=$_GET["idcartdetail"];
include("conexion.php");
$sql="delete from cart_detail where idcartdetail=?";


$response = array(
    'param1' => $id,
    'mensaje' => '¡Solicitud recibida correctamente!'
);

// Establecer las cabeceras para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>