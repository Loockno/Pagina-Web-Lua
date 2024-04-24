<?php
require_once "conexion.php";
$id = "";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
$sql_query = "SELECT * FROM Mezcales WHERE ID_mezcal = $id";
$result = $conn->query($sql_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio</title>
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
                <img src="img/<?php echo $row["Imagen_mezcal"]; ?>" alt="">
                </div>
                <div class="informacion_producto">
                    <h1><?php echo $row["Nombre_mezcal"]; ?> - <?php echo $row["Volumen"]; ?> ml</h1>
                    <h3>$<?php echo $row["Precio"]; ?></h3>
                    <p><?php echo $row["Descripcion"]; ?></p>

                    <div class="botones-carrito">
                    <input  class="input-cantidad" min="1" step="1" value="1" type="number">
                    <button class="boton-agregar" data-id="<?php echo $row["ID_mezcal"]; ?>">AÑADIR AL CARRITO</button>
                    
                    
                    </div>
                    <p><br>Categoría: <?php echo $row["Tipo"]; ?></p>
                </div>
                <?php
            }
        }
        ?>
        <div class="detalles">
        </div>
    </div>
    <div id="chat-contenedor"></div>
    <footer>
    </footer>
    <script src="js/barras de navegacion.js"></script>
</body>

</html>