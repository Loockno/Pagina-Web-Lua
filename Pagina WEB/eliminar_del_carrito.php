<?php
include 'conexion.php';

$id_mezcal = $_POST['id_mezcal'];
$cantidad_a_eliminar = $_POST['cantidad_a_eliminar'];

// Obtén la cantidad actual en el carrito
$stmt = $conn->prepare("SELECT Cantidad FROM carrito_mezcales WHERE ID_mezcal = ?");
$stmt->bind_param("i", $id_mezcal);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$cantidad_actual = $row['Cantidad'];

// Calcula la nueva cantidad
$nueva_cantidad = $cantidad_actual - $cantidad_a_eliminar;

if ($nueva_cantidad > 0) {
    // Actualiza la cantidad en la base de datos
    $stmt = $conn->prepare("UPDATE carrito_mezcales SET Cantidad = ? WHERE ID_mezcal = ?");
    $stmt->bind_param("ii", $nueva_cantidad, $id_mezcal);
    $stmt->execute();
} else {
    // Elimina el producto del carrito
    $stmt = $conn->prepare("DELETE FROM carrito_mezcales WHERE ID_mezcal = ?");
    $stmt->bind_param("i", $id_mezcal);
    $stmt->execute();
}

// Redirige de nuevo al carrito
header('Location: tu_carrito.php');
exit();
?>
