<?php
$id = $_GET['id'];
echo $id;

require 'includes/conexionDigitalizacion.php';
$sql = "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$id'";
$vuelos=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
$rowVuelos = $vuelos->fetch_array(MYSQLI_ASSOC);
$validaEstatus= $rowVuelos['estatusVD'];
$validaEstatus="Vuelo Abierto";
  if ($validaEstatus) {
    $validaEstatus="Vuelo Cerrado";
  }
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require('includes/conexion.php');
    require('head.php');
     ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
        require('nav.php');        ?>
        <!-- Navigation -->
        <div id="page-wrapper">
          <div class="row">
              <div class="col-lg-12">
                  <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
              </div>
          </div>
            <div class="col-lg-8">
              <div class="well well-sm">
                <div class="row">
                  <div class="col-lg-6">
                    <h3>Registro: <?php echo $rowVuelos['registroVD']; ?></h3>
                    <h4>Fecha: <?php echo $rowVuelos['fecha']; ?></h4>
                  </div>
                  <div class="col-lg-6">
                    <h3>Vuelo: <?php echo $rowVuelos['nomVuelo']; ?></h3>
                    <h4>Estatus: <?php echo $validaEstatus; ?></h4>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-10">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Guía Master</th>
                      <th>Guía House</th>
                      <th>Consolidada</th>
                      <th>Editar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php require 'includes/conexionDigitalizacion.php';
                      $sql = "SELECT * FROM registrovd WHERE VueloDigitalizacion_idVueloDigitalizacion = '$id'";

                      $guias=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
                      while ($rowGuias = $guias->fetch_array(MYSQLI_ASSOC)) { $d=$rowGuias['descon']; ?>
                      <tr>
                        <td><?php echo $rowGuias['guiaMaster']; ?></td>
                        <td><?php echo $rowGuias['guiaHouse']; ?></td>
                        <td><?php echo $rowGuias['descon']; ?></td>
                      </tr>
                    <?php }
                    if ($d) {
                        $sql = "SELECT * FROM registrodescon WHERE RegistroVD_idRegistroVD = '$id'";
                        $guias=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
                        while ($rowGuias = $guias->fetch_array(MYSQLI_ASSOC)) { $d=$rowGuias['descon']; ?>
                          <td><?php echo $rowGuias['guiaMaster']; ?></td>
                          <td><?php echo $rowGuias['guiaHouse']; ?></td>
                          <td><?php echo $rowGuias['descon']; ?></td>
                        <?php  }
                        } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-2">
                <button type="button" class="btn btn-primary btn-block" name="button">Imprimir</button>
              </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
