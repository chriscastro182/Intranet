<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';
$id = $_GET['id'];
  $registro= "SELECT * FROM registrovd WHERE idRegistroVD = '$id'";
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

            <!-- /.row -->
            <div class="row">
              <div class="col-sm-10">
                <form  class="form-horizontal" method="POST" action="editarRegistroDigitalizacion.php">
                    <!-- Aquí van los campos -->
                      <table class="table table-bordered table-condensed" style="text-align: center">
                        <thead>
                          <tr>
                            <th>Consolidación</th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($registro) {
                                $claveConsol=$rowRegistro['descon'];
                                if ($claveConsol==0) {
                                  $consolidacion="Consolidado";
                                }else {
                                  $consolidacion="Desconsolidado";
                                }
                              }  ?>
                            <tr>
                              <td>
                                  <div class="form-group">
                                     <select class="form-control" id="Consol" name="Consol" onchange="validaExaminar()">
                                       <option selected="selected" value="<?php echo $rowRegistro['descon']; ?>"><?php echo $consolidacion; ?></option>

                                       <?php if ($rowRegistro['descon']): ?>
                                         <option value="0">Consolidado</option>
                                       <?php else: ?>
                                         <option value="1">Desconsolidad</option>
                                       <?php endif; ?>

                                     </select>
                                   </div>
                              </td>
                              <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" value="<?php echo $rowRegistro['guiaMaster']; ?>" required/></td>
                              <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="<?php echo $rowRegistro['guiaHouse']; ?>" required/></td>
                              <td>
                                <a href="#" data-href="eliminarRegistroDigitalizacion.php?id=<?php echo $rowRegistro['idRegistroVD']; ?>
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
              <form class="form-horizontal" action="guardarDesconsolidado.php" method="post" id="des" >
                <div class="row">
                  <div class="col-sm-4">
                    <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">
                    <input type="hidden" name="editar" value="1">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" id="Master" name="Master" class="form-control" value="" placeholder="Número de guía Master por desconsolidar:" required/>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" id="numHouse" name="numHouse" class="form-control" value="" placeholder="Total de Guías House por capturar:" required/>
                  </div>
                  <div class="col-sm-2">
                    <div class="row" >
                      <button class="btn btn-lg btn-warning btn-block" type="submit" name="button">Desconsolidar guía</button>
                    </div>
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
    <!-- /#wrapper -->
  <script type="text/javascript">
  setTimeout("validaExaminar()", 5);
    function validaExaminar(){
      var indice = document.getElementById('numeroGuias');
      var link = document.getElementById('des');
      var x = document.getElementById('Consol');
      var asociar= document.getElementById('asociar');
      if (indice==0) {
        link.style.visibility = 'hidden';
        asociar.style.visibility = 'visible';
      }
        if (x) {
          if (link.style.visibility === 'hidden') {
          link.style.visibility = 'visible';
          asociar.style.visibility = 'hidden';
            } else {
                link.style.visibility = 'hidden';
                asociar.style.visibility = 'visible';
            }
        }
    }
  </script>
</body>

</html>
