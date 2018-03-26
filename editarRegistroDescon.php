<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $id= isset($_POST['id']) ? $_POST['id'] : 0;
	$guiaHouse = isset($_POST['guiaHouse']) ? $_POST['guiaHouse'] : '';

  $sql = "UPDATE registrodescon SET guiaHouse='$guiaHouse' WHERE idRegistroDescon = '$id'";
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
             header("Location:".$_SERVER['HTTP_REFERER']); ?>
						<h3>Edición exitosa</h3>
						<?php  } else { ?>
						<h3>No se pudo actualizar el registro</h3>
					<?php } ?>
					<a href="Digitalizacion.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
