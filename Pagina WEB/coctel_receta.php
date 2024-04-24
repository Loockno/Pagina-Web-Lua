<?php
require_once "conexion.php";
$id = "";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$sql_query = "SELECT * FROM recetas WHERE ID_receta = $id";
$result = $conn->query($sql_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalles del Cóctel</title>
    <link rel="stylesheet" href="estilos.css" />
</head>
<body>
    <header>
    </header>
    <div class="contenedor-producto">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="imagen">
                <img src="img/<?php echo $row["Imagen_coctel"]; ?>" alt="Imagen del cóctel">
                </div>
                <div class="informacion_producto">
                    <h1><?php echo $row["nombre"]; ?></h1>
                    <h3>Ingredientes:</h3>
                        <ul>
                            <?php
                            $ingredientes = explode(',', $row["ingredientes"]);
                            foreach ($ingredientes as $ingrediente) {
                                echo "<li><p>" . trim($ingrediente) . "</p></li>";
                            }
                            ?>
                        </ul>

                        <h3>Preparación:</h3>
                        <ol>
                            <?php
                            // Asumiendo que cada instrucción comienza con un número seguido de un punto y un espacio ("1. ", "2. ", etc.)
                            $instrucciones = preg_split('/\d+\.\s*/', $row["instrucciones"], -1, PREG_SPLIT_NO_EMPTY);
                            foreach ($instrucciones as $instruccion) {
                                echo "<li><p>" . trim($instruccion) . "</p></li>";
                            }
                            ?>
                        </ol>
                </div>
                <?php
            }
        } else {
            echo "<p>Coctel no encontrado.</p>";
        }
        ?>
    </div>
    <footer>
    </footer>
    <script src="js/barras de navegacion.js"></script>
</body>
</html>
