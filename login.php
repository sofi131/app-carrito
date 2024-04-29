<?php
if(isset($_POST["email"])){
    require_once("conexion.php");
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql="select * from user where email=? and password=?";
}
?>