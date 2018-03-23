<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $id = $_GET['id'];
  $sql = "DELETE FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$id'";
  echo $sql;
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
            header( 'Location: archivoDigitalizacion.php'); ?>
						<h3>Registro de vuelo eliminado</h3>
						<?php  } else { ?>
						<h3>Error al borrar registro de vuelo</h3>
            <div class="alert alert-danger">
              <h4>Es probable que el vuelo aún contenga guías y es por eso que no se puede eliminar</h4><small>Asegúrate de eliminar sus guías en el siquiente <a href="detalleVuelo.php?id=<?php echo $id; ?>" class="alert-link">link</a> </small>
            </div>
					<?php } ?>
					<a href="Digitalizacion.php" class="btn btn-primary">Regresar al inicio</a>
				</div>
			</div>
		</div>
	</body>
</html>
