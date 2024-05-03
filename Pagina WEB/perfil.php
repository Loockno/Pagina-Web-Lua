<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="prueba.css">
    <title>Perfil</title>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.html");
        exit();
    }
    ?>
    <header></header>
    <section class="formulario-perfil">
        <h1 class="titulo-perfil">Perfil del Usuario</h1>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['Nombre']); ?></p>
        <p><strong>Apellido Paterno:</strong> <?php echo htmlspecialchars($_SESSION['Apellido_paterno']); ?></p>
        <p><strong>Apellido Materno:</strong> <?php echo htmlspecialchars($_SESSION['Apellido_materno']); ?></p>
        <p><strong>Celular:</strong> <?php echo htmlspecialchars($_SESSION['Celular']); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($_SESSION['Correo_electronico']); ?></p>
        <div class="botones">
            <input type="button" value="CERRAR SESION" class="boton-cerrar" onclick="window.location='logout.php';">
            <input type="button" value="EDITAR PERFIL" class="boton-editar" onclick="window.location='editar.php';">
        </div>
    </section>
    <section class="formulario-direccion">
        <h1 class="titulo-direccion">Direcion</h1>
        <div class="botones-direccion">
            <input type="button" value="AGREGAR" class="boton-agregar-direccion"
                onclick="window.location='agregar-direcion.php';">
            <input type="button" value="ELIMINAR" class="boton-eliminar-direccion"
                onclick="window.location='eliminar-direcion.php';">
            <input type="button" value="EDITAR" class="boton-editar-direccion"
                onclick="window.location='editar-direcion.php';">
        </div>
    </section>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>