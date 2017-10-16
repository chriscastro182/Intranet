<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
  $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
	$idSolicitante= $_SESSION['idUsuario'];
  $datetime = date_create()->format('Y-m-d H:i:s');
  $id_insert=0;

  $indexReport= "SELECT * FROM post";
  $resul = $mysqli->query($indexReport);
  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
  $sql = "INSERT INTO post (idPost, tituloPost, contenidoPost, fechaPost, imagenPost)
                      VALUES ('$id_insert', '$titulo', '$contenido', '$datetime','post/')";
	$resultado = $mysqli->query($sql);
  echo $sql;
	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";
		} else {

		$permitidos = array("image/jpg","image/png","application/pdf");
		$limite_kb = 2024;

		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){

			$ruta = 'post/'.$id_insert.'/';

			$archivo = $ruta.$_FILES["archivo"]["name"];
			if(!file_exists($ruta)){
				mkdir($ruta, 0755, true);
			}

			if(!file_exists($archivo)){

				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);

				if($resultado){
          $sql= "UPDATE post SET imagenPost='$archivo' WHERE idReporte= $id_insert";
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
						<h3>REGISTRO GUARDADO</h3>
						<?php } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>
					<a href="post.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
