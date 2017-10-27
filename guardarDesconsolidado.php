<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $guiaMaster = isset($_POST['guiaMaster']) ? $_POST['guiaMaster'] : '';
	$guiaHouse = isset($_POST['guiaHouse']) ? $_POST['guiaHouse'] : '';
  $numeroGuias = isset($_POST['numeroGuias']) ? $_POST['numeroGuias'] : 0;
  $VueloDigitalizacion_idVueloDigitalizacion= isset($_POST['idVuelo']) ? $_POST['idVuelo'] : 0;
  $Consol = isset($_POST['Consol']) ? $_POST['Consol'] : '';
  $id_insert=0;

  $indexRegistro= "SELECT * FROM registrovd";
  $resul = $mysqli->query($indexRegistro);
  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
  $sql = "INSERT INTO registrovd(idRegistroVD, guiaMaster, guiaHouse, descon, VueloDigitalizacion_idVueloDigitalizacion)
                VALUES ($id_insert,$guiaMaster,'$guiaHouse', $Consol, $VueloDigitalizacion_idVueloDigitalizacion)";
echo $sql;
$resultado = $mysqli->query($sql);
// if ($Consol==0 || $numeroGuias==0) {
//   require ('cargaArchivo.php');
// }

if ($resultado) {
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
             header( 'Location: Digitalizacion.php?idRVD='.$VueloDigitalizacion_idVueloDigitalizacion);?>
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
