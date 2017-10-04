<?php
    require 'includes/conexion.php';

    require 'includes/alan.php';

    $nombre =$_POST['nombre'];
    $apellidos =$_POST['apellidos'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $nomAlt = encryptAndEncode($_POST['nomAlt']);
    $nomAlt2 = encryptAndEncode($_POST['nomAlt2']);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
