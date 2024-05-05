<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navegación</title>
    <link rel="stylesheet" href="estilos.css" />
</head>

<body>
    <?php
    session_start(); // Asegúrate de llamar a session_start() al principio

    // Decide qué enlace mostrar basado en si el usuario está logueado
    $enlaceUsuario = isset($_SESSION['usuario']) ? 'perfil.php' : 'login.html';
    ?>
    <nav class="menu">
        <div class="Logo">
            <a href="index.php"><img src="img/MEZCALIÓN.svg" alt="Image 1" /></a>
            <a href="index.php"><img src="img/logo 2.svg" alt="Image 2" /></a>
        </div>
        <div class="Apartados">
            <a href="index.php" id="link-inicio"><img src="img/INICIO.svg" alt="Image 3" id="img-inicio"/></a>
            <a href="productos.php" id="link-productos"><img src="img/PRODUCTOS.svg" alt="Image 4" id="img-productos"/></a>
            <a href="recetas.php" id="link-recetas"><img src="img/recetas.svg" alt="Image 6" id="img-recetas"></a>
            <a href="nosotros.html" id="link-nosotros"><img src="img/NOSOTROS.svg" alt="Image 5" id="img-nosotros"/></a>
        </div>
        <div class="Iconos">
            <a href="carrito.php"><img src="img/bolsa-de-la-compra 1.svg" alt="Image 7" /></a>
            <a href="<?= $enlaceUsuario ?>"><img src="img/usuario 1.svg" alt="Usuario" /></a>
        </div>
        </div>
    </nav>
</body>

</html>