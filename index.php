<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Biblioteca</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="container">

    <!-- MENU IZQUIERDA -->
    <div class="menu">
        <h2>Biblioteca</h2>
        <ul>
            <li><a href="?opcion=consultas">Consultas</a></li>
            <li><a href="?opcion=insertar">Insertar</a></li>
            <li><a href="?opcion=borrar">Borrar</a></li>
            <li><a href="?opcion=actualizar">Actualizar</a></li>
            <li><a href="?opcion=prestar">Prestar</a></li>
            <li><a href="?opcion=auditoria">Auditoría</a></li>
        </ul>
    </div>

    <!-- CONTENIDO DERECHA -->
    <div class="contenido">
        <?php
        $opcion = $_GET['opcion'] ?? 'consultas';

        switch ($opcion) {
            case 'consultas':
                include 'consultas.php';
                break;
            case 'insertar':
                include 'insertar.php';
                break;
            case 'borrar':
                include 'borrar.php';
                break;
            case 'actualizar':
                include 'actualizar.php';
                break;
            case 'prestar':
                include 'prestar.php';
                break;
            case 'auditoria':
                include 'acciones.php';
                break;
            default:
                echo "<h3>Selecciona una opción del menú.</h3>";
        }
        ?>
    </div>

</div>
</body>
</html>
