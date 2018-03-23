<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $id= isset($_POST['id']) ? $_POST['id'] : 0;
  $vuelo = isset($_POST['vuelo']) ? $_POST['vuelo'] : '';
	$registro = isset($_POST['registro']) ? $_POST['registro'] : '';

  if ($_POST['fecha']!=NULL) {
    $fecha= isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $sql = "UPDATE vuelodigitalizacion SET fecha= '$fecha', registroVD= '$registro', nomVuelo = '$vuelo' WHERE idVueloDigitalizacion ='$id'";
  } else {
    $sql = "UPDATE vuelodigitalizacion SET registroVD= '$registro', nomVuelo = '$vuelo' WHERE idVueloDigitalizacion ='$id'";
  }

  $resultado = $mysqli->query($sql);

?>
<html lang="es">
	<head>
		<?php require ('head.php'); ?>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) {
             header( 'Location: detalleVuelo.php?id='.$id.'' ); ?>
						<h3>Edición exitosa</h3>
						<?php  } else { ?>
						<h3>Falla al modificar</h3>
					<?php } ?>
					<a href="Digitalizacion.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
