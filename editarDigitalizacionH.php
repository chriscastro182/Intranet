<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';
$id = $_GET['id'];
  $registro= "SELECT * FROM registrodescon WHERE idRegistroDescon = '$id'";
  $registroQery = $mysqli->query($registro);
  $rowRegistroH = $registroQery->fetch_array(MYSQLI_ASSOC);

  $idR = $rowRegistroH['RegistroVD_idRegistroVD'];

  $registro= "SELECT * FROM registrovd WHERE idRegistroVD = '$idR'";
  $registroQery = $mysqli->query($registro);
  $rowRegistro = $registroQery->fetch_array(MYSQLI_ASSOC);

  $idRVD = $rowRegistro['VueloDigitalizacion_idVueloDigitalizacion'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php require('head.php'); ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require('nav.php'); ?>
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <img src="images/BannerDigitalizacionEditar.png" class="page-header" width="100%">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <a class="btn btn-primary btn-lg" href="detalleVuelo.php?id=<?php echo $idRVD; ?>"><i class="fas fa-arrow-circle-left"></i> Atrás</a>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-sm-10">
                <form  class="form-horizontal" method="POST" action="editarRegistroDescon.php">
                    <!-- Aquí van los campos -->
                      <table class="table table-bordered table-condensed" style="text-align: center">
                        <thead>
                          <tr>
                            <th></th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" value="<?php echo $rowRegistro['guiaMaster']; ?>" disabled/></td>
                              <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="<?php echo $rowRegistroH['guiaHouse']; ?>" required/></td>
                              <td>
                                <a href="#" data-href="eliminarRegistroDescon.php?id=<?php echo $rowRegistroH['idRegistroDescon']; ?>
                                  " data-toggle="modal" data-target="#confirm-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                              </td>
                            </tr>
                        </tbody>
                      </table>
                </div>
                <div class="col-sm-2">
                  <br>
                  <input type="hidden" id="numeroGuias" name="numeroGuias" class="form-control" >
                  <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <div class="row" id="guardar">
                    <button class="btn btn-lg btn-success btn-block " id="asociar" type="submit"><i class="far fa-save"></i> Guardar edición</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- Tablas que contienten datos -->

        </div>
        <!-- /#page-wrapper -->
    </div>
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

    <script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>

</body>

</html>
