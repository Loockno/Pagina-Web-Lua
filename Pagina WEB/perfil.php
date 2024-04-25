<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Inicia la sesión para acceder a las variables de sesión
    session_start();

    // Verifica si el usuario está logueado, si no, redirige a login.html
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.html");
        exit();
    }

    // Aquí asumimos que almacenas los datos del usuario en variables de sesión
    // Después del inicio de sesión exitoso
    ?>
    <header></header>
    <section class="formulario">
        <h1 class="titulo">Perfil del Usuario</h1>
        <p><strong>ID Usuario:</strong> <?php echo htmlspecialchars($_SESSION['ID_usuario']); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['Nombre']); ?></p>
        <p><strong>Apellido Paterno:</strong> <?php echo htmlspecialchars($_SESSION['Apellido_paterno']); ?></p>
        <p><strong>Apellido Materno:</strong> <?php echo htmlspecialchars($_SESSION['Apellido_materno']); ?></p>
        <p><strong>Celular:</strong> <?php echo htmlspecialchars($_SESSION['Celular']); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($_SESSION['Correo_electronico']); ?></p>
        <!-- No mostrar la contraseña por razones de seguridad -->
        <div class="botones">
            <input type="button" value="CERRAR SESION" class="boton-cerrar" onclick="window.location='logout.php';">
        </div>
    </section>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>