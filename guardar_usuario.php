<?php
require_once 'Usuario.php';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$cedula = $_POST['cedula'];
$contrasena = $_POST['contrasena'];
$rol = $_POST['rol'];

$str = file_get_contents("usuarios.json");
$datos = json_decode($str, true);

$nuevoUsuario = new Usuario($nombres, $apellidos, $edad, $cedula, $contrasena, $rol);
$datos[] = (array)$nuevoUsuario;

file_put_contents("usuarios.json", json_encode($datos));

header("Location: index.php");
exit();
?>