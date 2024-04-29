<?php
//este script es para mostrar el carrito
session_start();
if (isset($_SESSION["Username"])) {
    if (isset($_SESSION["cart"])) {
        //Existe usuario y carrito en session
        $user=$_SESSION["Username"];
        $cart=$_SESSION["cart"];
        //consultamos información de los productos a la bbdd
        require_once("conexion.php");
        
    } else {
        header("Location: ./");
        exit();
    }
} else {
    header("Location: ./");
    exit();
}
?>