<?php
require_once("conexion.php");

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

if (!empty($tipo) && $tipo != "Todos") {
  // Filtrar mezcales por tipo
  $sql = "SELECT * FROM Mezcales WHERE Tipo = '$tipo'";
} elseif (isset($_GET['buscar'])) {
  // Buscar mezcales por nombre
  $buscar = $_GET['buscar'];
  $sql = "SELECT * FROM Mezcales WHERE Nombre_mezcal LIKE '%$buscar%'";
} else {
  // Consulta para obtener todos los mezcales
  $sql = "SELECT * FROM Mezcales";
}

$productos = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/estilos.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/filtro_mezcales.js"></script>
  <title>Productos</title>
</head>

<body>
  <header>
  </header>
  <main>
    <div class="contenedor-productos">
      <div class="filtro">
        <form action="" method="GET">
          <input type="search" name="buscar" class="buscador" placeholder="Buscar producto.." />
          <button type="submit" class="buscar"><h1>BUSCAR</h1></button>
        </form>
        <div id="botones-productos"> 
          <button class="boton-producto" dato-tipo="Todos"><h2>TODOS</h2></button>
          <button class="boton-producto" dato-tipo="Espadin"><h2>ESPADÍN</h2></button>
          <button class="boton-producto" dato-tipo="Tobala"><h2>TOBALÁ</h2></button>
          <button class="boton-producto" dato-tipo="Ensamble"><h2>ENSAMBLE</h2></button>
          <button class="boton-producto" dato-tipo="Arroqueno"><h2>ARROQUEÑO</h2></button>
          <button class="boton-producto" dato-tipo="Jabali"><h2>JABALÍ</h2></button>

        </div>
      </div>
    
      <?php
      while($columna = mysqli_fetch_assoc($productos)){
      ?>
        <div class="carta">
          <a href="mezcal_producto.php?id=<?php echo $columna["ID_mezcal"]; ?>">
          <img src="img/<?php echo $columna["Imagen_mezcal"];?>" alt="">
          <h3><?php echo $columna["Nombre_mezcal"];?></h3>
          <p>$<?php echo $columna["Precio"];?></p>
       </div>
      <?php

      }
      ?>
    </div>
    <div id="chat-contenedor"></div>

  </main>
  <footer>
  </footer>
  <script src="js/barras de navegacion.js"></script>
</body>

</html>