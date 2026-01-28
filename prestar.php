<?php
include 'conexion.php';

/* ==========================
   REGISTRAR PRÉSTAMO
========================== */
if (isset($_POST['prestar'])) {

    $id_libro   = $_POST['id_libro'];
    $id_cliente = $_POST['id_cliente'];

    mysqli_begin_transaction($conexion);

    try {
        // Verificar stock
        $stmt = $conexion->prepare(
            "SELECT stock FROM libro WHERE id_libro=? AND estado=TRUE"
        );
        $stmt->bind_param("i", $id_libro);
        $stmt->execute();
        $libro = $stmt->get_result()->fetch_assoc();

        if (!$libro || $libro['stock'] <= 0) {
            throw new Exception("No hay stock disponible");
        }

        // Crear préstamo
        $stmt = $conexion->prepare(
            "INSERT INTO prestamo (id_cliente, fecha_prestamo, estado)
             VALUES (?, CURDATE(), 'PRESTADO')"
        );
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();

        $id_prestamo = $conexion->insert_id;

        // Detalle préstamo
        $stmt = $conexion->prepare(
            "INSERT INTO detalle_prestamo (id_prestamo, id_libro, cantidad)
             VALUES (?, ?, 1)"
        );
        $stmt->bind_param("ii", $id_prestamo, $id_libro);
        $stmt->execute();

        // Actualizar stock
        $stmt = $conexion->prepare(
            "UPDATE libro SET stock = stock - 1 WHERE id_libro=?"
        );
        $stmt->bind_param("i", $id_libro);
        $stmt->execute();

        mysqli_commit($conexion);
        echo "<script>alert('Préstamo registrado correctamente');</script>";

    } catch (Exception $e) {
        mysqli_rollback($conexion);
        echo "<script>alert('Error: ".$e->getMessage()."');</script>";
    }
}

/* ==========================
   DEVOLVER LIBRO
========================== */
if (isset($_POST['devolver'])) {

    $id_prestamo = $_POST['id_prestamo'];

    mysqli_begin_transaction($conexion);

    try {
        // Obtener libro del préstamo
        $stmt = $conexion->prepare(
            "SELECT d.id_libro
             FROM detalle_prestamo d
             WHERE d.id_prestamo=?"
        );
        $stmt->bind_param("i", $id_prestamo);
        $stmt->execute();
        $detalle = $stmt->get_result()->fetch_assoc();

        if (!$detalle) {
            throw new Exception("Préstamo no válido");
        }

        // Marcar devolución
        $stmt = $conexion->prepare(
            "UPDATE prestamo
             SET estado='DEVUELTO', fecha_devolucion=CURDATE()
             WHERE id_prestamo=?"
        );
        $stmt->bind_param("i", $id_prestamo);
        $stmt->execute();

        // Aumentar stock
        $stmt = $conexion->prepare(
            "UPDATE libro SET stock = stock + 1 WHERE id_libro=?"
        );
        $stmt->bind_param("i", $detalle['id_libro']);
        $stmt->execute();

        mysqli_commit($conexion);
        echo "<script>alert('Libro devuelto correctamente');</script>";

    } catch (Exception $e) {
        mysqli_rollback($conexion);
        echo "<script>alert('Error al devolver el libro');</script>";
    }
}
?>

<!-- ==========================
     FORMULARIO PRÉSTAMO
========================== -->
<h3>Registrar Préstamo</h3>
<form method="post">
    <input type="number" name="id_libro" placeholder="ID Libro" required>
    <input type="number" name="id_cliente" placeholder="ID Cliente" required>
    <button name="prestar">Prestar</button>
</form>

<hr>

<!-- ==========================
     LISTA DE LIBROS PRESTADOS
========================== -->
<h3>Libros Prestados</h3>
<table border="1" cellpadding="6">
    <tr>
        <th>Libro</th>
        <th>Cliente</th>
        <th>Fecha Préstamo</th>
        <th>Acción</th>
    </tr>

<?php
$res = $conexion->query("SELECT * FROM vista_prestamos_activos");

while ($row = $res->fetch_assoc()) {
?>
<tr>
    <td><?= htmlspecialchars($row['libro']) ?></td>
    <td><?= htmlspecialchars($row['cliente']) ?></td>
    <td><?= $row['fecha_prestamo'] ?></td>
    <td>
        <form method="post" style="display:inline">
            <input type="hidden" name="id_prestamo" value="<?= $row['id_prestamo'] ?>">
            <button name="devolver">Devolver</button>
        </form>
    </td>
</tr>
<?php } ?>
</table>
