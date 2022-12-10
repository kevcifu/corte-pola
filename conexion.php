<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'corteypola';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if ($conn -> connect_error) {
    echo "No hay conexion: (" . $conn->connect_errno . ")" . $conn->connect_error;
}

?>