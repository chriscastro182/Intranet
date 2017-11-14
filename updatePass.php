<?php
    require 'includes/conexion.php';
    require 'data/Encriptacion.php';

    $valida = $_POST['oldPass'];
    $nomAlt = encryptAndEncode($_POST['newPass']);
    $nomAlt2 = encryptAndEncode($_POST['newPass2']);
    $rh=3;
// $rh=2;      //Descomentar cuando se vaya a registrar alguien de REcursos Humanos
?>
<!DOCTYPE html>
<html>
  <head>
    <?php require('head.php'); ?>
  </head>
  <body>
    <?php
    $checkpass=mysqli_query($mysqli,"SELECT * FROM usuario WHERE pass='$valida'");
    $check_pass=mysqli_num_rows($checkpass);
    if($nomAlt==$nomAlt2){
        if($check_mail!=0){
            ?>
            <div class="alert alert-danger">Atencion, ya existe el mail designado para un usuario, verifique sus datos
                <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                    &times;
                </button>
            </div>
    <?php
    }
    else{
      $idUsiario=0;
      $sqlU= "SELECT * FROM   usuario";
      $resul = $mysqli->query($sqlU);
      while($rows = $resul->fetch_array(MYSQLI_ASSOC)){
        $idUsiario++;
      }
        $sql ="INSERT INTO usuario (idUsuario,mail,pass,nombresU,apellidosU,Rol_idRol, Area_idArea)
        VALUES ($idUsiario,'$correo','$nomAlt','$nombres', '$apellidos', '$rh', $area)";
        $resultado = $mysqli->query($sql);
      }
    }else {
      echo '<div class"row" style="text-align:center">
              <h3>Las contraseñas no coinciden</h3>
            </div>';
    }  ?>

    <div class="container">
        <div class="row">
            <div class"row" style="text-align:center">
                <?php
                if($resultado) {
                  $sql="SELECT * FROM solicitante";
                  $resultado = $mysqli->query($sql);
                  $idSoli=0;
                    while($rowSoli = $resultado->fetch_array(MYSQLI_ASSOC)){
                    $idSoli++;
                    }
                  $sql ="INSERT INTO solicitante (idSolicitante,Usuario_idUsuario,Usuario_Rol_idRol)
                  VALUES ('$idSoli','$idUsiario','$rh')";
                  $resultado = $mysqli->query($sql);
                  ?>
                <h3>Registro Guardado Exitosamente</h3>
                <?php } else { echo $resultado;?>
                <h3>Error al guardar</h3>
                <a href="registro.php" class="btn btn-primary">Volver a intentar</a>
                <?php } ?>
                <a href="index.php" class="btn btn-primary">Regresar</a>
                </div>
        </div>
  </body>
</html>
