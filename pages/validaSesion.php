<?php if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])==FALSE) {
  header("Location:login.php");
} ?>
