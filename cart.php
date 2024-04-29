<?php
//este script es para mostrar el carrito
session_start();
if (isset($_SESSION["Username"])) {
    if (isset($_SESSION["cart"])) {
        //Existe usuario y carrito en session
        $user = $_SESSION["Username"];
        $cart = $_SESSION["cart"];
        //consultamos información de los productos a la bbdd
        require_once("conexion.php");
        //recorremos el array de artículos que hay en el carrito
        foreach ($cart as $product) {
            # consulta
            $sql = "select * from product where idproduct=?";
            $stm = $conn->prepare($sql);
            $stm->bindParam(1, $product->idproduct);
            $stm->execute();
            //Comprobamos si hay algún registro - esto es un bucle
            if($stm->rowCount()>0){
                $result=$stm->fetchAll(PDO::FETCH_ASSOC);
                $product->name=$result[0]["name"];
                $product->description=$result[0]["description"];
                $product->price=$result[0]["price"];
                $product->image=$result[0]["image"];
            }
        }
    } else {
        header("Location: ./");
        exit();
    }
} else {
    header("Location: ./");
    exit();
}
//deprueba
echo $cart;
?>
