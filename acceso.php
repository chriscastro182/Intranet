<?php 
require 'includes/conexion.php';
require 'data/Encriptacion.php';

$correo=$_POST['correo'];
$contrasena=encryptAndEncode($_POST['contrasena']);

$proceso = $mysqli->query("SELECT * FROM Usuario WHERE mail='$correo' AND pass='$contrasena' ");

  if($f2=mysqli_fetch_assoc($proceso)){
      if($contrasena==$f2['pass']){
          $_SESSION['u_nombre']=$f2['nombres'];
          $_SESSION['idUsuario']=$f2['idUsuario'];
          $_SESSION['correo']=$f2['mail'];
          $_SESSION['Rol_idRol']=$f2['Rol_idRol'];

        echo "<script>location.href='index.php'</script>";
      //  echo $_SESSION['u_nombre'];
      //  echo "</h1> ";
      }
  } ?>
