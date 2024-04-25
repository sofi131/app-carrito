<?php
require_once("config.php");

// Variables para la conexión
$servername = DB_HOST;
$database = DB_NAME;
$username = DB_USER;
$password = DB_PASSWORD;

try {
    // Crear una instancia de PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error a excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Salida si la conexión es exitosa
    //echo "Conexión exitosa a la base de datos '$database'";
} catch (PDOException $e) {
    // Salida si hay un error en la conexión
    echo "Error en la conexión: " . $e->getMessage();
}
?>

