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
              <div class="col-lg-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Registro</th>
                      <th>Vuelo</th>
                      <th>Total G Master</th>
                      <th>Detalles</th>
                      <th>Editar</th>
                      <th>Eliminar</th><!-- <i class="fas fa-file-alt fa-5x"></i> -->
                      <th><i class="fa fa-upload" aria-hidden="true"></i> <i class="fas fa-file-alt"></i>  Previos y salidas </a></th>
                      <th><i class="fa fa-upload" aria-hidden="true"></i> <i class="fas fa-file-alt"></i> Transferencias </a></th>
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
                        <td><?php echo '<a href="editarDigitalizacion.php?id='.$rowVuelos['idVueloDigitalizacion'].'"><i class="fas fa-edit "></i></a>'; ?></td>
                        <th>
                          <a href="#" data-href="eliminarRegistroVuelo.php?id=<?php echo $rowVuelos['idVueloDigitalizacion']; ?>
                            " data-toggle="modal" data-target="#confirm-delete">
                              <i class="fas fa-trash-alt"></i>
                          </a>
                        </th>
                        <td>
                          <?php if($rowVuelos['docPrevio']==null || $rowVuelos['docSalidas'] == null) { ?>
                            <a href="adjuntarArchivosDigitalizacion.php?id=<?php echo $rowVuelos['idVueloDigitalizacion']; ?>" >
                                <i class="fas fa-file-alt"></i>
                            </a>
                          <?php } ?> 
                        </td>
                        <td>
                          <?php if($rowVuelos['docTrans'] == null) { ?>
                            <a href="adjuntarArchivosDigitalizacion.php?id=<?php echo $rowVuelos['idVueloDigitalizacion']; ?>" >
                                <i class="fas fa-file-alt"></i>
                            </a>
                          <?php } ?> 
                        </td>
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
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
          </div>

          <div class="modal-body">
            ¿Desea eliminar este registro de vuelo?
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger btn-ok">Borrar</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
    </script>


</body>

</html>
