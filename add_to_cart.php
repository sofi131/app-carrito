<?php
include_once("./models/product.php");
session_start();

if (isset($_GET["idproduct"])) {
    $idproduct = $_GET["idproduct"];
    $quantity = isset($_GET["quantity"]) ? $_GET["quantity"] : 1;
    //comprobamos si el usuario se ha logueado
    if (isset($_SESSION["user"])) {
        //guardamos en bbdd
    } else {
        //guardamos el carrito en session
        $product = new Product($idproduct, $quantity);
        if (isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
        } else {
            $cart = array();
        }
        array_push($cart, $product);
        $_SESSION["cart"]=$cart;
    }
}
