<?php $idUsuario=$_SESSION['idUsuario'];
$sql= "SELECT idSolicitante FROM solicitante WHERE Usuario_idUsuario ='$idUsuario'";
$resul = $mysqli->query($sql);
$rowSolicitante = $resul->fetch_array(MYSQLI_ASSOC);
$idSolicitante= $rowSolicitante['idSolicitante']; ?>
