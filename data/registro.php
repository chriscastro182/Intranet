<!DOCTYPE html>
<html>
  <head>
    <?php require('head.php'); ?>
    <link rel="stylesheet" href="vendor/login.css">
  </head>
  <body>
    <?php require('topNav.php'); ?>
  </nav>
      <div class="main">
          <form action="guardarUsuario.php" id="formlg" method="POST">
            <img src="images/Logo_imm.png" class="img-responsive center-block" alt="" width="30%">
            <br>
            <h3>Registro</h3>
              <input type="email" name="correo" placeholder="Correo " required />
              <input type="text" name="nombres" placeholder="Nombre (s)" required />
              <input type="text" name="apellidos" placeholder="Apellidos (s)" required />
              <input type="password" name="contrasena" placeholder="Contraseña" required />
              <input type="password" name="contrasena2" placeholder="Repite tu contraseña" required />
              <input type="submit" name="botonlg" value="Iniciar Sesión" />
          </form>
      </div>

  </body>
</html>
