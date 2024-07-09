<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>

<body>
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
    
</body>
</html>