<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="procesar_login.php">
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" required><br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>