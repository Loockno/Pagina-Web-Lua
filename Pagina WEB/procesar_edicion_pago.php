<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include 'conexion.php';

$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
$numero_tarjeta = filter_input(INPUT_POST, 'numero_tarjeta', FILTER_SANITIZE_STRING);
$nombre_tarjeta = filter_input(INPUT_POST, 'nombre_tarjeta', FILTER_SANITIZE_STRING);
$fecha_expiracion = filter_input(INPUT_POST, 'fecha_expiracion', FILTER_SANITIZE_STRING);
$cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);

// Preparar la consulta para actualizar el método de pago
$query = "UPDATE metodos_pago SET Tipo = ?, Numero_tarjeta = ?, Nombre_tarjeta = ?, Fecha_expiracion = ?, CVV = ? WHERE ID_usuario = ?";
$params = "sssssi";
$param_array = [&$tipo, &$numero_tarjeta, &$nombre_tarjeta, &$fecha_expiracion, &$cvv, &$_SESSION['ID_usuario']];

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param($params, ...$param_array);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Método de pago actualizado con éxito.";
        // Actualiza también los datos de método de pago en la sesión si es necesario
        $_SESSION['Tipo'] = $tipo;
        $_SESSION['Numero_tarjeta'] = $numero_tarjeta;
        $_SESSION['Nombre_tarjeta'] = $nombre_tarjeta;
        $_SESSION['Fecha_expiracion'] = $fecha_expiracion;
        $_SESSION['CVV'] = $cvv;
    } else {
        echo "No se han hecho cambios en los datos del método de pago.";
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();
header("Location: perfil.php"); // Redirigir de vuelta al perfil
exit();
?>
