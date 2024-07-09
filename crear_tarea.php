<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
</head>

<body>

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
    
</body>
</html>