<?php
session_start(); // Iniciar o reanudar la sesión

include 'conexion.php'; // Incluye el archivo de conexión

if (!isset($_SESSION['ID_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['ID_usuario'];

// Procesar eliminación de un producto del carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_id_mezcal'])) {
    $id_mezcal_eliminar = $_POST['eliminar_id_mezcal'];
    $sql_eliminar = "DELETE FROM carrito_mezcales WHERE ID_mezcal = ? AND ID_carrito IN (SELECT ID_carrito FROM carrito_de_compras WHERE ID_usuario = ?)";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("ii", $id_mezcal_eliminar, $id_usuario);
    $stmt_eliminar->execute();
    $stmt_eliminar->close();
}

// Procesar actualización de la cantidad de un producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar_id_mezcal'])) {
    $id_mezcal_actualizar = $_POST['actualizar_id_mezcal'];
    $nueva_cantidad = $_POST['nueva_cantidad'];
    $sql_actualizar = "UPDATE carrito_mezcales SET Cantidad = ? WHERE ID_mezcal = ? AND ID_carrito IN (SELECT ID_carrito FROM carrito_de_compras WHERE ID_usuario = ?)";
    $stmt_actualizar = $conn->prepare($sql_actualizar);
    $stmt_actualizar->bind_param("iii", $nueva_cantidad, $id_mezcal_actualizar, $id_usuario);
    $stmt_actualizar->execute();
    $stmt_actualizar->close();
}

// Consulta para obtener los detalles del carrito
$sql = "SELECT m.Nombre_mezcal, m.Descripcion, m.Precio, c.Cantidad, m.Imagen_mezcal, m.ID_mezcal 
        FROM carrito_de_compras as cr 
        JOIN carrito_mezcales as c ON cr.ID_carrito = c.ID_carrito
        JOIN mezcales as m ON m.ID_mezcal = c.ID_mezcal
        WHERE cr.ID_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$total = 0;
$totalArticulos = 0;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Mezcalería MezcaLion</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <header></header>
    <div class="mzcl-cart-container">
        <h2 class="mzcl-cart-header">Tu Carrito de Compras</h2>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <div class="mzcl-cart-item">
                <img class="mzcl-cart-image" src="img/<?php echo $fila['Imagen_mezcal']; ?>"
                    alt="<?php echo $fila['Nombre_mezcal']; ?>">
                <div class="mzcl-cart-description">
                    <h4><?php echo $fila['Nombre_mezcal']; ?></h4>
                    <p><?php echo $fila['Descripcion']; ?></p>
                    <p class="mzcl-cart-quantity">Cantidad: <?php echo $fila['Cantidad']; ?></p>
                    <p class="mzcl-cart-price">Precio: $<?php echo $fila['Precio']; ?></p>
                </div>
                <div class="mzcl-cart-actions">
                    <form method="post">
                        <input type="hidden" name="eliminar_id_mezcal" value="<?php echo $fila['ID_mezcal']; ?>">
                        <button type="submit" class="mzcl-cart-action2">Eliminar</button>
                    </form>
                    <form method="post">
                        <input type="hidden" name="actualizar_id_mezcal" value="<?php echo $fila['ID_mezcal']; ?>">
                        <input type="number" name="nueva_cantidad" min="1" value="<?php echo $fila['Cantidad']; ?>"
                            class="mzcl-cart-quantity-input">
                        <button type="submit" class="mzcl-cart-action">Actualizar</button>
                    </form>
                </div>

            </div>
            <?php
            $total += $fila['Precio'] * $fila['Cantidad'];
            $totalArticulos += $fila['Cantidad'];
        } ?>
        <div class="mzcl-cart-summary">
            <h3>Resumen del Pedido</h3>
            <p>Total de Artículos: <?php echo $totalArticulos; ?></p>
            <p>Total a Pagar: $<?php echo $total; ?></p>
            <button class="mzcl-checkout-btn">Proceder al Pago</button>
        </div>
    </div>
    <div id="chat-contenedor"></div>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>