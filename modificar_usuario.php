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