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
    <title>Editar Método de Pago</title>
</head>

<body>
    <header></header>
    <section class="formulario">
        <div class="titulo">
            <h1>EDITA TU MÉTODO DE PAGO</h1>
        </div>
        <form method="POST" action="procesar_edicion_pago.php">
            <input type="text" id="tipo" name="tipo" placeholder="Tipo de Tarjeta (Visa, MasterCard, etc.)"
                value="<?php echo htmlspecialchars($_SESSION['Tipo']); ?>" required>
            <input type="text" id="numero_tarjeta" name="numero_tarjeta" placeholder="Número de Tarjeta"
                value="<?php echo htmlspecialchars($_SESSION['Numero_tarjeta']); ?>" required>
            <input type="text" id="nombre_tarjeta" name="nombre_tarjeta" placeholder="Nombre en la Tarjeta"
                value="<?php echo htmlspecialchars($_SESSION['Nombre_tarjeta']); ?>" required>
            <input type="text" id="fecha_expiracion" name="fecha_expiracion" placeholder="Fecha de Expiración (MM/AA)"
                value="<?php echo htmlspecialchars($_SESSION['Fecha_expiracion']); ?>" required>
            <input type="text" id="cvv" name="cvv" placeholder="CVV"
                value="<?php echo htmlspecialchars($_SESSION['CVV']); ?>" required>

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
