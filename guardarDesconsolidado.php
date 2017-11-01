<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  require 'includes/conexionDigitalizacion.php';

  $guiaMaster = isset($_POST['Master']) ? $_POST['Master'] : '';
	$numHouse = isset($_POST['numHouse']) ? $_POST['numHouse'] : '';

  $VueloDigitalizacion_idVueloDigitalizacion= isset($_POST['idVuelo']) ? $_POST['idVuelo'] : 0;
  $id_insert=0;
  echo $VueloDigitalizacion_idVueloDigitalizacion;
  if (isset($_POST['Master'])) {
    $indexRegistro= "SELECT * FROM registrovd";
    $resul = $mysqli->query($indexRegistro);
    while($row = $resul->fetch_assoc()){
      $id_insert++;
    }
    $sql = "INSERT INTO registrovd(idRegistroVD, guiaMaster,  descon, VueloDigitalizacion_idVueloDigitalizacion)
                  VALUES ($id_insert,$guiaMaster, 1, $VueloDigitalizacion_idVueloDigitalizacion)";
  $resultado = $mysqli->query($sql);
  $idDescon=$id_insert;
}else {
  $registro="SELECT * FROM registrovd WHERE guiaMaster = '$guiaMaster'";
  $Rdesconsol = $mysqli->query($registro);
  $rowDesc = $Rdesconsol->fetch_array(MYSQLI_ASSOC);
  $idDescon= $rowDesc['idRegistroVD'];
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

             header( 'Location: DigitalizacionDesconsol.php?idRVD='.$VueloDigitalizacion_idVueloDigitalizacion.'&idDescon='.$idDescon.'&numHouse='.$numHouse );?>
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
