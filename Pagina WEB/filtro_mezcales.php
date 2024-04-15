<?php
require_once("conexion.php");

if(isset($_GET['tipo'])) {
  $tipo = $_GET['tipo'];
  // Consulta SQL para obtener mezcales filtrados por tipo
  $sql = "SELECT * FROM Mezcales WHERE Tipo = '$tipo'";
} else {
  // Consulta SQL para obtener todos los mezcales si no se ha seleccionado ningún tipo
  $sql = "SELECT * FROM Mezcales";
}

$productos = $conn->query($sql);

while($columna = mysqli_fetch_assoc($productos)){
?>
<div class="carta">
  <img src="img/<?php echo $columna["Imagen_mezcal"];?>" alt="">
  <h3><?php echo $columna["Nombre_mezcal"];?></h3>
  <p>$<?php echo $columna["Precio"];?></p>
</div>
<?php
}
?>
