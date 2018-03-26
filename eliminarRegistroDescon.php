<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $id = $_GET['id'];
  $sql = "DELETE FROM registrodescon WHERE idRegistroDescon = $id";
  //echo $sql;
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
            header("Location:".$_SERVER['HTTP_REFERER']);
            //header( 'Location: Digitalizacion.php?idRVD='.$VueloDigitalizacion_idVueloDigitalizacion); ?>
						<h3>Registro eliminado</h3>
						<?php  } else { ?>
						<h3>Error al borrar</h3>
					<?php } ?>
					<a href="Digitalizacion.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
