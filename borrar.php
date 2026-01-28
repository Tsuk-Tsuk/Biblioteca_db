<?php
include 'conexion.php';

$opcion = $_GET['opcion'] ?? '';

if ($opcion === 'borrar') {

    /* ===== BORRAR CATEGORIA ===== */
    if (isset($_POST['borrar_categoria'])) {
        $id = $_POST['id_categoria'];

        $stmt = $conexion->prepare(
            "DELETE FROM categoria WHERE id_categoria = ?"
        );
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Categoría eliminada correctamente');</script>";
        } else {
            echo "<script>alert('No se pudo eliminar la categoría');</script>";
        }
    }

    /* ===== BORRAR AUTOR ===== */
    if (isset($_POST['borrar_autor'])) {
        $id = $_POST['id_autor'];

        $stmt = $conexion->prepare(
            "DELETE FROM autor WHERE id_autor = ?"
        );
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Autor eliminado correctamente');</script>";
        } else {
            echo "<script>alert('No se pudo eliminar el autor');</script>";
        }
    }

    /* ===== BORRAR LIBRO ===== */
    if (isset($_POST['borrar_libro'])) {
        $id = $_POST['id_libro'];

        $stmt = $conexion->prepare(
            "DELETE FROM libro WHERE id_libro = ?"
        );
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>alert('Libro eliminado correctamente');</script>";
        } else {
            echo "<script>alert('No se pudo eliminar el libro');</script>";
        }
    }
}
?>

<h3>Borrar registros</h3>

<form method="post">
    <h4>Categoría</h4>
    <input type="number" name="id_categoria" placeholder="ID Categoría" required>
    <button name="borrar_categoria">Borrar</button>
</form>

<form method="post">
    <h4>Autor</h4>
    <input type="number" name="id_autor" placeholder="ID Autor" required>
    <button name="borrar_autor">Borrar</button>
</form>

<form method="post">
    <h4>Libro</h4>
    <input type="number" name="id_libro" placeholder="ID Libro" required>
    <button name="borrar_libro">Borrar</button>
</form>
