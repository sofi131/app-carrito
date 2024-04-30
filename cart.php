<?php
include_once("./models/product.php");
//inicia sesión y ve si está logueado o no
session_start();
if (isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
    if (isset($_SESSION["cart"])) {
        //Existe usuario y carrito en session, ponemos el id usuario
        $user = $_SESSION["username"];
        $cart = $_SESSION["cart"];
        $iduser = $_SESSION["iduser"];
        //Consultamos información de los productos a la bbdd
        require_once("conexion.php");
        foreach ($cart as $product) {
            # consulta -> recoge los datos de cada producto
            $sql = "select * from product where idproduct=?";
            $stm = $conn->prepare($sql);
            $stm->bindParam(1, $product->idproduct);
            $stm->execute();
            //Comprobamos si hay algún registro - esto es un bucle
            if ($stm->rowCount() > 0) {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                $product->name = $result[0]["name"];
                $product->description = $result[0]["description"];
                $product->price = $result[0]["price"];
                $product->image = $result[0]["image"];
            }
        }
        //creamos idcart
        if (isset($_SESSION["idcart"])) {
            $idcart = $_SESSION["idcart"];
        } else {
            //guardamos el carrito en la bd
            $sql = "insert into cart (iduser) value (?)";
            $stm = $conn->prepare($sql);
            $stm->bindParam(1, $iduser);
            $stm->execute();
            $idcart = $conn->lastInsertId();
            $_SESSION["idcart"] = $idcart;
        }
        //borramos la tabla cart_detail
        $sql = "delete from cart_detail where idcart=" . $idcart;
        $stm = $conn->prepare(($sql));
        $stm->execute();
        //Insertamos los productos en cart_detail
        foreach ($cart as $key => $product) {
            //insert en la bd por cada producto que haya en el carrito
            $sql = "insert into cart_detail (idcart, idproduct, quantity, price) values (?,?,?,?)";
            $stm = $conn->prepare($sql);
            $stm->bindParam(1, $idcart);
            $stm->bindParam(2, $product->idproduct);
            $stm->bindParam(3, $product->iquantity);
            $stm->bindParam(4, $product->iprice);
            $stm->execute();
        }
    } else {
        header("Location: ./");
        exit();
    }
} else {
    header("Location: ./");
    exit();
}

//var_dump($cart); -> ya no nos hace falta
?>
<!--Pegamos los estilos de index.php, el html -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>App Orders</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Mi Tienda</a>
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>

                </ul>
                <span id="user"><?php if (isset($user)) echo $user; ?></span>
            </div>
        </div>
    </nav>
    <div class="container contenedor-productos row">
        <div class="shop-cart" id="cart">
            <a class="nav-link" href="cart"><span><i class="fas fa-shopping-cart"></i><?php echo isset($cart) ? count($cart) : ''; ?> </span></a>
        </div>
        <h3>Carrito</h3>
        <!--tabla de bootstrap-->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <!--esto lo rellenamos nosotros, el body-->
                <tbody>
                    <?php
                    //para que calcule el total
                    $total = 0;
                    foreach ($cart as $key => $product) {
                        $total += $product->price * $product->quantity;
                        echo '<tr>
                            <th scope="row">' . $key . '</th>
                            <td><img class="img-cart" src="assets/product/' . $product->image . '" alt="" srcset=""></td>
                            <td>
                                <h6>' . $product->name . '</h6>
                                <p>' . $product->description . '</p>
                            </td>
                            <td><input type="number" name="" id="" value="' . $product->quantity . '"></td>
                            <td>' . $product->price . ' €/kg</td>
                            <td>' . $product->price * $product->quantity . ' €</td>
                            <td>x</td>
                        </tr>';
                    }
                    echo "<tr><td class='importe_total'  colspan='5'>Total:</td><td class='euros_total' colspan='2'>" . $total . " €</td></tr>"
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./assets/js/product.js"></script>

</body>

</html>