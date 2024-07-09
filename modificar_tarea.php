<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Tarea</title>
</head>
<body>
    <?php
    require_once 'Usuario.php';
    session_start();

    $nombre = $_GET['nombre'];
    $str = file_get_contents("tareas.json");
    $tareas = json_decode($str, true);

    $tarea = NULL;
    foreach ($tareas as $t) {
        if ($t['nombre'] === $nombre) {
            $tarea = $t;
            break;
        }
    }

    $usuarioActual = $_SESSION['usuario'];

    if ($usuarioActual->rol !== 'administrador' && $usuarioActual->cedula !== $tarea['usuario']) {
        echo '<p>No tienes permiso para modificar esta tarea.</p>';
        echo '<a href="index.php">Volver</a>';
        exit();
    }
    ?>

    <form method="POST" action="procesar_modificar_tarea.php">
        <input type="hidden" id="nombreActual" name="nombreActual" value="<?php echo $tarea['nombre']; ?>">
        <label for="nuevoNombre">Nuevo Nombre:</label>
        <input type="text" id="nuevoNombre" name="nuevoNombre" value="<?php echo $tarea['nombre']; ?>" required><br><br>
        <label for="nuevaDescripcion">Nueva Descripción:</label>
        <input type="text" id="nuevaDescripcion" name="nuevaDescripcion" value="<?php echo $tarea['descripcion']; ?>" required><br><br>
        <label for="nuevaFechaInicio">Nueva Fecha de Inicio:</label>
        <input type="date" id="nuevaFechaInicio" name="nuevaFechaInicio" value="<?php echo $tarea['fecha_inicio']; ?>" required><br><br>
        <label for="nuevaFechaFin">Nueva Fecha de Fin:</label>
        <input type="date" id="nuevaFechaFin" name="nuevaFechaFin" value="<?php echo $tarea['fecha_fin']; ?>" required><br><br>

        <?php if ($usuarioActual->rol === 'administrador') { ?>
        <label for="finalizada">Finalizada:</label>
        <select id="finalizada" name="finalizada">
            <option value="1" <?php echo ($tarea['finalizada']) ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo (!$tarea['finalizada']) ? 'selected' : ''; ?>>No</option>
        </select><br><br>
        <?php } else { ?>
        <input type="hidden" id="finalizada" name="finalizada" value="<?php echo $tarea['finalizada'] ? '1' : '0'; ?>">
        <?php } ?>

        <input type="submit" value="Modificar">
    </form>
</body>
</html>