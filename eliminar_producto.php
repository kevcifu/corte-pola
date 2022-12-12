<?php
include("conexion.php");

session_start();

$id = $_GET['id'];

$consulta = "DELETE FROM productos WHERE idProducto = '$id'";

$result = mysqli_query($conn, $consulta);

if ($result) {
    echo "<script>alert('Producto eliminado con exito'); window.location = 'productos.php'</script>";
} else {
    echo "Error al eliminar el producto";
}
?>