<?php
require_once ("conexion.php");

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

if (!empty($tipo) && $tipo != "Todos") {
    // Filtrar recetas por tipo de mezcal
    $sql = "SELECT Recetas.*, Mezcales.Tipo FROM Recetas JOIN Mezcales ON Recetas.ID_mezcal = Mezcales.ID_mezcal WHERE Mezcales.Tipo = '$tipo'";
} elseif (!empty($buscar)) {
    // Buscar recetas por nombre
    $sql = "SELECT Recetas.*, Mezcales.Tipo FROM Recetas JOIN Mezcales ON Recetas.ID_mezcal = Mezcales.ID_mezcal WHERE Recetas.nombre LIKE '%$buscar%'";
} else {
    // Consulta para obtener todas las recetas
    $sql = "SELECT * FROM Recetas";
}

$recetas = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos.css" />
    <title>Productos</title>
</head>

<body>
    <header>
    </header>
    <main>
        <div class="contenedor-recetas">
            <?php
            while ($fila = mysqli_fetch_assoc($recetas)) {
                ?>
                <div class="carta">
                    <img src="img/<?php echo $fila["Imagen_coctel"]; ?>" alt="<?php echo $fila["nombre"]; ?>">
                    <h3><?php echo $fila["nombre"]; ?></h3>
                    <p>Ver receta</p>
                </div>
                <?php
            }
            ?>
        </div>
    </main>
    <footer></footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>