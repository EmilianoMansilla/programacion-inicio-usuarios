<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre = $_GET['nombre'];

$str = file_get_contents("tareas.json");
$tareas = json_decode($str, true);

$tareas = array_filter($tareas, function($tarea) use ($nombre) {
    return $tarea['nombre'] !== $nombre;
});

file_put_contents("tareas.json", json_encode(array_values($tareas)));

header("Location: listar_tareas.php");
exit();
?>