<?php
include("conexion.php");
session_start();

$queryproductos = "INSERT INTO productos(idProducto, idUser, username, lastname, tdocument, documentnumber, cel, tlp, useraddress, productname, productcant, productprice, details) VALUES ('', '$_SESSION[id]', '$_POST[username]', '$_POST[lastname]', '$_POST[tdocument]', '$_POST[documentnumber]', '$_POST[cel]', '$_POST[tlp]', '$_POST[useraddress]', '$_POST[productname]', '$_POST[productcant]', '$_POST[productprice]', '$_POST[details]')";

$result = mysqli_query($conn, $queryproductos);

if ($result) {
    echo "<script>alert('Producto registrado con exito'); window.location = 'formulario.php'</script>";
} else {
    echo "<script>alert('Error al registrar'); window.location = 'formulario.php'</script>";
}
?>