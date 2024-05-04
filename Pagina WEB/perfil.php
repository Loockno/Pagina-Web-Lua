<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
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
    <div class="apartados-perfil">
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
            <h1 class="titulo-direccion">Dirección</h1>
            <p><strong>Calle y Número:</strong> <?php echo htmlspecialchars($_SESSION['Calle_numero']); ?></p>
            <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($_SESSION['Ciudad']); ?></p>
            <p><strong>Estado:</strong> <?php echo htmlspecialchars($_SESSION['Estado']); ?></p>
            <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($_SESSION['Codigo_postal']); ?></p>
            <p><strong>País:</strong> <?php echo htmlspecialchars($_SESSION['Pais']); ?></p>
            <div class="botones-direccion">
                <input type="button" value="AGREGAR" class="boton-agregar-direccion"
                    onclick="window.location='agregar-direccion.php';">
                <input type="button" value="ELIMINAR" class="boton-eliminar-direccion"
                    onclick="window.location='eliminar-direccion.php';">
                <input type="button" value="EDITAR" class="boton-editar-direccion"
                    onclick="window.location='editar-direccion.php';">
            </div>
        </section>

        <section class="formulario-pago">
            <h1 class="titulo-pago">Pago</h1>
            <p><strong>Tipo de Tarjeta:</strong> <?php echo htmlspecialchars($_SESSION['Tipo']); ?></p>
            <p><strong>Número de Tarjeta:</strong> <?php echo htmlspecialchars($_SESSION['Numero_tarjeta']); ?></p>
            <p><strong>Nombre en la Tarjeta:</strong> <?php echo htmlspecialchars($_SESSION['Nombre_tarjeta']); ?></p>
            <p><strong>Fecha de Expiración:</strong> <?php echo htmlspecialchars($_SESSION['Fecha_expiracion']); ?></p>
            <p><strong>CVV:</strong> <?php echo htmlspecialchars($_SESSION['CVV']); ?></p>
            <div class="botones-pago">
                <input type="button" value="AGREGAR" class="boton-agregar-pago"
                    onclick="window.location='agregar-pago.php';">
                <input type="button" value="ELIMINAR" class="boton-eliminar-pago"
                    onclick="window.location='eliminar-pago.php';">
                <input type="button" value="EDITAR" class="boton-editar-pago"
                    onclick="window.location='editar-pago.php';">
            </div>
        </section>

    </div>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>