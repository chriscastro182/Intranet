<?php
if(!isset($_SESSION))
    {
        session_start();
    }
	require 'includes/conexion.php';
  $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';
	$idUsuario= $_SESSION['idUsuario'];
  $datetime = date_create()->format('Y-m-d H:i:s');
  $id_insert=0;
  $idPost = isset($_POST['idPost']) ? $_POST['idPost'] : '';

  $indexReport= "SELECT * FROM comentario";
  $resul = $mysqli->query($indexReport);
  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
  $sql = "INSERT INTO comentario (idcomentario, comentario, fechaComentario, Usuario_idUsuario, Post_idPost)
                      VALUES ('$id_insert', '$comentario', '$datetime', '$idUsuario', $idPost)";
	$resultado = $mysqli->query($sql); ?>

<html lang="es">
	<head>
		<?php require ('head.php'); ?>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) {
            echo "<script>location.href='index.php'</script>";
            } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>
					<a href="index.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
