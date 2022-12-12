<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.html");
}

$consultaProductos = "SELECT * FROM productos WHERE idUser = '$_SESSION[id]'";
$result = mysqli_query($conn, $consultaProductos);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mis productos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Corte & Pola</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link link-light" aria-current="page" href="productos.php">Mis pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-light" href="formulario.php">Agregar producto</a>
                    </li>
                </ul>
                <div class="nav-item d-flex justify-content-end">
                    <a href="salir.php" class="btn btn-danger">Salir</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <h2>Mis pedidos</h2>
        <p>Busca y filtra tus pedidos aquí:</p>
        <input class="form-control" id="myInput" type="text" placeholder="Buscar.." />
        <br />
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Documento</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <tr>
                    <?php
                    if ($row > 0) {
                        do {
                            $total = $row["productcant"] * $row["productprice"] . " COP";
                            echo "<tr>";
                            echo "<td>" . $row["productname"] . "</td>";
                            echo "<td>" . "<strong>$row[tdocument]</strong>" . " " . $row["documentnumber"] . "</td>";
                            echo "<td>" . $row["productcant"] . "</td>";
                            echo "<td>" . $row["productprice"] . "</td>";
                            echo "<td>" . $total . "</td>";
                            echo "<td>" . "<a href='editar_producto.php?id=" . $row["idProducto"] . "' class='btn btn-warning'>Editar</a> <a href='eliminar_producto.php?id=" . $row["idProducto"] . "' class='btn btn-danger'>Eliminar</a>" . "</td>";
                            echo "</tr>";
                        } while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
                    } else {
                        echo "<tr>";
                        echo "<td colspan='4'>No hay productos registrados</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myInput').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#myTable tr').filter(function () {
                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );
                });
            });
        });
    </script>
</body>

</html>