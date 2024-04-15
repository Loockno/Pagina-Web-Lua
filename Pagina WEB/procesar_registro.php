<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Recibe los datos del formulario de registro
$correo_electronico = $_POST['correo'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];

// Verifica que las contraseñas coincidan
if ($contrasena !== $confirmar_contrasena) {
    die('Las contraseñas no coinciden.');
}

// Prepara la consulta para verificar que el correo no esté ya registrado
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE Correo_electronico = ?");
$stmt->bind_param("s", $correo_electronico);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<script type='text/javascript'>
            alert('Este correo ya está registrado.');
            window.location = 'login.html';
          </script>";
    exit();
}

// Inserta el nuevo usuario en la base de datos
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuarios (Nombre, Apellido_paterno, Apellido_materno, Celular, Correo_electronico, Contraseña) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nombre, $apellido_paterno, $apellido_materno, $telefono, $correo_electronico, $contrasena_hash);

if ($stmt->execute()) {
    echo "Usuario registrado exitosamente.";
    header("Refresh: 3; url=index.html");

} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>