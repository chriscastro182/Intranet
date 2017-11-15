<?php
    require 'includes/conexion.php';
    require 'data/Encriptacion.php';

    $idUsuario= $_POST['idUsuario'];
    $valida = encryptAndEncode($_POST['oldPass']);
    $nomAlt = encryptAndEncode($_POST['newPass']);
    $nomAlt2 = encryptAndEncode($_POST['newPass2']);
?>
<!DOCTYPE html>
<html>
  <head>
    <?php require('head.php'); ?>
  </head>
  <body>
    <?php
    $sql = "SELECT * FROM usuario WHERE pass='$valida'";
    $checkpass=$mysqli->query($sql);
    $check_pass = $checkpass->fetch_array(MYSQLI_ASSOC);
    $stringPass=$check_pass['pass'];
    if($nomAlt==$nomAlt2){
        if($valida==$stringPass){
          $sql ="UPDATE usuario SET pass='$nomAlt' WHERE pass = '$valida' AND idUsuario = '$idUsuario'";
          $changePass=$mysqli->query($sql);
    }else {
      echo '<div class="alert alert-danger">Las contraseñas no coinciden, intenta nuevamente.
          <button type="button" class="close" data-dismiss="alert"
              aria-hidden="true">
              &times;
          </button>
      </div>';
        }
      }?>
    <div class="container">
            <div class"row" style="text-align:center">
              <?php if ($changePass): ?>
                <h3>Contraseña modificada exitosamente</h3>
                <div class="alert alert-success">Contraseña modificada con éxito.
                    <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">
                        &times;
                    </button>
                </div>
              <?php else: ?>
                <h3>Error al guardar</h3>
                <a href="editPerfil.php" class="btn btn-primary">Volver a intentar</a>
              <?php endif; ?>
                <a href="cerrarSesion.php" class="btn btn-primary">Volver al incio e iniciar con tu nueva contraseña</a>
            </div>
        </div>
  </body>
</html>
