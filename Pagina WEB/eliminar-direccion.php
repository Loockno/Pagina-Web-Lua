<?php
session_start(); // Esta línea es crucial para poder usar $_SESSION

include 'conexion.php';

// ID del usuario autenticado
$usuario_id = $_SESSION['ID_usuario'];

// Preparar la consulta para eliminar la dirección
$query = "DELETE FROM direcciones WHERE ID_usuario = ?";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Dirección eliminada con éxito.";
        // Limpiar las variables de sesión relacionadas con la dirección si es necesario
        unset($_SESSION['Calle_numero']);
        unset($_SESSION['Ciudad']);
        unset($_SESSION['Estado']);
        unset($_SESSION['Codigo_postal']);
        unset($_SESSION['Pais']);
    } else {
        echo "No se encontró la dirección o ya fue eliminada.";
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();

header("Location: perfil.php"); // Redirigir de vuelta al perfil
exit();
?>
