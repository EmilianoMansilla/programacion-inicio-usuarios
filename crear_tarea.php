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
    <title>Crear tarea</title>
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

    <?php
    require_once 'Usuario.php';
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }

    if (!isset($_SESSION['usuarios'])) {
        header("Location: index.php");
        exit();
    }

    $usuarios = $_SESSION['usuarios'];
    ?>

    <form method="POST" action="guardar_tarea.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required><br><br>
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>
        <label for="fecha_fin">Fecha de Final:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required><br><br>
        <label for="usuario">Usuario:</label>
        <select id="usuario" name="usuario" required>
            <?php
            foreach ($usuarios as $usuario) {
                echo '<option value="' . $usuario->cedula . '">' . $usuario->nombres . ' ' . $usuario->apellidos . '</option>';
            }
            ?>
        </select><br><br>
        <input type="submit" value="Crear">
    </form>

    <!-- Footer -->
    <footer class="border">
        <hr>
        <h4>&copy; Copyright 2024 (c) Emiliano Mansilla Maciel</h4>
    </footer>
</body>
</html>