<?php

$numPost= $row['idPost'];
$Nombre = $_SESSION['u_nombre'];
$Apellidos = $_SESSION['apellidos'];
$sqlPost="SELECT * FROM comentario WHERE Post_idPost = $numPost";
$resulPost = $mysqli->query($sqlPost);

while ($rowPost = $resulPost->fetch_array(MYSQLI_ASSOC)) {
  $usrComent= $rowPost['Usuario_idUsuario'];
  $sqlUsr="SELECT * FROM usuario WHERE idUsuario = $usrComent";
  $resulUsr = $mysqli->query($sqlUsr);
  $rowUsr = $resulUsr->fetch_array(MYSQLI_ASSOC);?>
<div class="well" style="text-justify">
  <div class="row">
    <div class="col-sm-2">
      <img src="images/Logo_imm.png" alt="" class="img-thumbnail" width="45px">
      <?php echo $rowPost['fechaComentario'];; ?>
    </div>
    <div class="col-sm-10">
      <h4><?php echo $rowUsr['nombresU']." ".$rowUsr['apellidosU'].": ".$rowPost['comentario']; ?></h4>
    </div>
  </div>
</div>
<?php } ?>
