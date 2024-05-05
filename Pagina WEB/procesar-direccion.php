<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include 'conexion.php';

// Recoger y sanitizar los datos del formulario
$calle_numero = filter_input(INPUT_POST, 'calle_numero', FILTER_SANITIZE_STRING);
$ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_STRING);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
$codigo_postal = filter_input(INPUT_POST, 'codigo_postal', FILTER_SANITIZE_STRING);
$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);

// Preparar la consulta para insertar la nueva dirección
$query = "INSERT INTO direcciones (ID_usuario, Calle_numero, Ciudad, Estado, Codigo_postal, Pais) VALUES (?, ?, ?, ?, ?, ?)";
if ($stmt = $conn->prepare($query)) {
    // Asegúrate de que ID_usuario está definido en $_SESSION si es requerido como foreign key
    $stmt->bind_param("isssss", $_SESSION['ID_usuario'], $calle_numero, $ciudad, $estado, $codigo_postal, $pais);
    if ($stmt->execute()) {
        echo "Dirección agregada con éxito.";
        // Actualizar las variables de sesión
        $_SESSION['Calle_numero'] = $calle_numero;
        $_SESSION['Ciudad'] = $ciudad;
        $_SESSION['Estado'] = $estado;
        $_SESSION['Codigo_postal'] = $codigo_postal;
        $_SESSION['Pais'] = $pais;

        // Redirigir al perfil o página de éxito
        header("Location: perfil.php");
        exit();
    } else {
        echo "Error al agregar la dirección: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
?>
