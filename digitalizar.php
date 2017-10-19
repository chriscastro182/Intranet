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
  $Consol = isset($_POST['Consol']) ? $_POST['Consol'] : '';
  $numeroGuias = isset($_POST['numeroGuias']) ? $_POST['numeroGuias'] : 0;
  $id_insert=0;

  $indexArchivo= "SELECT * FROM archivodigital";
  $resul = $mysqli->query($indexArchivo);
  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
  $sql = "INSERT INTO archivodigital (idarchivoDigital, fechaArchivoDigital, registroArchivoDigital, vueloArchivoDigital, guiaMaster, guiaHouse, documento)
                          VALUES ('$id_insert','$datetime','$registro','$Vuelo','$guiaMaster','$guiaHouse', 'PDFs/')";
$resultado = $mysqli->query($sql);
if ($Consol==0 || $numeroGuias==0) {
  require ('cargaArchivo.php');
}
if ($numeroGuias!=0) {
  $numeroGuias--;
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
					<?php if($resultado) {
             header( 'Location: Digitalizacion.php?guiaMaster='.$guiaMaster.'&numeroGuias='.$numeroGuias.'&Consol='.$Consol);?>
						<h3>Documento Guardado</h3>
						<?php  } else { ?>
						<h3>Error al Digitalizar</h3>
					<?php } ?>
					<a href="Digitalizacion.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
