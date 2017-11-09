<?php
    require 'includes/conexion.php';
    require 'data/Encriptacion.php';

    $nombres =$_POST['nombres'];
    $apellidos =$_POST['apellidos'];
    $correo = $_POST['correo'];
    $nomAlt = encryptAndEncode($_POST['contrasena']);
    $nomAlt2 = encryptAndEncode($_POST['contrasena2']);
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
    $checkemail=mysqli_query($mysqli,"SELECT * FROM Usuario WHERE mail='$correo'");
    $check_mail=mysqli_num_rows($checkemail);
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
        $sql ="INSERT INTO usuario (idUsuario,mail,pass,nombresU,apellidosU,Rol_idRol)
        VALUES ($idUsiario,'$correo','$nomAlt','$nombres', '$apellidos',  '$rh')";
        $resultado = $mysqli->query($sql);
      }
    }else {
      echo '<div class"row" style="text-align:center">
              <h3>Las contraseñas no coinciden</h3>
            </div>';
    }
     ?>
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
