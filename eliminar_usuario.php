<?php
require_once "Usuario.php";
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->rol !== 'administrador') {
    header("Location: login.php");
    exit();
}

$cedula = $_GET['cedula'];

$str = file_get_contents("usuarios.json");
$usuarios = json_decode($str, true);

$usuarios = array_filter($usuarios, function($usuario) use ($cedula) {
    return $usuario['cedula'] !== $cedula;
});

file_put_contents("usuarios.json", json_encode(array_values($usuarios)));

header("Location: index.php");
exit();
?>