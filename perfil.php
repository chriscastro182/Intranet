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
              <div class="col-lg-2">
                <img src="images/Logo_imm.png" alt="" class="img-thumbnail" width="80%">
              </div>
              <div class="col-lg-7">
                  <h1><?php echo $_SESSION['u_nombre'].' '.$_SESSION['apellidos']; ?></h1>
                  <h3><?php echo "Área: ".$rowArea['nombreArea']; ?></h3>
                  <h3>Correo: <?php echo $rowUser['mail']; ?></h3>
                  <h3>
                    Contraseña: *********** <a href="editPerfil.php"><small><i class="fa fa-pencil" aria-hidden="true"></i> Modificar</small></a> 
                  </h3>
              </div>
              <div class="col-lg-3">

              </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>
