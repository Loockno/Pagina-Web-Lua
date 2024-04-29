<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfin</title>
</head>

<body>
    <header></header>
    <section class="formulario">
        <div class="titulo">
            <h1>EDITA TU PERFIL</h1>
        </div>
        <form method="POST" action="procesar_edicion.php">
            <!-- Campos existentes -->
            <input type="email" id="correo" name="correo" placeholder="Correo"
                value="<?php echo htmlspecialchars($_SESSION['Correo_electronico']); ?>" required>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre"
                value="<?php echo htmlspecialchars($_SESSION['Nombre']); ?>" required>
            <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno"
                value="<?php echo htmlspecialchars($_SESSION['Apellido_paterno']); ?>" required>
            <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno"
                value="<?php echo htmlspecialchars($_SESSION['Apellido_materno']); ?>" required>
            <input type="tel" id="telefono" name="telefono" placeholder="Teléfono"
                value="<?php echo htmlspecialchars($_SESSION['Celular']); ?>" autocomplete="off" required>

            <!-- Nuevos campos para contraseña -->
            <input type="password" id="nueva_contrasena" name="nueva_contrasena" placeholder="Nueva Contraseña"
                autocomplete="off">
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"
                placeholder="Confirmar Contraseña" autocomplete="off">

            <div class="botones">
                <input type="button" value="VOLVER" class="boton-volver" onclick="window.location='perfil.php';">
                <input type="submit" value="ACTUALIZAR" class="boton-continuar">
            </div>
        </form>

    </section>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>