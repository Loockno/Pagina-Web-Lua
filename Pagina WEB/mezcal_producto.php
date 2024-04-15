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
                <img src="img/<?php echo $row["Imagen_mezcal"]; ?>" alt="">
                <div class="informacion_producto">
                    <h1><?php echo $row["Nombre_mezcal"]; ?></h1>
                    <h2><?php echo $row["Tipo"]; ?></h2>
                    <h3><?php echo $row["Precio"]; ?></h3>
                    <p><?php echo $row["Descripcion"]; ?></p>
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