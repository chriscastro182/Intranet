<?php
require 'includes/conexion.php';
require 'pages/validaSesion.php';

$ticket=isset($_POST['ticket']) ? $_POST['ticket'] : '';
$solucion=isset($_POST['Solucion']) ? $_POST['Solucion'] : '';
$fsolucion = date_create()->format('Y-m-d H:i:s');


$ifechas= "UPDATE reporte set fSolucion = '$fsolucion' WHERE idReporte ='$ticket'";   //Consulta para estampar (INSERT ITNO) la fecha de cierre del ticket
$resulifechas = $mysqli->query($ifechas);

  $qfecha= "SELECT fEmision FROM reporte WHERE idReporte = '$ticket'"; // Consulta para obtener la fecha de emisión SELECT

  $resulifechaI = $mysqli->query($qfecha);
  $rowFinicio = $resulifechaI->fetch_assoc();
   $finicio = $rowFinicio['fEmision'];
   $t1 = StrToTime ( $fsolucion );
    $t2 = StrToTime ( $finicio );
    $diff = $t1 - $t2;
    $hours = $diff / ( 60 * 60 );

    $dias = $diff / ( 60 * 60 * 24);

  //  $diff=abs(strtotime($fsolucion) - strtotime($finicio));
  //     $dias = floor($diff /60/60/24);
  //     echo $diff;
  //     echo "Días: ";
  //     echo $dias;
   //
  //     $horas = floor(($dias-$diff) /60/60);
	//    echo " Horas: ";
  //    echo $horas;
   $qUPreporte = "UPDATE reporte SET estatus ='5', tiempoRespuesta= '$diff',solucion = '$solucion' WHERE idReporte = $ticket";
   $resulUP = $mysqli->query($qUPreporte);

   $desc="SELECT * FROM reporte WHERE idReporte = $ticket";
   							  $resultado = $mysqli->query($desc);
   								   $row = $resultado->fetch_array(MYSQLI_ASSOC);
                     $idSol=$row['Solucionador_idSolucionador'];
                     $idSoli=$row['Solicitante_idSolicitante'];
          $sqlSol="SELECT * FROM solucionador WHERE idSolucionador = $idSol";
          $resulSol= $mysqli->query($sqlSol);
          $rowSol = $resulSol->fetch_array(MYSQLI_ASSOC);
          $idUsuario =$rowSol['Usuario_idUsuario'];
            $sqlUsr="SELECT * FROM usuario WHERE idUsuario = $idUsuario";
            $resulUsr= $mysqli->query($sqlUsr);
            $rowUsr = $resulUsr->fetch_array(MYSQLI_ASSOC);
            $nombreSol = $rowUsr['nombresU'];
            $apellidosSol = $rowUsr['apellidosU'];
            $correoSol= $rowUsr['mail'];
        $sqlSoli="SELECT * FROM solicitante WHERE idSolicitante = $idSoli";
            $resulSoli= $mysqli->query($sqlSoli);
            $rowSoli = $resulSoli->fetch_array(MYSQLI_ASSOC);
            $idUsuario =$rowSoli['Usuario_idUsuario'];
              $sqlUsr="SELECT * FROM usuario WHERE idUsuario = $idUsuario";
              $resulUsr= $mysqli->query($sqlUsr);
              $rowUsr = $resulUsr->fetch_array(MYSQLI_ASSOC);
              $nombreSoli = $rowUsr['nombresU'];
              $correoSoli= $rowUsr['mail'];

   if ($resulUP) {
     $asunto='Ticket #: '.$ticket.' ¡Solucionado!'.$id_insert;
     $descripcion= 'Solución: '.$solucion."\r\n".'Tiempo de respuesta: '.$diff."\r\n".'Atendido por'.$nombreSol.' '.$apellidosSol;

     $headers =  'MIME-Version: 1.0' . "\r\n";
     $headers .= 'From: Soporte Sistemas <soporte.imm@interpuerto.com>' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     $envio=mail($correoSoli,$asunto, $descripcion, $headers);
     if ($envio) {
       echo '<div class="alert alert-success">
           <strong>Mensaje enviado!</strong> Revisa el estatus del ticket para dar seguimiento al mismo.
         </div>';
     }
   }
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
              <strong>¡Estatus cambiado a: Solucionado. Se resolvió <?php echo $solucion; ?></strong> Ticket solucionado en <?php echo $hours; ?> horas.
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
