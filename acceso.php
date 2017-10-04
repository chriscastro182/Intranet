<?php session_start();
require 'includes/conexion.php';
require 'data/Encriptacion.php';

$correo=$_POST['mail'];
$contrasena=encryptAndEncode($_POST['pass']);

$proceso = $mysqli->query("SELECT * FROM usuario WHERE mail='$correo' AND pass='$contrasena' ");

  if($f2=mysqli_fetch_assoc($proceso)){
      if($contrasena==$f2['pass']){
          $_SESSION['u_nombre']=$f2['nombre'];
          $_SESSION['idUsuario']=$f2['idUsuario'];
          $_SESSION['tipoUsuario_idtipoUsuario']=$f2['tipoUsuario_idtipoUsuario'];

        echo "<script>location.href='index.php'</script>";
      //  echo $_SESSION['u_nombre'];
      //  echo "</h1> ";
      }
  } ?>
