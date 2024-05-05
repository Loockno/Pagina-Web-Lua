<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include 'conexion.php';

// Recoger y sanitizar los datos del formulario
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
$numero_tarjeta = filter_input(INPUT_POST, 'numero_tarjeta', FILTER_SANITIZE_STRING);
$nombre_tarjeta = filter_input(INPUT_POST, 'nombre_tarjeta', FILTER_SANITIZE_STRING);
$fecha_expiracion = filter_input(INPUT_POST, 'fecha_expiracion', FILTER_SANITIZE_STRING);
$cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);

// Preparar la consulta para insertar el nuevo método de pago
$query = "INSERT INTO metodos_pago (ID_usuario, Tipo, Numero_tarjeta, Nombre_tarjeta, Fecha_expiracion, CVV) VALUES (?, ?, ?, ?, ?, ?)";
if ($stmt = $conn->prepare($query)) {
    // Asegúrate de que ID_usuario está definido en $_SESSION si es requerido como foreign key
    $stmt->bind_param("isssss", $_SESSION['ID_usuario'], $tipo, $numero_tarjeta, $nombre_tarjeta, $fecha_expiracion, $cvv);
    if ($stmt->execute()) {
        echo "Método de pago agregado con éxito.";
        // Actualizar las variables de sesión
        $_SESSION['Tipo'] = $tipo;
        $_SESSION['Numero_tarjeta'] = $numero_tarjeta;
        $_SESSION['Nombre_tarjeta'] = $nombre_tarjeta;
        $_SESSION['Fecha_expiracion'] = $fecha_expiracion;
        $_SESSION['CVV'] = $cvv;

        // Redirigir al perfil o página de éxito
        header("Location: perfil.php");
        exit();
    } else {
        echo "Error al agregar el método de pago: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>
