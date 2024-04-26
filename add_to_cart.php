<?php
session_start();

if (isset($_GET["idproduct"])) {
    $idproduct = $_GET["idproduct"];
    $quantity = isset($_GET["quantity"]) ? $_GET["quantity"] : 1;
    //comprobamos si el usuario se ha logueado
    if(isset($_SESSION["user"])){
        //guardamos en bbdd
    }else{
        //guardamos el carrito en session
    }
}
