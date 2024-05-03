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
    // Verificación exitosa de la contraseña
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
        $_SESSION['usuario'] = $usuario['Nombre'];  // Indicador de usuario logueado

        // Cargar información adicional como dirección y pago
        // Asumiendo que existe una tabla 'direcciones' y 'pagos' relacionadas con 'usuarios'
        $stmt_dir = $conn->prepare("SELECT * FROM direcciones WHERE ID_usuario = ?");
        $stmt_dir->bind_param("i", $usuario['ID_usuario']);
        $stmt_dir->execute();
        $resultado_dir = $stmt_dir->get_result();
        if ($resultado_dir->num_rows > 0) {
            $direccion = $resultado_dir->fetch_assoc();
            $_SESSION['Calle_numero'] = $direccion['Calle_numero'];
            $_SESSION['Ciudad'] = $direccion['Ciudad'];
            $_SESSION['Estado'] = $direccion['Estado'];
            $_SESSION['Codigo_postal'] = $direccion['Codigo_postal'];
            $_SESSION['Pais'] = $direccion['Pais'];
        }

        $stmt_pago = $conn->prepare("SELECT * FROM metodos_pago WHERE ID_usuario = ?");
        $stmt_pago->bind_param("i", $usuario['ID_usuario']);
        $stmt_pago->execute();
        $resultado_pago = $stmt_pago->get_result();
        if ($resultado_pago->num_rows > 0) {
            $pago = $resultado_pago->fetch_assoc();
            $_SESSION['Tipo'] = $pago['Tipo'];
            $_SESSION['Numero_tarjeta'] = $pago['Numero_tarjeta'];
            $_SESSION['Nombre_tarjeta'] = $pago['Nombre_tarjeta'];
            $_SESSION['Fecha_expiracion'] = $pago['Fecha_expiracion'];
            $_SESSION['CVV'] = $pago['CVV'];
        }

        // Redirige al usuario a la página de inicio o al perfil
        header("Location: index.php");
        exit();
    } else {
        // Manejo de error si la contraseña no coincide
        echo '<script type="text/javascript">';
        echo 'alert("Contraseña o Usuario incorrecto.");';
        echo 'setTimeout(function(){';
        echo '    window.location.href = "login.html";';
        echo '}, 100);';
        echo '</script>';
        exit();
    }

} else {
    die('No existe ningún usuario con ese correo electrónico.');
}

$conn->close();
?>