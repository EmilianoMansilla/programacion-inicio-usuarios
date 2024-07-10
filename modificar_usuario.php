<?php
require_once 'Usuario.php';
session_start();

$cedulaActual = $_POST['cedulaActual'];
$nuevosNombres = $_POST['nuevosNombres'];
$nuevosApellidos = $_POST['nuevosApellidos'];
$nuevaEdad = $_POST['nuevaEdad'];
$nuevaCedula = $_POST['nuevaCedula'];
$nuevaContrasena = $_POST['nuevaContrasena'];
$nuevoRol = $_POST['nuevoRol'];

$str = file_get_contents("usuarios.json");
$datos = json_decode($str, true);

$usuarioActual = $_SESSION['usuario'];

if ($usuarioActual->cedula === $cedulaActual && $nuevoRol === 'administrador') {
    echo 'No tienes permiso para cambiar tu rol a administrador.';
    exit();
}

if ($usuarioActual->rol !== 'administrador' && $nuevoRol === 'administrador') {
    echo 'No tienes permiso para cambiar el rol a administrador.';
    exit();
}

foreach ($datos as &$dato) {
    if ($dato['cedula'] === $cedulaActual) {
        $dato['nombres'] = $nuevosNombres;
        $dato['apellidos'] = $nuevosApellidos;
        $dato['edad'] = $nuevaEdad;
        $dato['cedula'] = $nuevaCedula;
        $dato['contrasena'] = $nuevaContrasena;
        $dato['rol'] = $nuevoRol;
        break;
    }
}

file_put_contents("usuarios.json", json_encode($datos));

header("Location: index.php");
exit();
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
    <title>Modificar usuario</title>
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

      <!-- Footer -->
      <footer class="border">
        <hr>
        <h4>&copy; Copyright 2024 (c) Emiliano Mansilla Maciel</h4>
    </footer>
</body>
</html>