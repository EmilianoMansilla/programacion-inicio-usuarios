<?php
require_once 'Usuario.php'; 
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuarioActual = $_SESSION['usuario'];

// cargar usuarios desde usuarios.json
$str = file_get_contents("usuarios.json");
$usuariosData = json_decode($str, true);

$usuarios = [];

// crear objetos Usuario de los datos en usuarios.json
foreach ($usuariosData as $userData) {
    $usuario = new Usuario(
        $userData['nombres'],
        $userData['apellidos'],
        $userData['edad'],
        $userData['cedula'],
        $userData['contrasena'],
        $userData['rol']
    );
    $usuarios[] = $usuario;
}

$_SESSION['usuarios'] = $usuarios; // guardar usuarios en sesión

    echo '<h1>Bienvenido, ' . $usuarioActual->nombres . '</h1>';

if ($usuarioActual->rol === 'administrador') {
    echo '<h2>Lista de Usuarios</h2>';
    echo '<table border="1">
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Cédula</th>
                <th>Rol</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>';

    foreach ($usuarios as $usuario) {
        echo '<tr>
              <td>' . $usuario->nombres . '</td>
              <td>' . $usuario->apellidos . '</td>
              <td>' . $usuario->edad . '</td>
              <td>' . $usuario->cedula . '</td>
              <td>' . $usuario->rol . '</td>
              <td><a href="modificar.php?cedula=' . urlencode($usuario->cedula) . '">Modificar</a></td>
              <td><a href="eliminar_usuario.php?cedula=' . urlencode($usuario->cedula) . '">Eliminar</a></td>
              </tr>';
    }
    echo '</table>';
    echo '<br><a href="crear_usuario.php">Crear usuario</a>';
    echo '<br><a href="crear_tarea.php">Crear tarea</a>';
} else {
    echo '<h2>Mis Datos</h2>';
    echo '<p>Nombres: ' . $usuarioActual->nombres . '</p>';
    echo '<p>Apellidos: ' . $usuarioActual->apellidos . '</p>';
    echo '<p>Edad: ' . $usuarioActual->edad . '</p>';
    echo '<p>Cédula: ' . $usuarioActual->cedula . '</p>';
    echo '<p>Rol: ' . $usuarioActual->rol . '</p>';
    echo '<br><a href="modificar.php?cedula=' . urlencode($usuarioActual->cedula) . '">Modificar mis datos</a>';
}

    echo '<br><a href="listar_tareas.php">Ver tareas</a>';
    echo '<br><a href="terminar_sesion.php">Cerrar sesión</a>';
?>