<?php
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$usuario = $_POST['usuario'];

$str = file_get_contents("tareas.json");
$tareas = json_decode($str, true);

$nuevaTarea = [
    'nombre' => $nombre,
    'descripcion' => $descripcion,
    'fecha_inicio' => $fecha_inicio,
    'fecha_fin' => $fecha_fin,
    'finalizada' => false,
    'usuario' => $usuario
];
$tareas[] = $nuevaTarea;

file_put_contents("tareas.json", json_encode($tareas));

header("Location: index.php");
exit();
?>