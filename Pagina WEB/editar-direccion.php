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
    <title>Editar Direccion</title>
</head>

<body>
    <header></header>
    <section class="formulario">
        <div class="titulo">
            <h1>EDITA TU DIRECCION</h1>
        </div>
        <form method="POST" action="procesar_edicion_direccion.php">
        <input type="text" id="calle_numero" name="calle_numero" placeholder="Calle y Número"
                value="<?php echo htmlspecialchars($_SESSION['Calle_numero']); ?>" required>
            <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad"
                value="<?php echo htmlspecialchars($_SESSION['Ciudad']); ?>" required>
            <input type="text" id="estado" name="estado" placeholder="Estado"
                value="<?php echo htmlspecialchars($_SESSION['Estado']); ?>" required>
            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Código Postal"
                value="<?php echo htmlspecialchars($_SESSION['Codigo_postal']); ?>" required>
            <input type="text" id="pais" name="pais" placeholder="País"
                value="<?php echo htmlspecialchars($_SESSION['Pais']); ?>" required>

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