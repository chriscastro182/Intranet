<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  $solucionador=0;
	$Area_idArea = isset($_POST['area']) ? $_POST['area'] : '';
	$TipoRequerimiento_idTipoRequerimiento = 0;
  $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
  $CategoriaReporte_idCategoriaReporte = isset($_POST['dirigido']) ? $_POST['dirigido'] : '';
  $SistemaProceso_idSistemaProceso = isset($_POST['sistema']) ? $_POST['sistema'] : '';
  $datetime = date_create()->format('Y-m-d H:i:s');
  $id_insert=0;

  $indexReport= "SELECT * FROM reporte ORDER BY idReporte ASC";
  $resul = $mysqli->query($indexReport);
  if ($row = $resul->fetch_assoc()) {
    while($row = $resul->fetch_assoc()){
      $id_insert=$row['idReporte'];
    }
    $id_insert++;
  }

      require 'pages/querySolicitante.php';

	$sql = "INSERT INTO reporte(idReporte, estatus, descripcion, evidencia, Solucionador_idSolucionador, Solicitante_idSolicitante, TipoRequerimiento_idTipoRequerimiento, fEmision, SistemaProceso_idSistemaProceso, tipoSolucion_idtipoSolucion, Area_idArea)
          VALUES ('$id_insert', 1,'$descripcion','files/','$solucionador','$idSolicitante', '$TipoRequerimiento_idTipoRequerimiento','$datetime','$SistemaProceso_idSistemaProceso',1,'$Area_idArea')";

$resultado = $mysqli->query($sql);
$desc="SELECT * FROM categoriareporte WHERE idCategoriaReporte = $CategoriaReporte_idCategoriaReporte";
							  $resultado = $mysqli->query($desc);
								   $row = $resultado->fetch_array(MYSQLI_ASSOC);
								$asunto='Mesa: '.$row['nombreCategoriaReporte'].' Ticket #'.$id_insert;
								$nombreUsr= $_SESSION['u_nombre'];
								$correoUsr= $_SESSION['correo'];
								$headers =  'MIME-Version: 1.0' . "\r\n";
								$headers .= 'From: '.$nombreUsr.'<'.$correoUsr.'>' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$envio=mail('soporte.imm@interpuerto.com',$asunto, $descripcion, $headers);
								if ($envio) {
								  echo '<div class="alert alert-success">
										  <strong>Mensaje enviado!</strong> Revisa el estatus del ticket para dar seguimiento al mismo.
										</div>';
								}
	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
		} else {

		$permitidos = array("image/jpg","image/png","application/pdf");
		$limite_kb = 10024;

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
						<h3>Ticket Enviado</h3>
            <div class="alert alert-success alert-dismissable">
              <a href="ticketsTI.php" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>Ticket creado satisfactoriamente </strong>El equipo de TI ha sido notificado. Puedes revisar su estatus en el <a href="estadoTickets.php" >siguiente link.</a>
            </div>
						<?php  } else { ?>
						<h3>Error al Solicitar Ticket</h3>
            <a href="SolicitarTicket.php" class="btn btn-primary">Regresar</a>
					<?php } ?>

				</div>
			</div>
		</div>
	</body>
</html>
