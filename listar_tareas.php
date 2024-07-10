<?php
require_once 'Usuario.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

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
    <title>Ver tareas</title>
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
                    <li><a href="terminar_sesion.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

<?php
$usuarioActual = $_SESSION['usuario'];

$str = file_get_contents("usuarios.json");
$usuarios = json_decode($str, true);

$cedulaUsuario = $usuarioActual->cedula;
$tareasStr = file_get_contents("tareas.json");
$tareas = json_decode($tareasStr, true);

$cedulaSeleccionada = isset($_GET['cedula']) ? $_GET['cedula'] : $cedulaUsuario;

echo '<h1>Tareas</h1>';

if ($usuarioActual->rol === 'administrador') {
    echo '<form method="GET" action="listar_tareas.php">';
    echo '<label for="cedula">Seleccionar Usuario:</label>';
    echo '<select id="cedula" name="cedula">';
    foreach ($usuarios as $usuario) {
        $selected = $usuario['cedula'] === $cedulaSeleccionada ? 'selected' : '';
        echo '<option value="' . $usuario['cedula'] . '" ' . $selected . '>' . $usuario['nombres'] . ' ' . $usuario['apellidos'] . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Ver tareas">';
    echo '</form>';
}

echo '<table border="1">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Finalizada</th>';

if ($usuarioActual->rol === 'basico') {
    echo '<th>Marcar como Finalizada</th>';
}

if ($usuarioActual->rol === 'administrador') {
    echo '<th>Modificar</th>
          <th>Eliminar</th>';
}

echo '</tr>';

foreach ($tareas as $tarea) {
    if ($tarea['usuario'] === $cedulaSeleccionada) {
        echo '<tr>
              <td>' . $tarea['nombre'] . '</td>
              <td>' . $tarea['descripcion'] . '</td>
              <td>' . $tarea['fecha_inicio'] . '</td>
              <td>' . $tarea['fecha_fin'] . '</td>
              <td>' . ($tarea['finalizada'] ? 'Sí' : 'No') . '</td>';

        if ($usuarioActual->rol === 'basico') {
            echo '<td>';
            echo '<form method="POST" action="procesar_modificar_tarea.php">';
            echo '<input type="hidden" name="nombre" value="' . $tarea['nombre'] . '">';
            echo '<input type="hidden" name="finalizada" value="' . (!$tarea['finalizada'] ? '1' : '0') . '">';
            echo '<input type="submit" value="' . (!$tarea['finalizada'] ? 'Marcar como Finalizada' : 'Marcar como No Finalizada') . '">';
            echo '</form>';
            echo '</td>';
        }

        if ($usuarioActual->rol === 'administrador') {
            echo '<td><a href="modificar_tarea.php?nombre=' . urlencode($tarea['nombre']) . '">Modificar</a></td>
                  <td><a href="eliminar_tarea.php?nombre=' . urlencode($tarea['nombre']) . '">Eliminar</a></td>';
        }

        echo '</tr>';
    }
}

echo '</table>';
echo '<br><a href="index.php">Volver</a>';
?>

    <!-- Footer -->
    <footer class="border">
        <hr>
        <h4>&copy; Copyright 2024 (c) Emiliano Mansilla Maciel</h4>
    </footer>
</body>
</html>