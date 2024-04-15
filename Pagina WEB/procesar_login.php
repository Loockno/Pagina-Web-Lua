<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Recibe los datos del formulario de inicio de sesión
$correo_electronico = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Prepara la consulta para buscar el usuario en la base de datos
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE Correo_electronico = ?");
$stmt->bind_param("s", $correo_electronico);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($contrasena, $usuario['Contraseña'])) { // Asegúrate de que 'Contraseña' es el nombre de la columna en tu BD
        // Inicia una nueva sesión
        session_start();
        $_SESSION['usuario'] = $usuario['Nombre']; // Cambiado a 'Nombre' como parece ser en tu BD
        header("Refresh: 3; url=index.html");
    } else {
        die('La contraseña es incorrecta.');
    }
} else {
    die('No existe ningún usuario con ese correo electrónico.');
}

$conn->close();
?>
