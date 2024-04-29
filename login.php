<?php
if (isset($_POST["email"])) {
    require_once("conexion.php");
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "select * from user where email=? and password=?";
    $stm = $conn->prepare($sql);
    $stm->bindParam(1, $email);
    $stm->bindParam(2, $password);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        //ACCEDER A MÉTODOS ESTÁTICOS DE CLASE (los 2 pts)
        $result=$stm->fetchAll(PDO::FETCH_ASSOC);
        //guardamos en sesión
        $username=$result[0]["username"];
        session_start();
        $_SESSION["username"]=$username;

    } else {

    }
}
