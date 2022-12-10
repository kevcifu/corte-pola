<?php
include("conexion.php");

$user = $_POST["user"];
$pass = $_POST["psw"];


// Registrar
if (isset($_POST['regBtn'])) {
    $pass_hard = password_hash($pass, PASSWORD_DEFAULT);
    $queryregistrar = "INSERT INTO usuarios(idUser, user, password) values ('', '$user', '$pass_hard')";
    $queryconsulta = "SELECT * FROM usuarios WHERE user = '$user'";
    $num = mysqli_num_rows(mysqli_query($conn, $queryconsulta));

    if ($num > 0) {
        echo "<script>alert('Usuario $user ya registrado'); window.location = 'registrar.html'</script>";
    } else if (mysqli_query($conn, $queryregistrar)) {
        echo "<script>alert('Usuario registrado con exito'); window.location = 'index.html'</script>";
    } else {
        echo "<script>alert('Error al registrar'); window.location = 'index.html'</script>";
    }
}
// Login
if (isset($_POST['loginBtn'])) {
    $query = "SELECT * FROM usuarios WHERE user = '$user'";
    $result = $conn->query($query);
    $nr = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // $row = $result->fetch_assoc();

    if ($nr == 1) {
        if (password_verify($pass, $row["password"])) {
            session_start();
            $_SESSION['user'] = $row["user"];
            $_SESSION['id'] = $row["idUser"];
            echo "<script>alert('Bienvenido $user'); window.location = 'formulario.php'</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location = 'index.html'</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location = 'index.html'</script>";
    }
}
?>