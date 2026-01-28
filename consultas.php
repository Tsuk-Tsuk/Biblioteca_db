<h2>Consultas de la Biblioteca</h2>

<?php
// Controlar qué consulta se está usando
$consulta = $_POST['consulta'] ?? '';
?>

<form method="POST">
    <label>Selecciona consulta:</label>
    <select name="consulta">
        <option value="1">Buscar libros por autor</option>
        <option value="2">Autores de un género y sus libros</option>
        <option value="3">Cantidad de libros por categoría</option>
        <option value="4">Libros prestados y su cantidad</option>
        <option value="5">Últimos préstamos de un libro</option>
    </select>
    <br><br>
    <label>Valor:</label>
    <input type="text" name="valor" placeholder="Ingrese texto o ID">
    <button type="submit">Ejecutar</button>
</form>

<hr>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor = mysqli_real_escape_string($conexion, $_POST['valor']);

    if ($consulta == '1') {
        // Consulta 1: Buscar libros por autor
        $sql = "SELECT a.nombres, a.apellidos, l.titulo
                FROM autor a
                INNER JOIN libro_autor la ON a.id_autor = la.id_autor
                INNER JOIN libro l ON la.id_libro = l.id_libro
                WHERE a.nombres LIKE '%$valor%' OR a.apellidos LIKE '%$valor%'";
        $resultado = mysqli_query($conexion, $sql);

        echo "<h3>Libros del autor '$valor'</h3>";
    } elseif ($consulta == '2') {
        // Consulta 2: Autores de un género y sus libros
        $sql = "SELECT a.nombres, a.apellidos, l.titulo, c.nombre AS categoria
                FROM autor a
                INNER JOIN libro_autor la ON a.id_autor = la.id_autor
                INNER JOIN libro l ON la.id_libro = l.id_libro
                INNER JOIN categoria c ON l.id_categoria = c.id_categoria
                WHERE c.nombre LIKE '%$valor%'";
        $resultado = mysqli_query($conexion, $sql);

        echo "<h3>Autores y libros de la categoría '$valor'</h3>";
    } elseif ($consulta == '3') {
        // Consulta 3: Cantidad de libros por categoría
        $sql = "SELECT c.nombre AS categoria, COUNT(l.id_libro) AS total_libros
                FROM libro l
                INNER JOIN categoria c ON l.id_categoria = c.id_categoria
                GROUP BY c.id_categoria
                HAVING c.nombre LIKE '%$valor%'";
        $resultado = mysqli_query($conexion, $sql);

        echo "<h3>Cantidad de libros por categoría que contenga '$valor'</h3>";
    } elseif ($consulta == '4') {
        // Consulta 4: Libros prestados y su cantidad
        $sql = "SELECT l.titulo, SUM(dp.cantidad) AS total_prestado
                FROM detalle_prestamo dp
                INNER JOIN libro l ON dp.id_libro = l.id_libro
                GROUP BY dp.id_libro
                HAVING l.titulo LIKE '%$valor%'";
        $resultado = mysqli_query($conexion, $sql);

        echo "<h3>Total prestado del libro '$valor'</h3>";
    } elseif ($consulta == '5') {
        // Consulta 5: Últimos préstamos de un libro
        $sql = "SELECT p.id_prestamo, p.fecha_prestamo, p.fecha_devolucion, l.titulo
                FROM prestamo p
                INNER JOIN detalle_prestamo dp ON p.id_prestamo = dp.id_prestamo
                INNER JOIN libro l ON dp.id_libro = l.id_libro
                WHERE l.titulo LIKE '%$valor%'
                ORDER BY p.fecha_prestamo DESC
                LIMIT 5";
        $resultado = mysqli_query($conexion, $sql);

        echo "<h3>Últimos 5 préstamos del libro '$valor'</h3>";
    }

    // Mostrar resultados en tabla
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<table border='1' cellpadding='5'><tr>";
        // Cabecera
        while ($fieldinfo = mysqli_fetch_field($resultado)) {
            echo "<th>{$fieldinfo->name}</th>";
        }
        echo "</tr>";
        // Filas
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            foreach ($row as $valor_celda) {
                echo "<td>$valor_celda</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }
}
?>
