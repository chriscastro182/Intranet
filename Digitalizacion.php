<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';

$numGuiasM = isset($_POST['numGuiasM']) ? $_POST['numGuiasM'] : '';
$registro= isset($_POST['registro']) ? $_POST['registro'] : '';
$vuelo= isset($_POST['vuelo']) ? $_POST['vuelo'] : '';
$ingreso= isset($_POST['ingreso']) ? $_POST['ingreso'] : '';

$indexGuia = $numGuiasM;


$resul=FALSE;
$resultado=FALSE;
$regisVD= FALSE;
$regis= FALSE;

if (!isset($_GET['idRVD']) ) { //Sí no hay una guía de registro previa es porque es la primera vez y se debe crear un nuevo registro de Vuelo
  $id_insert=0;
  $indexVuelo= "SELECT * FROM vuelodigitalizacion";
  $resul = $mysqli->query($indexVuelo);
  while($row = $resul->fetch_assoc()){
    $id_insert=$row['idVueloDigitalizacion'];
  }
  $id_insert++;

  if (isset($_POST['numGuiasM'])) {
    $idRVD=$id_insert;
    $sql = "INSERT INTO vuelodigitalizacion (idVueloDigitalizacion, fecha, registroVD, numGuias, documentoVD, estatusVD, nomVuelo)
                      VALUES ('$id_insert', '$ingreso', '$registro', '$numGuiasM', 'PDFdigital/', '1','$vuelo')";
    $resultado = $mysqli->query($sql);
  }
  // Aquí se hace el insert y declara la cantidad de tablas en base a la cantidad de guías
}else { //En caso contrario ejecutará sólo una consulta sin crear un nuevo registro de vuelo
  if (isset($_GET['idDescon'])) {
    $idDescon=$_GET['idDescon'];
  }
  $idRVD=$_GET['idRVD'];
  $registrosVD= "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$idRVD'";
  $regisVD = $mysqli->query($registrosVD);
  $rowVD = $regisVD->fetch_array(MYSQLI_ASSOC);

  $registros= "SELECT * FROM registrovd WHERE VueloDigitalizacion_idVueloDigitalizacion = '$idRVD'";
  $regis = $mysqli->query($registros);
  // Cálculo de Guías restantes
  $numGuiasM=$rowVD['numGuias'];
}
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
                    <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php
            if ($regisVD) {
              $vuelo=$rowVD['nomVuelo'];
              $registro=$rowVD['registroVD'];
              $ingreso=$rowVD['fecha']; ?>

                <div class="well well-md col-lg-10">
                  <div class="row">
                    <div class="col-lg-6">
                      <h3>Vuelo <?php echo $vuelo; ?> abierto</h3>
                      <h4>Registro número: <?php echo $registro; ?></h4>
                    </div>
                    <div class="col-lg-5">
                      <?php $mysqltime = date ("d-m-Y", strtotime($ingreso)); ?>
                      <h3>Fecha: <?php echo $mysqltime; ?></h3>
                    </div>
                    <div class="col-lg-1">
                      <?php echo '<a href="editarDigitalizacion.php?id='.$rowVD['idVueloDigitalizacion'].'"><i class="fas fa-edit fa-2x"></i></a>'; ?>
                    </div>
                </div>
              </div>
          <?php  }
            if ($resultado): ?>
              <div class="row">
                <div class="well well-md">
                  <div class="col-lg-6">
                    <h3>Vuelo <?php echo $vuelo; ?> abierto</h3>
                    <h4>Registro número: <?php echo $registro; ?></h4>
                  </div>
                  <div class="col-lg-6">
                    <?php $mysqltime = date ("d-m-Y", strtotime($ingreso)); ?>
                    <h3>Fecha: <?php echo $mysqltime; ?></h3>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <!-- /.row -->
            <div class="row">
              <div class="col-sm-10">
                <form  class="form-horizontal" method="POST" action="digitalizar.php">
                    <!-- Aquí van los campos -->
                      <table class="table table-bordered table-condensed" style="text-align: center">
                        <thead>
                          <tr>
                            <th># de Guías restantes</th>
                            <th>Consolidación</th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($regis) {
                            while($rowRegis = $regis->fetch_array(MYSQLI_ASSOC)) {
                                $claveConsol=$rowRegis['descon'];
                                if ($claveConsol==0) {
                                  $consolidacion="Consolidado";
                                  $rutaModificar="";
                                  //'<a href="editarDigitalizacionM.php?id='.$rowRegis['idRegistroVD'].'"><i class="fas fa-edit"></i></a>';
                                }else {
                                  $consolidacion="Desconsolidado";
                                  $rutaModificar='<a href="editarDigitalizacionH.php?id='.$rowRegis['idRegistroVD'].'"><i class="fas fa-edit"></i></a>';
                                }
                              ?>
                            <tr>
                                <td><?php echo $numGuiasM; ?></td>
                                <td><?php echo $consolidacion; ?></td>
                               <td><?php echo $rowRegis['guiaMaster']; ?></td>
                               <td><?php echo $rowRegis['guiaHouse']; ?></td>
                               <td><?php echo $rutaModificar; ?></td>
                               <td>
                                 <a href="#" data-href="eliminarRegistroDigitalizacion.php?id=<?php echo $rowRegis['idRegistroVD']; ?>
                                   " data-toggle="modal" data-target="#confirm-delete">
                                     <i class="fas fa-trash-alt"></i>
                                 </a>
                               </td>
                             </tr>
                        <?php
                            $guiaMaster = $rowRegis['guiaMaster'];
                            $guiaHouse = $rowRegis['guiaHouse'];
                            $numGuiasM--;
                            }
                          }  ?>
                          <?php if ($numGuiasM<1): $hideCierre=""; $hideAsociar='hidden="hidden"'; ?>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          <?php else: $hideCierre='hidden="hidden"'; $hideAsociar=""; ?>
                            <tr>
                              <td><?php echo $numGuiasM; ?></td>
                              <td>
                                  <div class="form-group">
                                     <select class="form-control" id="Consol" name="Consol" onchange="validaExaminar()">
                                       <option selected="selected" value="0">Consolidado</option>
                                       <option value="1">Desconsolidad</option>
                                     </select>
                                   </div>
                              </td>
                              <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control"  required/></td>
                              <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" required/></td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                </div>
                <div class="col-sm-2">
                  <br>
                  <input type="hidden" id="numeroGuias" name="numeroGuias" class="form-control" value="<?php echo $numGuiasM; ?>">
                  <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">

                  <div class="row" <?php echo $hideAsociar; ?>>
                    <button class="btn btn-lg btn-success btn-block " id="asociar" type="submit"><i class="fas fa-tasks"></i> Asociar Guía</button>
                  </div>
                </div>
              </form>
              <form class="form-horizontal" action="guardarDesconsolidado.php" method="post" id="des" >
                <div class="row">
                  <div class="col-sm-4">
                    <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">
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
              <form class="form-horizontal" enctype="multipart/form-data" action="cierreVueloD.php" method="post">
                <div class="row" <?php echo $hideCierre; ?>>
                  <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">
                  <input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf">
                  <button class="btn btn-lg btn-primary btn-block " id="cerrar" type="submit"><i class="fa fa-file-text fa-fw"></i>Cerrar Vuelo</button>
                </div>
              </form>
            </div>
            <!-- Tablas que contienten datos -->

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

    <script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>
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
