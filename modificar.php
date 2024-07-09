<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
</head>
<body>
    <?php
        require_once 'Usuario.php';
        session_start();

        $cedula = $_GET['cedula'];
        $str = file_get_contents("usuarios.json");
        $datos = json_decode($str, true);

        $usuarioActual = $_SESSION['usuario'];
        $usuario = null;

        foreach ($datos as $dato){
            if ($dato['cedula'] === $cedula) {
                $usuario = $dato;
                break;
            }
        }

        if ($usuarioActual->rol === 'administrador' || $usuarioActual->cedula === $usuario['cedula']) {
            $editable = true;
        } else {
            $editable = false;
        }
    ?>

    <form method="POST" action="modificar_usuario.php">
        <input type="hidden" id="cedulaActual" name="cedulaActual" value="<?php echo $usuario['cedula']; ?>">
        <label for="nuevosNombres">Nuevos Nombres:</label>
        <input type="text" id="nuevosNombres" name="nuevosNombres" value="<?php echo $usuario['nombres']; ?>" required><br><br>
        <label for="nuevosApellidos">Nuevos Apellidos:</label>
        <input type="text" id="nuevosApellidos" name="nuevosApellidos" value="<?php echo $usuario['apellidos']; ?>" required><br><br>
        <label for="nuevaEdad">Nueva Edad:</label>
        <input type="number" id="nuevaEdad" name="nuevaEdad" value="<?php echo $usuario['edad']; ?>" required><br><br>
        <label for="nuevaCedula">Nueva Cédula:</label>
        <input type="text" id="nuevaCedula" name="nuevaCedula" value="<?php echo $usuario['cedula']; ?>" required><br><br>
        <label for="nuevaContrasena">Nueva Contraseña:</label>
        <input type="password" id="nuevaContrasena" name="nuevaContrasena" value="<?php echo $usuario['contrasena']; ?>" required><br><br>
        <label for="nuevoRol">Nuevo Rol:</label>
        <?php if ($usuarioActual->rol === 'administrador' || $usuarioActual->cedula === $usuario['cedula']) { ?>
        <select id="nuevoRol" name="nuevoRol">
            <option value="administrador" <?php echo ($usuario['rol'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
            <option value="basico" <?php echo ($usuario['rol'] == 'basico') ? 'selected' : ''; ?>>Básico</option>
        </select>
        <?php } else { ?>
        <input type="hidden" id="nuevoRol" name="nuevoRol" value="<?php echo $usuario['rol']; ?>">
        <?php } ?><br><br>
        <input type="submit" value="Modificar">
    </form>
</body>
</html>