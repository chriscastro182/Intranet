<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';

	$ingreso = isset($_POST['ingreso']) ? $_POST['ingreso'] : '';
	$registro = isset($_POST['registro']) ? $_POST['registro'] : '';
	$Vuelo = isset($_POST['Vuelo']) ? $_POST['Vuelo'] : '';
  $guiaMaster = isset($_POST['guiaMaster']) ? $_POST['guiaMaster'] : '';
	$guiaHouse = isset($_POST['guiaHouse']) ? $_POST['guiaHouse'] : '';
  $datetime = date_create()->format('Y-m-d H:i:s');
  $id_insert=0;

  $indexArchivo= "SELECT * FROM archivodigital";
  $resul = $mysqli->query($indexArchivo);
  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
  $sql = "INSERT INTO archivodigital (idarchivoDigital, fechaArchivoDigital, registroArchivoDigital, vueloArchivoDigital, guiaMaster, guiaHouse, documento)
                          VALUES ('$id_insert','$datetime','$registro','$Vuelo','$guiaMaster','$guiaHouse', 'PDFs/')";

$resultado = $mysqli->query($sql);
	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
		} else {
		$permitidos = array("application/pdf");
		$limite_kb = 5024;
		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){
			$ruta = 'PDFs/'.$id_insert.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta, 0755, true);
			}
			if(!file_exists($archivo)){
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				if($resultado){
          $sql= "UPDATE archivodigital SET documento='$archivo' WHERE idarchivoDigital= $id_insert";
          $resultado = $mysqli->query($sql);

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
		<?php require ('head.php'); ?>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>Documento Guardado</h3>
						<?php  } else { ?>
						<h3>Error al Solicitar Ticket</h3>
					<?php } ?>
					<a href="Digitalizacion.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
