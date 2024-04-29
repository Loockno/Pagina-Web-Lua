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
    if (password_verify($contrasena, $usuario['Contraseña'])) { 
        // Inicia una nueva sesión
        session_start();
        // Establece las variables de sesión con la información del usuario
        $_SESSION['ID_usuario'] = $usuario['ID_usuario'];
        $_SESSION['Nombre'] = $usuario['Nombre'];
        $_SESSION['Apellido_paterno'] = $usuario['Apellido_paterno'];
        $_SESSION['Apellido_materno'] = $usuario['Apellido_materno'];
        $_SESSION['Celular'] = $usuario['Celular'];
        $_SESSION['Correo_electronico'] = $usuario['Correo_electronico'];
        // Esta es la línea que agregas para tener un indicador de usuario logueado
        $_SESSION['usuario'] = $usuario['Nombre'];

        // Redirige al usuario a la página de inicio o al perfil
        header("Location: index.php");
        exit();
    } else {
        die('La contraseña es incorrecta.');
    }
} else {
    die('No existe ningún usuario con ese correo electrónico.');
}

$conn->close();
?>
