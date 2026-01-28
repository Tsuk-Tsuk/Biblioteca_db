<?php
include 'conexion.php';

$tabla = $_POST['tabla'] ?? '';
$registro = null;

/* =====================
   BUSCAR REGISTRO
===================== */
if (isset($_POST['buscar'])) {

    $id = intval($_POST['id']);

    if ($tabla == 'categoria') {
        $stmt = $conexion->prepare(
            "SELECT * FROM categoria WHERE id_categoria=?"
        );
        $stmt->bind_param("i", $id);

    } elseif ($tabla == 'autor') {
        $stmt = $conexion->prepare(
            "SELECT * FROM autor WHERE id_autor=?"
        );
        $stmt->bind_param("i", $id);

    } elseif ($tabla == 'libro') {
        $stmt = $conexion->prepare(
            "SELECT * FROM libro WHERE id_libro=?"
        );
        $stmt->bind_param("i", $id);
    }

    $stmt->execute();
    $registro = $stmt->get_result()->fetch_assoc();
}

/* =====================
   ACTUALIZAR CATEGORIA
===================== */
if (isset($_POST['actualizar_categoria'])) {

    $stmt = $conexion->prepare(
        "UPDATE categoria SET nombre=?, descripcion=?, estado=? WHERE id_categoria=?"
    );
    $stmt->bind_param(
        "ssii",
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['estado'],
        $_POST['id_categoria']
    );

    if ($stmt->execute()) {
        echo "<script>alert('Categoría actualizada correctamente');</script>";
    }
}

/* =====================
   ACTUALIZAR AUTOR
===================== */
if (isset($_POST['actualizar_autor'])) {

    $stmt = $conexion->prepare(
        "UPDATE autor
         SET nombres=?, apellidos=?, nacionalidad=?, fecha_nacimiento=?, biografia=?, estado=?
         WHERE id_autor=?"
    );

    $stmt->bind_param(
        "ssssiii",
        $_POST['nombres'],
        $_POST['apellidos'],
        $_POST['nacionalidad'],
        $_POST['fecha_nacimiento'],
        $_POST['biografia'],
        $_POST['estado'],
        $_POST['id_autor']
    );

    if ($stmt->execute()) {
        echo "<script>alert('Autor actualizado correctamente');</script>";
    }
}

/* =====================
   ACTUALIZAR LIBRO
===================== */
if (isset($_POST['actualizar_libro'])) {

    $stmt = $conexion->prepare(
        "UPDATE libro
         SET titulo=?, isbn=?, editorial=?, año_publicacion=?, id_categoria=?, stock=?, estado=?
         WHERE id_libro=?"
    );

    $stmt->bind_param(
        "sssiiiii",
        $_POST['titulo'],
        $_POST['isbn'],
        $_POST['editorial'],
        $_POST['anio_publicacion'],
        $_POST['id_categoria'],
        $_POST['stock'],
        $_POST['estado'],
        $_POST['id_libro']
    );

    if ($stmt->execute()) {
        echo "<script>alert('Libro actualizado correctamente');</script>";
    }
}
?>

<!-- =====================
     FORMULARIO BUSQUEDA
===================== -->
<form method="post">
    <h3>Actualizar Registro</h3>

    <select name="tabla" required>
        <option value="">Seleccione</option>
        <option value="categoria">Categoría</option>
        <option value="autor">Autor</option>
        <option value="libro">Libro</option>
    </select>

    <input type="number" name="id" placeholder="ID" required>
    <button name="buscar">Buscar</button>
</form>

<!-- =====================
     FORMULARIO CATEGORIA
===================== -->
<?php if ($tabla == 'categoria' && $registro) { ?>
<form method="post">
    <h3>Actualizar Categoría</h3>

    <input type="hidden" name="id_categoria" value="<?= $registro['id_categoria'] ?>">

    <input type="text" name="nombre" value="<?= $registro['nombre'] ?>" required>
    <input type="text" name="descripcion" value="<?= $registro['descripcion'] ?>">

    <select name="estado">
        <option value="1" <?= $registro['estado'] ? 'selected' : '' ?>>Activo</option>
        <option value="0" <?= !$registro['estado'] ? 'selected' : '' ?>>Inactivo</option>
    </select>

    <button name="actualizar_categoria">Actualizar</button>
</form>
<?php } ?>

<!-- =====================
     FORMULARIO AUTOR
===================== -->
<?php if ($tabla == 'autor' && $registro) { ?>
<form method="post">
    <h3>Actualizar Autor</h3>

    <input type="hidden" name="id_autor" value="<?= $registro['id_autor'] ?>">

    <input type="text" name="nombres" value="<?= $registro['nombres'] ?>" required>
    <input type="text" name="apellidos" value="<?= $registro['apellidos'] ?>">
    <input type="text" name="nacionalidad" value="<?= $registro['nacionalidad'] ?>">
    <input type="date" name="fecha_nacimiento" value="<?= $registro['fecha_nacimiento'] ?>">
    <textarea name="biografia"><?= $registro['biografia'] ?></textarea>

    <select name="estado">
        <option value="1" <?= $registro['estado'] ? 'selected' : '' ?>>Activo</option>
        <option value="0" <?= !$registro['estado'] ? 'selected' : '' ?>>Inactivo</option>
    </select>

    <button name="actualizar_autor">Actualizar</button>
</form>
<?php } ?>

<!-- =====================
     FORMULARIO LIBRO
===================== -->
<?php if ($tabla == 'libro' && $registro) { ?>
<form method="post">
    <h3>Actualizar Libro</h3>

    <input type="hidden" name="id_libro" value="<?= $registro['id_libro'] ?>">

    <input type="text" name="titulo" value="<?= $registro['titulo'] ?>" required>
    <input type="text" name="isbn" value="<?= $registro['isbn'] ?>">
    <input type="text" name="editorial" value="<?= $registro['editorial'] ?>">
    <input type="number" name="anio_publicacion" value="<?= $registro['año_publicacion'] ?>">
    <input type="number" name="id_categoria" value="<?= $registro['id_categoria'] ?>" required>
    <input type="number" name="stock" value="<?= $registro['stock'] ?>" min="0">

    <select name="estado">
        <option value="1" <?= $registro['estado'] ? 'selected' : '' ?>>Disponible</option>
        <option value="0" <?= !$registro['estado'] ? 'selected' : '' ?>>No disponible</option>
    </select>

    <button name="actualizar_libro">Actualizar</button>
</form>
<?php } ?>
