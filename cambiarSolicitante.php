<?php
require 'includes/conexion.php';
require 'pages/validaSesion.php';

$soluValor=isset($_POST['soluValor']) ? $_POST['soluValor'] : '';
$nombreUsr=isset($_POST['nombreUsr']) ? $_POST['nombreUsr'] : '';
$ticket=isset($_POST['ticket']) ? $_POST['ticket'] : '';


$qUsuario = "SELECT * FROM usuario WHERE idUsuario = '$soluValor'";
$resulUsuario = $mysqli->query($qUsuario);
$datosUsuario = $resulUsuario->fetch_array(MYSQLI_ASSOC);
$idUsuario=$datosUsuario['idUsuario'];
$nombreUsr=$datosUsuario['nombresU'];
echo $qUsuario;
  $qUPreporte = "UPDATE reporte SET estatus ='3',Solucionador_idSolucionador='$idUsuario' WHERE idReporte = $ticket";
    $resulUP = $mysqli->query($qUPreporte);
    echo $qUPreporte;
 ?>

 <html lang="es">
 	<head>
 		<?php require 'head.php'; ?>
 	</head>

 	<body>
 		<div class="container">
 			<div class="row">
 				<div class="row" style="text-align:center">
 					<?php if($resulUP) {
            // echo "<script>location.href='index.php'</script>"; ?>
            <div class="alert alert-success alert-dismissable">
              <a href="ticketsTI.php" class="close" data-dismiss="alert" aria-label="close">×</a>
              <strong>¡Estatus cambiado a: EN PROCESO. Atiende: <?php echo $nombreUsr; ?></strong> Ticket en proceso.
            </div>
 						<h3>Ticket en Proceso</h3>
 						<?php  } else { ?>
 						<h3>Error al Solicitar Ticket</h3>
 					<?php } ?>
 					<a href="ticketsTI.php" class="btn btn-primary">Regresar</a>
 				</div>
 			</div>
 		</div>
 	</body>
 </html>
