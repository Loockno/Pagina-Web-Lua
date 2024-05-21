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
                <input type="button" value="EDITAR" class="boton-editar" onclick="window.location='editar.php';">
            </div>
        </section>
        <section class="formulario-direccion">
            <h1 class="titulo-direccion">Dirección</h1>
            <?php if (isset($_SESSION['Calle_numero']) && !empty($_SESSION['Calle_numero'])): ?>
                <p><strong>Calle y Número:</strong> <?php echo htmlspecialchars($_SESSION['Calle_numero']); ?></p>
                <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($_SESSION['Ciudad']); ?></p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($_SESSION['Estado']); ?></p>
                <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($_SESSION['Codigo_postal']); ?></p>
                <p><strong>País:</strong> <?php echo htmlspecialchars($_SESSION['Pais']); ?></p>
                <div class="botones-direccion">
                    <input type="button" value="ELIMINAR" class="boton-eliminar-direccion"
                        onclick="window.location='eliminar-direccion.php';">
                    <input type="button" value="EDITAR" class="boton-editar-direccion"
                        onclick="window.location='editar-direccion.php';">
                </div>
            <?php else: ?>
                <p>No hay ninguna dirección agregada.</p>
                <div class="botones-direccion">
                    <input type="button" value="AGREGAR" class="boton-agregar-direccion"
                        onclick="window.location='agregar-direccion.html';">
                </div>
            <?php endif; ?>
        </section>

        <section class="formulario-pago">
            <h1 class="titulo-pago">Pago</h1>
            <?php if (isset($_SESSION['Numero_tarjeta']) && !empty($_SESSION['Numero_tarjeta'])): ?>
                <p><strong>Tipo de Tarjeta:</strong> <?php echo htmlspecialchars($_SESSION['Tipo']); ?></p>
                <p><strong>Número de Tarjeta:</strong> 
                    <span id="num-tarjeta-censurado">**** **** **** <?php echo substr(htmlspecialchars($_SESSION['Numero_tarjeta']), -4); ?></span>
                    <button onclick="toggleCensura('num-tarjeta-censurado', '<?php echo htmlspecialchars($_SESSION['Numero_tarjeta']); ?>')">
                        <img src="img/ojo.png" alt="Toggle Visibilidad" class="icono-ojo">
                    </button>
                </p>
                <p><strong>Nombre en la Tarjeta:</strong> <?php echo htmlspecialchars($_SESSION['Nombre_tarjeta']); ?></p>
                <p><strong>Fecha de Expiración:</strong> <?php echo htmlspecialchars($_SESSION['Fecha_expiracion']); ?></p>
                <p><strong>CVV:</strong> 
                    <span id="cvv-censurado">***</span>
                    <button onclick="toggleCensura('cvv-censurado', '<?php echo htmlspecialchars($_SESSION['CVV']); ?>')">
                        <img src="img/ojo.png" alt="Toggle Visibilidad" class="icono-ojo">
                    </button>
                </p>
                <div class="botones-pago">
                    <input type="button" value="ELIMINAR" class="boton-eliminar-pago" onclick="window.location='eliminar-pago.php';">
                    <input type="button" value="EDITAR" class="boton-editar-pago" onclick="window.location='editar-pago.php';">
                </div>
            <?php else: ?>
                <p>No hay información de pago agregada.</p>
                <div class="botones-pago">
                    <input type="button" value="AGREGAR" class="boton-agregar-pago" onclick="window.location='agregar-pago.html';">
                </div>
            <?php endif; ?>
        </section>
    </div>
    <div id="chat-contenedor"></div>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
    <script>
        function toggleCensura(id, valor) {
            const elemento = document.getElementById(id);
            if (elemento.textContent.includes('*')) {
                elemento.textContent = valor;
            } else {
                if (id === 'num-tarjeta-censurado') {
                    elemento.textContent = '**** **** **** ' + valor.slice(-4);
                } else if (id === 'cvv-censurado') {
                    elemento.textContent = '***';
                }
            }
        }
    </script>
</body>

</html>
