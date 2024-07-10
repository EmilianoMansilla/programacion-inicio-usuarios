<?php
session_start();
require_once 'Usuario.php';

$mensajeError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    $str = file_get_contents("usuarios.json");
    $datos = json_decode($str, true);

    if (!empty($cedula) && !empty($contrasena)) {
        $usuarioEncontrado = false;
        foreach ($datos as $dato) {
            if ($dato['cedula'] === $cedula && $dato['contrasena'] === $contrasena) {
                $_SESSION['usuario'] = new Usuario($dato["nombres"], $dato["apellidos"], $dato["edad"], $dato["cedula"], $dato["contrasena"], $dato["rol"]);
                $usuarioEncontrado = true;
                break;
            }
        }

        if ($usuarioEncontrado) {
            header("Location: index.php");
            exit();
        } else {
            $mensajeError = "Cédula o contraseña incorrecta.";
        }
    }
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
    <title>Bienvenidos</title>
</head>

<body>
    <header class="border">
        <nav>
            <div>
                <a href="login.php">
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
                    <li><a href="crear_usuario.php">Registrarme</a></li>
                </ul>
            </div>
        </nav>
    </header>

        <form id="loginForm" method="POST" action="">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required><br><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required><br><br>
            <input type="submit" value="Iniciar sesión">
        </form>
        
        <?php if (!empty($mensajeError)) : ?>
            <p><?php echo $mensajeError; ?></p>
        <?php endif; ?>

      <!-- Footer -->
      <footer class="border">
        <hr>
        <h4>&copy; Copyright 2024 (c) Emiliano Mansilla Maciel</h4>
    </footer>
</body>
</html>
