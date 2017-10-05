<!DOCTYPE html>
<html>
  <head>
    <?php require('head.php'); ?>
    <link rel="stylesheet" href="vendor/signin.css">
    <style media="screen">
    /*body {
        background-image: url('../images/FondoSignUp.png');
        background-size: cover;
    }*/
    </style>
  </head>
  <body>
    <?php require('topNav.php'); ?>
  </nav>
      <div class="main">
          <form action="guardarUsuario.php" id="formlg" method="POST">
            <!-- <img src="images/Logo_imm.png" class="img-responsive center-block" alt="" width="30%"> -->

            <h2>Registro</h2>
              <input type="email" name="correo" placeholder="Correo " required />
              <input type="text" name="nombres" placeholder="Nombre (s)" required />
              <input type="text" name="apellidos" placeholder="Apellidos (s)" required />
              <input type="password" name="contrasena" placeholder="Contraseña" required />
              <input type="password" name="contrasena2" placeholder="Repite tu contraseña" required />
              <input type="submit" name="botonlg" value="Registrar" />
          </form>
      </div>

  </body>
</html>
