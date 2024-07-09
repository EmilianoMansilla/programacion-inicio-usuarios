<?php
session_start();
require_once 'Usuario.php';

$cedula = $_POST['cedula'];
$contrasena = $_POST['contrasena'];

$str = file_get_contents("usuarios.json");
$datos = json_decode($str, true);

foreach ($datos as $dato) {
    if ($dato['cedula'] === $cedula && $dato['contrasena'] === $contrasena) {
        
        $_SESSION['usuario'] = new Usuario($dato["nombres"], $dato["apellidos"], $dato["edad"], $dato["cedula"], $dato["contrasena"], $dato["rol"]);
    
        header("Location: index.php");
        exit();
    }
}

echo "Cédula o contraseña incorrecta.";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}
?>