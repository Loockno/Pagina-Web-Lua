<?php
session_start(); // Esta línea es crucial para poder usar $_SESSION

include 'conexion.php';

// ID del usuario autenticado
$usuario_id = $_SESSION['ID_usuario'];

// Preparar la consulta para eliminar el método de pago
$query = "DELETE FROM metodos_pago WHERE ID_usuario = ?";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Método de pago eliminado con éxito.";
        // Limpiar las variables de sesión relacionadas con el método de pago si es necesario
        unset($_SESSION['Tipo']);
        unset($_SESSION['Numero_tarjeta']);
        unset($_SESSION['Nombre_tarjeta']);
        unset($_SESSION['Fecha_expiracion']);
        unset($_SESSION['CVV']);
    } else {
        echo "No se encontró el método de pago o ya fue eliminado.";
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();

header("Location: perfil.php"); // Redirigir de vuelta al perfil
exit();
?>
