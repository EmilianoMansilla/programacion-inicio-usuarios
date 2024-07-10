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
    <title>Crear usuario</title>
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

    <form method="POST" action="guardar_usuario.php">
        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" required><br><br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required><br><br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required><br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="administrador">Administrador</option>
            <option value="basico">Básico</option>
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