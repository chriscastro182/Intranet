<?php
require 'includes/conexion.php';
require 'data/Encriptacion.php';
$correo=$_POST['correo'];
$contrasena=encryptAndEncode($_POST['contrasena']);

$proceso = $mysqli->query("SELECT * FROM Usuario WHERE mail='$correo' AND pass='$contrasena' ");

  if($f2=mysqli_fetch_assoc($proceso)){
      if($contrasena==$f2['pass']){
        session_start();
          $_SESSION['u_nombre']=$f2['nombresU'];
          $_SESSION['idUsuario']=$f2['idUsuario'];
          $_SESSION['apellidos']=$f2['apellidosU'];
          $_SESSION['correo']=$f2['mail'];
          $_SESSION['Rol_idRol']=$f2['Rol_idRol'];
          $_SESSION['Area_idArea']=$f2['Area_idArea'];
        echo "<script>location.href='index.php'</script>";
      }else { ?>
        <div class="alert alert-danger">
                <strong>ERROR</strong> Contraseña incorrecta.
              </div>
        <a href="login.php" class="btn btn-primary">Intentar de nuevo</a>
    <?php }
  } ?>
