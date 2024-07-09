<?php
$nombreActual = $_POST['nombre'];
$finalizada = $_POST['finalizada'];

$str = file_get_contents("tareas.json");
$tareas = json_decode($str, true);

foreach ($tareas as &$tarea) {
    if ($tarea['nombre'] === $nombreActual) {
        $tarea['finalizada'] = (bool)$finalizada;
        break;
    }
}

file_put_contents("tareas.json", json_encode($tareas));

header("Location: listar_tareas.php");
exit();
?>