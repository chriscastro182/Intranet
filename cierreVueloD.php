<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $idVuelo= isset($_POST['idVuelo']) ? $_POST['idVuelo'] : 0;

  $sql = "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion= '$idVuelo'";
  //echo $sql;
  $resultado = $mysqli->query($sql);
  echo $sql;
 require ('cargaArchivo.php');

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
             header( 'Location: menuDigitalizacion.php'); ?>
						<h3>Documento Guardado</h3>
						<?php  } else { ?>
						<h3>Error al subir el documento. <small>Vuelo no cerrado</small></h3>
					<?php } ?>
					<a href="menuDigitalizacion.php?idRVD='<?php echo $idVuelo; ?>'" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
