<?php
$id = $_GET['id'];
require 'includes/conexionDigitalizacion.php';
$sql = "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$id'";
$vuelos=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
$rowVuelos = $vuelos->fetch_array(MYSQLI_ASSOC);
$validaEstatus= $rowVuelos['estatusVD'];

  if ($validaEstatus==5) {
    $validaEstatus="Vuelo Cerrado";
  }else {
    $validaEstatus="Vuelo Abierto";
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
          <div class="row">
            <div class="col-lg-4">
              <a href="archivoDigitalizacion.php">
                <button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>Archivo de digitalización</button>
              </a>
            </div>
          </div>
            <div class="col-lg-12">
              <div class="well well-sm">
                <div class="row">
                  <div class="col-lg-6">
                    <h3>Registro: <?php echo $rowVuelos['registroVD']; ?></h3>
                    <h4>Fecha: <?php echo $rowVuelos['fecha']; ?></h4>
                    <h4><?php
                      if ($rowVuelos['documentoVD']=="PDFdigital/") {
                        echo "No cuenta con archivo PDF";
                      }else {
                          echo '<a href="'.$rowVuelos['documentoVD'].'" target="_blank"><i class="fas fa-file-pdf "></i> PDF asociado</a>';
                      }
                      ?>
                    </h4>
                  </div>
                  <div class="col-lg-5">
                    <h3>Vuelo: <?php echo $rowVuelos['nomVuelo']; ?></h3>
                    <h4>Estatus: <?php echo $validaEstatus; ?></h4>
                  </div>
                  <div class="col-lg-1">
                    <?php echo '<a href="editarDigitalizacion.php?id='.$rowVuelos['idVueloDigitalizacion'].'"><i class="fas fa-edit fa-2x"></i></a>'; ?>
                    <br>
                    <br>
                    <a href="#" data-href="eliminarRegistroVuelo.php?id=<?php echo $rowVuelos['idVueloDigitalizacion']; ?>
                      " data-toggle="modal" data-target="#confirm-deleteV">
                        <i class="fas fa-trash-alt fa-2x"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Guía Master</th>
                      <th>Guía House</th>
                      <th>Consolidada</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php require 'includes/conexionDigitalizacion.php';
                      $sql = "SELECT * FROM registrovd WHERE VueloDigitalizacion_idVueloDigitalizacion = '$id'";
                      $guias=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
                      while ($rowGuias = $guias->fetch_array(MYSQLI_ASSOC)) {
                        $d=$rowGuias['descon'];
                         ?>
                      <tr>
                        <td><?php echo $rowGuias['guiaMaster']; ?></td>
                        <?php  if ($d) {
                          $idMaster= $rowGuias['idRegistroVD'];
                          $rutaModificar='<a href="editarDigitalizacionM.php?id='.$idMaster.'"><i class="fas fa-edit"></i></a>'; ?>
                            <td>
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#<?php echo $idMaster; ?>">Detalles</button>
                              <?php require 'pages\modalDesconoslidadas.php'; ?>
                            </td>
                          <td><?php echo "Desconsolidado"; ?></td>
                          <td><?php echo $rutaModificar; ?></td>
                          <td>
                            <a href="#" data-href="eliminarRegistroDigitalizacion.php?id=<?php echo $rowGuias['idRegistroVD']; ?>
                              " data-toggle="modal" data-target="#confirm-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                          </td>
                        <?php  }
                       else {
                         $rutaModificar="";
                         //'<a href="editarDigitalizacionH.php?id='.$rowGuias['idRegistroVD'].'"><i class="fas fa-edit"></i></a>'; ?>
                        <td><?php echo $rowGuias['guiaHouse']; ?></td>
                        <td>Consolidado</td>
                        <td><?php echo $rutaModificar; ?></td>
                        <td>
                          <a href="#" data-href="eliminarRegistroDigitalizacion.php?id=<?php echo $rowGuias['idRegistroVD']; ?>
                            " data-toggle="modal" data-target="#confirm-delete">
                              <i class="fas fa-trash-alt"></i>
                          </a>
                        </td>

                    <?php  } ?>

                      </tr>
                    <?php  }  ?>
                  </tbody>
                </table>
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
						¿Desea eliminar este registro?
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-danger btn-ok">Borrar</a>
					</div>
				</div>
			</div>
		</div>

    <div class="modal fade" id="confirm-deleteV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
      $('#confirm-deleteV').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
    </script>

    <script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>

</body>
</html>
