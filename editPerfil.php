<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require('includes/conexion.php');
    require 'pages/validaSesion.php';
    require('head.php');
    $idUsuario= $_SESSION['idUsuario'];
    $sql= "SELECT * FROM usuario WHERE idUsuario = '$idUsuario'";
    $user= $mysqli->query($sql);
    $rowUser = $user->fetch_array(MYSQLI_ASSOC);

    $idArea = $_SESSION['Area_idArea'];
    $sql = "SELECT * FROM area where idArea = '$idArea'";
    $area= $mysqli->query($sql);
    $rowArea = $area->fetch_array(MYSQLI_ASSOC);
    ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
        require('nav.php');        ?>
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="container-fluid">
             
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-3">
                <img src="images/Logo_imm.png" alt="" class="img-thumbnail" width="50%">
              </div>
              <div class="col-lg-7">
                  <h1><?php echo $_SESSION['u_nombre'].' '.$_SESSION['apellidos']; ?></h1>
                  <h3><?php echo "Área: ".$rowArea['nombreArea']; ?></h3>
                  <h3>Correo: <?php echo $rowUser['mail']; ?></h3>
                  <br>
                  <br>
              </div>
              <div class="col-lg-3">

              </div>
            </div>
            <div class="row">
              <div class="container col-lg-7">
                <h2>Cambio de contraseña</h2>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <form class="form-horizontal" action="updatePass.php" method="post">
                      <div class="col-lg-8">
                        <input class="form-control" type="password" name="oldPass" value="" placeholder="Ingrese contraseña anterior.">
                        <br>
                        <input class="form-control" type="password" name="newPass" value="" placeholder="Ingrese nueva contraseña.">
                        <br>
                        <input class="form-control" type="password" name="newPass2" value="" placeholder="Ingrese nueva contraseña una vez más.">
                        <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                      </div>
                      <div class="col-lg-4">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                          <button type="submit" class="btn btn-lg btn-primary" name="button">Cambiar contraseña</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



</body>

</html>
