<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include 'conexion.php';

$correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$apellido_paterno = filter_input(INPUT_POST, 'apellido_paterno', FILTER_SANITIZE_STRING);
$apellido_materno = filter_input(INPUT_POST, 'apellido_materno', FILTER_SANITIZE_STRING);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$nueva_contrasena = $_POST['nueva_contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];

if (!empty($nueva_contrasena) && ($nueva_contrasena === $confirmar_contrasena)) {
    $contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
    $query = "UPDATE usuarios SET Correo_electronico = ?, Nombre = ?, Apellido_paterno = ?, Apellido_materno = ?, Celular = ?, Contraseña = ? WHERE ID_usuario = ?";
    $params = "ssssssi";
    $param_array = [&$correo, &$nombre, &$apellido_paterno, &$apellido_materno, &$telefono, &$contrasena_hash, &$_SESSION['ID_usuario']];
} else {
    $query = "UPDATE usuarios SET Correo_electronico = ?, Nombre = ?, Apellido_paterno = ?, Apellido_materno = ?, Celular = ? WHERE ID_usuario = ?";
    $params = "sssssi";
    $param_array = [&$correo, &$nombre, &$apellido_paterno, &$apellido_materno, &$telefono, &$_SESSION['ID_usuario']];
}

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param($params, ...$param_array);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Datos actualizados con éxito.";
        // Actualiza también los datos en la sesión si es necesario.
        $_SESSION['Correo_electronico'] = $correo;
        $_SESSION['Nombre'] = $nombre;
        $_SESSION['Apellido_paterno'] = $apellido_paterno;
        $_SESSION['Apellido_materno'] = $apellido_materno;
        $_SESSION['Celular'] = $telefono;
    } else {
        echo "No se han hecho cambios en los datos.";
    }
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $conn->error;
}
$conn->close();
header("Location: perfil.php");
exit();
?>
