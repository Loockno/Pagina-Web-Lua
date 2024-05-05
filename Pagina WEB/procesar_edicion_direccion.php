<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include 'conexion.php';

$calle_numero = filter_input(INPUT_POST, 'calle_numero', FILTER_SANITIZE_STRING);
$ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
$codigo_postal = filter_input(INPUT_POST, 'codigo_postal', FILTER_SANITIZE_STRING);
$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);

// Preparar la consulta para actualizar la dirección
$query = "UPDATE direcciones SET Calle_numero = ?, Ciudad = ?, Estado = ?, Codigo_postal = ?, Pais = ? WHERE ID_usuario = ?";
$params = "sssssi";
$param_array = [&$calle_numero, &$ciudad, &$estado, &$codigo_postal, &$pais, &$_SESSION['ID_usuario']];

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param($params, ...$param_array);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Dirección actualizada con éxito.";
        // Actualiza también los datos de dirección en la sesión si es necesario
        $_SESSION['Calle_numero'] = $calle_numero;
        $_SESSION['Ciudad'] = $ciudad;
        $_SESSION['Estado'] = $estado;
        $_SESSION['Codigo_postal'] = $codigo_postal;
        $_SESSION['Pais'] = $pais;
    } else {
        echo "No se han hecho cambios en los datos de dirección.";
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}

$conn->close();
header("Location: perfil.php"); // Redirigir de vuelta al perfil
exit();
?>
