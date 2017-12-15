<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  //
  // date_default_timezone_set('America/Mexico_City');

  $master = isset($_POST['master']) ? $_POST['master'] : '';
  $house = isset($_POST['house']) ? $_POST['house'] : '';
  $valorMercancia = isset($_POST['valorMercancia']) ? $_POST['valorMercancia'] : '';
  $directa = isset($_POST['directa']) ? $_POST['directa'] : 'NULL';
  $costo = isset($_POST['costo']) ? $_POST['costo'] : '';
  $peso = isset($_POST['peso']) ? $_POST['peso'] : '';
  $Piezas = isset($_POST['Piezas']) ? $_POST['Piezas'] : '';
  $averia = isset($_POST['averia']) ? $_POST['averia'] : '';
  $fEntrada = date_create()->format('Y-m-d');
  $condiciones = isset($_POST['condiciones']) ? $_POST['condiciones'] : '';
  $Contenido = isset($_POST['Contenido']) ? $_POST['Contenido'] : '';
  $Consignatario = isset($_POST['Consignatario']) ? $_POST['Consignatario'] : '';
  $transfiere = isset($_POST['transfiere']) ? $_POST['transfiere'] : '';
  $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : '';
  $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
  $pesoBascula = isset($_POST['pesoBascula']) ? $_POST['pesoBascula'] : '';
  $Ubicacion = isset($_POST['Ubicacion']) ? $_POST['Ubicacion'] : '';
  $Observaciones = isset($_POST['Observaciones']) ? $_POST['Observaciones'] : '';
  $fecha = date_create()->format('Y-m-d H:i:s');

	$idUsuario= $_SESSION['idUsuario'];
  $id_insert=0;

  $indexReport= "SELECT * FROM transferencias";
  $resul = $mysqli->query($indexReport);
  while($row = $resul->fetch_assoc()){
    $id_insert=$row['idTransferencia'];
  }

  $id_insert++;
  $sql="INSERT INTO transferencias (idTransferencia, guiaMaster, guiaHouse, valorMercancia, costotransferencia, peso, guiaDirecta, averia, setransfiere, fecha, piezas, consignatario, contenido, ubicacion, pesobascula, observaciones, fechaentrada, almacenqueentrega, correo, gafete, fk_condiciondecarga)
                              VALUES ('$id_insert','$master','$house','$valorMercancia','$costo','$peso','$directa','$averia',
                                '$transfiere','$fecha','$Piezas','$Consignatario','$Contenido','$Ubicacion','$pesoBascula','$Observaciones','$fEntrada','$responsable','$correo','gafetes/', $condiciones)";

  $resultado = $mysqli->query($sql);
	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
		} else {
		$permitidos = array("image/jpg","image/png","application/pdf", "image/jpeg");
		$limite_kb = 20024;

		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){

			$ruta = 'gafetes/'.$id_insert.'/';

			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta, 0755, true);
			}
			if(!file_exists($archivo)){

				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

				if($resultado){
          $sql= "UPDATE transferencias SET gafete = '$archivo' WHERE idTransferencia = $id_insert";
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
					<?php
          if($resultado) { ?>
						<h3>Publicación guardada Satisfactoriamente</h3>
						<?php echo "<script>location.href='transferencia.php?id='.$id_insert.'</script>";
           } else { ?>
						<h3>Error al guardar la publicación</h3>
					<?php } ?>
					<a href="transferencia.php?id=<?php echo $id_insert; ?>"  class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
