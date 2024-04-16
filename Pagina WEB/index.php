<?php
  require_once ("conexion.php");
  $sql = "SELECT * FROM Mezcales";	
  $productos = $conn->query($sql);

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
  <main>
    <article class="Eslogan">
      <img src="img/magueyes.jpeg" alt="Image 9" />
      <h1>LA ESENCIA DE MÉXICO EN UNA BOTELLA.</h1>
      <p>
        Nuestro asistente personal está aquí para ayudarte, descubre mezclas
        personalizadas y recetas de cócteles adaptadas a tus gustos.
      </p>
    </article>
  </main>
  <section>
    <div class="Titulo">
      <h2>EL MEZCAL</h2>
    </div>
    <div class="productos-mezcales">
      
            <?php
          $contador = 0;
          while ($columna = mysqli_fetch_assoc($productos)) {
            if ($contador >= 6) {
              break; 
            }
        ?>
        <div class="carta">
          <a href="mezcal_producto.php?id=<?php echo $columna["ID_mezcal"]; ?>">
            <img src="img/<?php echo $columna["Imagen_mezcal"]; ?>" alt="">
            <h3><?php echo $columna["Nombre_mezcal"]; ?></h3>
            <p>$<?php echo $columna["Precio"]; ?></p>
        </div>
        <?php
            $contador++;
          }
        ?>
      </div>
      <div class="boton-mostrar-mas">
          <a href="productos.php"><img src="img/botonMostrarMás.svg" alt="" /></a>
        </div>
  </section>
  <section>
    <div class="Titulo">
      <h2>CÓCTELES</h2>
    </div>
    <div class="productos-cocteles">
      <article class="productos">
        <div class="carta">
          <img src="img/coctal 1.png" alt="Image 10" />
          <h3>Fresa y humo</h3>
        </div>
        <div class="carta">
          <img src="img/coctal 1.png" alt="Image 11" />
          <h3>Fresa y humo</h3>
        </div>
        <div class="carta">
          <img src="img/coctal 1.png" alt="Image 12" />
          <h3>Fresa y humo</h3>
        </div>
      </article>
      <div class="boton-mostrar-mas">
        <img src="img/botonMostrarMás.svg" alt="" />
      </div>
    </div>
  </section>
  <div id="chat-contenedor"></div>
  <footer>
  </footer>
  <script src="js/barras de navegacion.js"></script>
</body>

</html>