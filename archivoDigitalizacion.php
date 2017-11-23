<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require('includes/conexion.php');
    require 'includes/conexionDigitalizacion.php';
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
          <div class="row">
            <div class="col-lg-4">
              <a href="menuDigitalizacion.php">
                <button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> Menú de digitalización</button>
              </a>
            </div>
          </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-9">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Registro</th>
                      <th>Vuelo</th>
                      <th>Total G Master</th>
                      <th>Detalles</th>
                      <th>Editar</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php $sql = "SELECT * FROM vuelodigitalizacion ORDER BY idVueloDigitalizacion ASC";
                      $vuelos=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
                      while ($rowVuelos = $vuelos->fetch_array(MYSQLI_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $rowVuelos['registroVD']; ?></td>
                        <td><?php echo $rowVuelos['nomVuelo']; ?></td>
                        <td><?php echo $rowVuelos['numGuias']; ?></td>
                        <td><a href="detalleVuelo.php?id=<?php echo $rowVuelos['idVueloDigitalizacion']; ?>">Ver a detalle</a></td>
                        <td><?php echo $rowVuelos['idVueloDigitalizacion']; ?></td>
                      </tr>
                    <?php  } ?>

                  </tbody>
                </table>
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
