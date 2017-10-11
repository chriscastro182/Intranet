<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  $solucionador=0;
	$CategoriaReporte_idCategoriaReporte = isset($_POST['CategoriaReporte_idCategoriaReporte']) ? $_POST['CategoriaReporte_idCategoriaReporte'] : '';
	$TipoRequerimiento_idTipoRequerimiento = isset($_POST['TipoRequerimiento_idTipoRequerimiento']) ? $_POST['TipoRequerimiento_idTipoRequerimiento'] : '';
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
	$idSolicitante= $_SESSION['idUsuario'];
  $datetime = date_create()->format('Y-m-d H:i:s');
  $id_insert=0;

  $indexReport= "SELECT * FROM reporte";
  $resul = $mysqli->query($indexReport);
  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
    switch ($CategoriaReporte_idCategoriaReporte) {
      case 1:
          if ($TipoRequerimiento_idTipoRequerimiento==2) {
            $solucionador=1;
          }else {
            $solucionador=2;
          }
          break;
      case 2:
          if ($TipoRequerimiento_idTipoRequerimiento==4) {
            $solucionador=1;
          }else {
            $solucionador=4;
          }
          break;
      case 3:
          $solucionador=3;
          break;
      }
	$sql = "INSERT INTO reporte (idReporte, estatus, descripcion, evidencia, fEmision,  Solucionador_idSolucionador, Solicitante_idSolicitante,TipoRequerimiento_idTipoRequerimiento)
                            VALUES ('$id_insert', '1', '$descripcion','files/', '$datetime', '$solucionador', '$idSolicitante', '$TipoRequerimiento_idTipoRequerimiento')";
$resultado = $mysqli->query($sql);
	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
		} else {

		$permitidos = array("image/jpg","image/png","application/pdf");
		$limite_kb = 2024;

		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){

			$ruta = 'files/'.$id_insert.'/';

			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta, 0755, true);
			}

			if(!file_exists($archivo)){

				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

				if($resultado){
          $sql= "UPDATE reporte SET evidencia='$archivo' WHERE idReporte= $id_insert";
          $resultado = $mysqli->query($sql);
          $desc="SELECT * FROM categoriareporte WHERE idCategoriaReporte = $CategoriaReporte_idCategoriaReporte";
          $resultado = $mysqli->query($desc);
	           $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $asunto='Mesa: '.$row['nombreCategoriaReporte'];
          mail('soporte.sistemas@braniff.com',$asunto, $descripcion);
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

					<a href="SolicitarTicket.php" class="btn btn-primary">Regresar</a>

				</div>
			</div>
		</div>
	</body>
</html>
