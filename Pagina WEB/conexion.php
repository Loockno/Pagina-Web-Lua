<?php
$servidor = "localhost";
$usuario = "Mezcalion";
$contrasena = "Morelia";
$dbname = "mezcaleria";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
?>