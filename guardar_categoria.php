<?php
require_once "conexion.php";

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO categoria (nombre, descripcion)
        VALUES ('$nombre', '$descripcion')";

if (mysqli_query($conexion, $sql)) {
    echo "✅ Categoría insertada correctamente.<br>";
    echo "<a href='formulario_categoria.html'>Volver</a>";
} else {
    echo "❌ Error: " . mysqli_error($conexion);
}
?>
