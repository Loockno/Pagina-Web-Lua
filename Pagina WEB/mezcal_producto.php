<?php
$id = "";
session_start();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
include "conexion.php";

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
    <script>
        function agregarAlCarrito(button) {
            var idMezcal = button.getAttribute('data-id');
            var cantidad = document.querySelector('.input-cantidad').value;
            fetch('agregar_carrito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'idMezcal=' + idMezcal + '&cantidad=' + cantidad
            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    // Aquí puedes agregar lógica para actualizar la UI,
                    // como mostrar un mensaje de confirmación o actualizar el contador del carrito.
                });
        }
    </script>

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
                        <input class="input-cantidad" min="1" step="1" value="1" type="number">
                        <button class="boton-agregar" data-id="<?php echo $row["ID_mezcal"]; ?>"
                            onclick="agregarAlCarrito(this)">AÑADIR AL CARRITO</button>
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