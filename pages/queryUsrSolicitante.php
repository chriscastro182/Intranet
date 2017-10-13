<?php $foraneaSolicitante= $rowSoli['Usuario_idUsuario'];
$sqlUsr="SELECT * FROM usuario WHERE idUsuario = $foraneaSolicitante";
$resulUsr = $mysqli->query($sqlUsr);
$rowUsr = $resulUsr->fetch_array(MYSQLI_ASSOC); ?>
