<?php
session_start(); 
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
include "conexion.php";

if (isset($_POST["idMezcal"], $_POST["cantidad"]) && isset($_SESSION['ID_usuario'])) {
    $idMezcal = $_POST["idMezcal"];
    $cantidad = $_POST["cantidad"];
    $idUsuario = $_SESSION['ID_usuario'];

    // Buscar el ID del carrito del usuario
    $stmt_carrito = $conn->prepare("SELECT ID_carrito FROM carrito_de_compras WHERE ID_usuario = ?");
    $stmt_carrito->bind_param("i", $idUsuario);
    $stmt_carrito->execute();
    $resultado_carrito = $stmt_carrito->get_result();
    $stmt_carrito->close();

    if ($fila = $resultado_carrito->fetch_assoc()) {
        $idCarrito = $fila['ID_carrito'];
        
        // Verificar si el mezcal ya está en el carrito
        $stmt = $conn->prepare("SELECT * FROM carrito_mezcales WHERE ID_mezcal = ? AND ID_carrito = ?");
        $stmt->bind_param("ii", $idMezcal, $idCarrito);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Actualizar la cantidad si el producto ya está en el carrito
            $fila_detalle = $resultado->fetch_assoc();
            $nuevaCantidad = $fila_detalle['Cantidad'] + $cantidad;
            $stmt_update = $conn->prepare("UPDATE carrito_mezcales SET Cantidad = ? WHERE ID_mezcal = ? AND ID_carrito = ?");
            $stmt_update->bind_param("iii", $nuevaCantidad, $idMezcal, $idCarrito);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            // Añadir el producto al carrito si no está
            $stmt_insert = $conn->prepare("INSERT INTO carrito_mezcales (ID_carrito, ID_mezcal, Cantidad) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("iii", $idCarrito, $idMezcal, $cantidad);
            $stmt_insert->execute();
            $stmt_insert->close();
        }
        echo "Producto añadido al carrito.";
    } else {
        echo "No se encontró un carrito para el usuario.";
    }
} else {
    echo "Información del producto requerida o usuario no logueado.";
}

$conn->close();
?>
