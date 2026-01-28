<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tabla = $_POST['tabla'] ?? '';

    /* ==========================
       INSERTAR CATEGORIA
    ========================== */
    if ($tabla === 'categoria') {

        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        if ($nombre === '') {
            $mensaje = "El nombre de la categoría no puede estar vacío";
        } else {

            $stmt = $conexion->prepare(
                "INSERT INTO categoria (nombre, descripcion) VALUES (?, ?)"
            );

            if (!$stmt) {
                $mensaje = "Error en prepare: " . $conexion->error;
            } else {

                $stmt->bind_param("ss", $nombre, $descripcion);

                if ($stmt->execute()) {
                    $mensaje = "Categoría registrada correctamente ✅";
                } else {
                    if ($stmt->errno == 1062) {
                        $mensaje = "La categoría ya existe ❌";
                    } else {
                        $mensaje = "Error al insertar categoría: " . $stmt->error;
                    }
                }
                $stmt->close();
            }
        }
    }

    /* ==========================
       INSERTAR AUTOR
    ========================== */
    elseif ($tabla === 'autor') {

        $nombres = trim($_POST['nombres'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?: null;
        $biografia = trim($_POST['biografia'] ?? '');

        if ($nombres === '') {
            $mensaje = "El nombre del autor es obligatorio";
        } else {

            $stmt = $conexion->prepare(
                "INSERT INTO autor
                (nombres, apellidos, nacionalidad, fecha_nacimiento, biografia)
                VALUES (?, ?, ?, ?, ?)"
            );

            if (!$stmt) {
                $mensaje = "Error en prepare: " . $conexion->error;
            } else {

                $stmt->bind_param(
                    "sssss",
                    $nombres,
                    $apellidos,
                    $nacionalidad,
                    $fecha_nacimiento,
                    $biografia
                );

                if ($stmt->execute()) {
                    $mensaje = "Autor registrado correctamente ✅";
                } else {
                    $mensaje = "Error al insertar autor: " . $stmt->error;
                }

                $stmt->close();
            }
        }
    }

    /* ==========================
       INSERTAR LIBRO
    ========================== */
elseif ($tabla === 'libro') {

    $titulo = trim($_POST['titulo'] ?? '');
    $isbn = trim($_POST['isbn'] ?? '');
    $editorial = trim($_POST['editorial'] ?? '');
    $anio = $_POST['anio_publicacion'] ?? null;
    $id_categoria = $_POST['id_categoria'] ?? '';
    $stock = $_POST['stock'] ?? '';

    // Normalizar valores opcionales
    if ($isbn === '') {
        $isbn = null;
    }

    if ($anio === '') {
        $anio = null;
    }

    if ($titulo === '' || $id_categoria === '' || $stock === '') {
        $mensaje = "Título, categoría y stock son obligatorios";
    } elseif (!is_numeric($id_categoria) || !is_numeric($stock)) {
        $mensaje = "Categoría y stock deben ser numéricos";
    } else {

        $stmt = $conexion->prepare(
            "INSERT INTO libro
            (titulo, isbn, editorial, año_publicacion, id_categoria, stock)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        if (!$stmt) {
            $mensaje = "Error en prepare: " . $conexion->error;
        } else {

            // 👇 AHORA TODO SON VARIABLES (OK)
            $stmt->bind_param(
                "ssssii",
                $titulo,
                $isbn,
                $editorial,
                $anio,
                $id_categoria,
                $stock
            );

            if ($stmt->execute()) {
                $mensaje = "Libro registrado correctamente ✅";
            } else {
                if ($stmt->errno == 1062) {
                    $mensaje = "ISBN ya registrado ❌";
                } elseif ($stmt->errno == 1452) {
                    $mensaje = "La categoría no existe ❌";
                } else {
                    $mensaje = "Error al insertar libro: " . $stmt->error;
                }
            }

            $stmt->close();
        }
    }
}

    /* ==========================
       ALERTA FINAL
    ========================== */
    if ($mensaje !== '') {
        echo "<script>
            alert('$mensaje');
            window.location.href='index.php?opcion=insertar';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Datos</title>
</head>
<body>

<h2>Insertar datos</h2>

<form method="POST">
    <label>Tabla:</label>
    <select name="tabla" id="tablaSelect" onchange="mostrarForm()" required>
        <option value="">Seleccione</option>
        <option value="categoria">Categoría</option>
        <option value="autor">Autor</option>
        <option value="libro">Libro</option>
    </select>

    <div id="formCategoria" style="display:none;">
        <h3>Categoría</h3>
        <input type="text" name="nombre" placeholder="Nombre"><br>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
    </div>

    <div id="formAutor" style="display:none;">
        <h3>Autor</h3>
        <input type="text" name="nombres" placeholder="Nombres"><br>
        <input type="text" name="apellidos" placeholder="Apellidos"><br>
        <input type="text" name="nacionalidad" placeholder="Nacionalidad"><br>
        <input type="date" name="fecha_nacimiento"><br>
        <textarea name="biografia" placeholder="Biografía"></textarea>
    </div>

    <div id="formLibro" style="display:none;">
        <h3>Libro</h3>
        <input type="text" name="titulo" placeholder="Título"><br>
        <input type="text" name="isbn" placeholder="ISBN"><br>
        <input type="text" name="editorial" placeholder="Editorial"><br>
        <input type="number" name="anio_publicacion" placeholder="Año"><br>
        <input type="number" name="id_categoria" placeholder="ID Categoría"><br>
        <input type="number" name="stock" placeholder="Stock">
    </div>

    <br>
    <button type="submit">Insertar</button>
</form>

<script>
function mostrarForm() {
    const t = document.getElementById('tablaSelect').value;
    document.getElementById('formCategoria').style.display = t === 'categoria' ? 'block' : 'none';
    document.getElementById('formAutor').style.display = t === 'autor' ? 'block' : 'none';
    document.getElementById('formLibro').style.display = t === 'libro' ? 'block' : 'none';
}
</script>

</body>
</html>
