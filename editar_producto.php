<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.html");
}

$id = $_GET['id'];

$consultaProductos = "SELECT * FROM productos WHERE idProducto = '$id'";

$result = mysqli_query($conn, $consultaProductos);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($row < 1) {
    echo "<script>alert('No se encontró el producto')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <title>Editar</title>
</head>

<?php
if (isset($_POST['editar'])) {
    $username = $_POST['username'];
    $lastname = $_POST['lastname'];
    $tdocument = $_POST['tdocument'];
    $documentnumber = $_POST['documentnumber'];
    $cel = $_POST['cel'];
    $tlp = $_POST['tlp'];
    $useraddress = $_POST['useraddress'];
    $productname = $_POST['productname'];
    $productcant = $_POST['productcant'];
    $productprice = $_POST['productprice'];
    $details = $_POST['details']; 

    $actualizarP = "UPDATE productos SET idProducto = '$id', username = '$username', lastname = '$lastname', tdocument = '$tdocument', documentnumber = '$documentnumber', cel = '$cel', tlp = '$tlp', useraddress = '$useraddress', productname = '$productname', productcant = '$productcant', productprice = '$productprice', details = '$details' WHERE idProducto = '$id'";

    $resultP = mysqli_query($conn, $actualizarP);

    
    if ($resultP) {
        echo "<script>alert('Producto actualizado')</script>";
        header("Location: productos.php");
    } else {
        echo "Error al actualizar el producto";
    }
}

?>
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
    <?php
    if (isset($row) && $row > 0) {
    ?>
    <div class="text-center py-4">
        <h1>Edite su orden <?= $row['idProducto'] . ' / ' . $row['productname']; ?></h1>
    </div>
    <div class="container">
        <form class="row g-2 form py-3 needs-validation" method="post" novalidate>
            <div class="col-md-6 my-3">
                <input type="text" class="form-control" name="username" id="name" aria-describedby="name"
                    placeholder="Nombre" required value="<?= $row['username']; ?>"/>
                <div class="invalid-feedback">
                    Por favor, ingrese su nombre.
                </div>
            </div>
            <div class="col-md-6 my-3" input-group>
                <input type="text" class="form-control" name="lastname" id="last-name" aria-describedby="last-name"
                    placeholder="Apellidos" required value="<?= $row['lastname'] ?>"/>
                <div class="invalid-feedback">
                    Por favor, ingrese su apellido.
                </div>
            </div>
            <div class="col-md-2 g-2 my-3">
                <select class="form-select" id="user-id-type" name="tdocument" >
                    <option value="<?= $row['tdocument'] ?>"><?= $row['tdocument'] ?></option>
                    <option value="CC">CC</option>
                    <option value="CC DIG">CC DIG</option>
                    <option value="CE">CE</option>
                    <option value="NIT">NIT</option>
                    <option value="NUIT">NUIT</option>
                    <option value="NES">NES</option>
                    <option value="RUT">RUT</option>
                </select>
            </div>
            <div class="col-md-4 my-3">
                <input type="number" min="0" class="form-control" name="documentnumber" id="last-name"
                    aria-describedby="user-id" placeholder="Número de Documento"  value="<?= $row['documentnumber'] ?>"/>
            </div>
            <div class="col-md-1 my-3">
                <input type="text" min="0" class="form-control" name="cel-d" id="user-cel-d"
                    aria-describedby="user-cel-d" placeholder="Celular" disabled/>
            </div>
            <div class="col-md-2 my-3">
                <input type="number" min="0" class="form-control" name="cel" id="user-cel" aria-describedby="user-cel"
                    placeholder="# de Celular" required value="<?= $row['cel'] ?>"/>
                <div class="invalid-feedback">
                    Por favor, ingrese su celular.
                </div>
            </div>
            <div class="col-md-1 my-3">
                <input type="text" class="form-control" name="tlp-d" id="user-tlp-d" aria-describedby="user-tlp-d"
                    placeholder="Tel" disabled />
            </div>
            <div class="col-md-2 my-3">
                <input type="number" min="0" class="form-control" name="tlp" id="user-tlp" aria-describedby="user-tlp"
                    placeholder="Telefono" value="<?= $row['tlp'] ?>" />
            </div>
            <div class="input-group mb-3 my-3">
                <span class="input-group-text" id="address-text">Dirección</span>
                <input type="text" class="form-control" placeholder="Ciudad, Calle, Av, Carrera"
                    aria-label="user-address" aria-describedby="user-address" name="useraddress" required value="<?= $row['useraddress'] ?>" />
                <div class="invalid-feedback">
                    Por favor, ingrese su dirección (Ciudad, dirección).
                </div>
            </div>
            <div class="col-md-7 my-3">
                <input type="text" class="form-control" name="productname" id="product-name"
                    aria-describedby="product-name" placeholder="Nombre del producto" required value="<?= $row['productname'] ?>"/>
                <div class="invalid-feedback">
                    Por favor, ingrese el producto.
                </div>
            </div>
            <div class="col-md-2 my-3">
                <input type="number" min="0" class="form-control" name="productcant" id="product-cant"
                    aria-describedby="product-cant" placeholder="Cantidad (Unidad)" required value="<?= $row['productcant'] ?>" />
                <div class="invalid-feedback">
                    Por favor, ingrese la cantidad (unidades).
                </div>
            </div>
            <div class="col-md-1 my-3">
                <input type="text" class="form-control" name="product-price-d" id="product-price-d"
                    aria-describedby="product-price-d" placeholder="$" disabled />
            </div>
            <div class="col-md-2 my-3">
                <input type="text" class="form-control" name="productprice" id="product-price"
                    aria-describedby="product-price" placeholder="Valor unitario" required value="<?= $row['productprice'] ?>"/>
                <div class="invalid-feedback">
                    Por favor, ingrese el precio.
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-text">Detalles adicionales</span>
                <textarea class="form-control" aria-label="With textarea"
                    placeholder="Detalles en la dirección, valor, disponibilidad, nombre de quien entrega, etc."
                    rows="4" name="details" value="<?= $row['details'] ?>"></textarea>
            </div>
            <div class="inline-block">
                <button type="submit" class="btn btn-primary" name="editar">
                    Aceptar
                </button>
                <a href="productos.php" class="btn btn-secondary">
                    Cancelar
                </a>
        </form>
    <?php
    }
    ?>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script>
        (() => {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.from(forms).forEach((form) => {
                form.addEventListener(
                    'submit',
                    (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    },
                    false
                );
            });
        })();
    </script>
</body>

</html>