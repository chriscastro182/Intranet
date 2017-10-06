<?php
	require 'includes/conexion.php';

	$CategoriaReporte_idCategoriaReporte = $_POST['CategoriaReporte_idCategoriaReporte'];
	$TipoRequerimiento_idTipoRequerimiento = $_POST['TipoRequerimiento_idTipoRequerimiento'];
	$descripcion = $_POST['descripcion'];
	$idSolicitante= $_SESSION['idUsuario'];

	$sql = "INSERT INTO Reporte (idReporte, estatus, tiempoRespuesta, descripcion, fEmision, fSolucion, CategoriaReporte_idCategoriaReporte, Solicitante_idSolicitante,TipoRequerimiento_idTipoRequerimiento)
                            VALUES ('1','1', '0', '$descripcion', now(), now(), '$CategoriaReporte_idCategoriaReporte', '$idSolicitante', '$TipoRequerimiento_idTipoRequerimiento')";
	$resultado = $mysqli->query($sql);
	$id_insert = $mysqli->insert_id;

	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
		} else {

		$permitidos = array("image/jpg","image/png","application/pdf");
		$limite_kb = 2024;

		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){

			$ruta = 'files/'.$id_insert.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];

			if(!file_exists($ruta)){
				mkdir($ruta);
			}

			if(!file_exists($archivo)){

				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

				if($resultado){
					echo "Archivo Guardado";
          // Aquí se envía el correo
					} else {
					echo "Error al guardar archivo";
				}

				} else {
				echo "Archivo ya existe";
			}

			} else {
			echo "Archivo no permitido o excede el tamaño";
		}

	}

?>

<html lang="es">
	<head>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>REGISTRO GUARDADO</h3>
						<?php } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>

					<a href="index.php" class="btn btn-primary">Regresar</a>

				</div>
			</div>
		</div>
	</body>
</html>
