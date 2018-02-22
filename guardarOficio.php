<?php
require("includes/conexion.php");


$ingreso="";
$salida="";

$oficio = isset($_POST['oficio']) ? $_POST['oficio'] : '';
$fechaOficio = $_POST['fechaOficio'];
$fechaNotificacion = $_POST['fechaNotificacion'];
$observacion = isset($_POST['observacion']) ? $_POST['observacion'] : '';

$sql = "INSERT INTO Oficio (oficio, fechaoficio, fechaNotificacion, observacion)
                        VALUES ('$oficio','$fechaOficio','$fechaNotificacion','$observacion')";

$resultado = $mysqli->query($sql);
$id=$mysqli->insert_id;
?>

<html lang="es">
<?php require("head.php") ?>
<body>
  <div class="container">
    <div class="row">
      <div class="row" style="text-align:center">
        <?php if($resultado) {
           header( 'Location: oficio.php?id='.$id.'' );
         } else { ?>
            <h3>ERROR AL GUARDAR</h3>
            <a href="menuAbandono.php?=" class="btn btn-primary">Regresar</a>
          <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>
