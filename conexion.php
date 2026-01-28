<?php
$host = "127.0.0.1";
$usuario = "root";
$clave = "1234"; // en XAMPP normalmente VACÍA
$bd = "biblioteca"; // asegúrate que sea el nombre real

$conexion = mysqli_connect($host, $usuario, $clave, $bd);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
