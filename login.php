<?php
if (isset($_POST["email"])) {
    try {
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
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            //guardamos en sesión y idusuario
            $username = $result[0]["username"];
            $iduser=$result[0]["iduser"];
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["iduser"] = $iduser;
            //si se hizo bien, va a index
            header("Location: ./");
            exit();
        } else {
            $error = "Usuario o contraseña incorrecto";
        }
    } catch (Exception $e) {
        $error = "Error interno " . $e->getMessage();
    }
}
?>

<?php
if (isset($error)) {
    echo $error;
}
?>


