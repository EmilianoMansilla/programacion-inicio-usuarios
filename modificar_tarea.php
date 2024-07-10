<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Emiliano Mansilla Maciel">
    <meta name="description" content="Con este sistema organizo, controlo, creo y asigno las tareas para realizar a los integrantes del grupo">
    <link rel="shortcut icon" href="./assets/icono/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Modificar tareas</title>
</head>

<body>
    <header class="border">
        <nav>
            <div>
                <a href="index.php">
                    <img src="./assets/home/casa6.png" class="logo-nav" alt="Logo">
                </a>
            </div>
            <div class="menu-items">
                <input type="checkbox" class="menu-toggle" id="menu-toggle">
                <label for="menu-toggle">
                    <img src="./assets/menu/menu6.png" class="icono-nav" alt="Icono de menú">
                </label>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="listar_tareas.php">Ver tareas</a></li> 
                    <li><a href="terminar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

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

    <!-- Footer -->
    <footer class="border">
        <hr>
        <h4>&copy; Copyright 2024 (c) Emiliano Mansilla Maciel</h4>
    </footer>
</body>
</html>