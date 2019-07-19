<?php
//var_dump($_REQUEST);
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';

	if (isset($_POST['idHouse'])) {
		$id = $_POST['idHouse']; 

		$sql = "SELECT * FROM `digitalizacion`.`registrodescon` WHERE `idRegistroDescon` = '$id'";
    	$guiaHouse=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
		
		if ($guiaHouse->num_rows) {
			$obj = $guiaHouse->fetch_object();
			//var_dump($obj);
		}
	}else {
		header('location: index.php');
	}
	

  // ALTER TABLE `digitalizacion`.`vuelodigitalizacion` 
//ADD COLUMN `docPrevio` VARCHAR(180) NULL AFTER `nomVuelo`,
//ADD COLUMN `docSalidas` VARCHAR(180) NULL AFTER `docPrevio`;

	if($_FILES["salida"]["error"]>0){
		echo "Error al cargar archivo";
		var_dump($_FILES["salida"]["error"]);
		} else {
		$permitidos = array("application/pdf");
		$limite_kb = 20024;

		if(in_array($_FILES["salida"]["type"], $permitidos) && $_FILES["salida"]["size"] <= $limite_kb * 1024){

			$ruta = 'salidas/'.$obj->guiaHouse.'/';

			$archivo = $ruta.$_FILES["salida"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta, 0755, true);
			}

			if(!file_exists($archivo)){

				$guiaHouse = @move_uploaded_file($_FILES["salida"]["tmp_name"], $archivo);

				if($guiaHouse){
					$sql = "UPDATE `digitalizacion`.`registrodescon` SET `docSalida` = '$archivo' WHERE `idRegistroDescon` = '$id'";

					$result = $mysqli->query($sql);
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
					<?php if($result) { ?>
						<h3>Archivo adjunto satisfactoriamente</h3>
						<?php } else { ?>
						<h3>Error al cargar archivo</h3>
					<?php } ?>
					<a href="adjuntarArchivosHouseDigitalizacion.php?id=<?php echo $id; ?>" class="btn btn-primary">Regresar al vuelo</a>
				</div>
			</div>
		</div>
	</body>
</html>
