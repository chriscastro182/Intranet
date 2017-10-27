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
if (!isset($_GET['idRVD'])) { //Sí no hay una guía de registro previa es porque es la primera vez y se debe crear un nuevo registro de Vuelo
  $id_insert=0;
  $indexVuelo= "SELECT * FROM vuelodigitalizacion";
  $resul = $mysqli->query($indexVuelo);

  while($row = $resul->fetch_assoc()){
    $id_insert++;
  }
  $sql = "INSERT INTO vuelodigitalizacion (idVueloDigitalizacion, fecha, registroVD, numGuias, documentoVD, estatusVD, nomVuelo)
                    VALUES ('$id_insert', '$ingreso', '$registro', '$numGuiasM', 'PDFdigital/', '1','$vuelo')";
  $resultado = $mysqli->query($sql);

  // Aquí se hace el insert y declara la cantidad de tablas en base a la cantidad de guías
}else { //En caso contrario ejecutará sólo una consulta sin crear un nuevo registro de vuelo
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
              $ingreso=$rowVD['registroVD'];
            }

            if ($resultado): $mysqltime = date ("d-m-Y", strtotime($ingreso));?>
              <div class="row">
                <div class="well well-sm">
                  <div class="col-lg-6">
                    <h3>Vuelo <?php echo $vuelo; ?> abierto</h3>
                    <h4>Registro número: <?php echo $registro; ?></h4>
                  </div>
                  <div class="col-lg-6">
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
                            <th># de Guías restantes por capturar</th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                            <th>Consolidación</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($regis) {
                            while($rowRegis = $regis->fetch_array(MYSQLI_ASSOC)) {
                                $claveConsol=$rowRegis['descon'];
                                if ($claveConsol==0) {
                                  $consolidacion="Consolidado";
                                }else {
                                  $consolidacion="Desconsolidado";
                                }
                              ?>
                            <tr>
                                <td><?php echo $numGuiasM; ?></td>
                               <td><?php echo $rowRegis['guiaMaster']; ?></td>
                               <td><?php echo $rowRegis['guiaHouse']; ?></td>
                               <td><?php echo $consolidacion; ?></td>
                            </tr>
                        <?php
                            $guiaMaster = $rowRegis['guiaMaster'];
                            $guiaHouse = $rowRegis['guiaHouse'];
                            $numGuiasM--;
                            }
                          }  ?>
                          <?php if ($numGuiasM<=0): $hideCierre=""; $hideAsociar='hidden="hidden"'; ?>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          <?php else: $hideCierre='hidden="hidden"'; $hideAsociar=""; ?>
                            <tr>
                              <td><?php echo $numGuiasM; ?></td>
                              <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" value="<?php echo $guiaMaster; ?>" required/></td>
                               <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="" required/></td>
                               <td>
                                 <div class="form-group">
                                    <select class="form-control" id="Consol" name="Consol" onchange="validaExaminar()">
                                      <option selected="selected" value="0">Consolidado</option>
                                      <option value="1">Desconsolidad</option>
                                    </select>
                                  </div>
                               </td>
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
                    <button class="btn btn-lg btn-success btn-block " id="asociar" type="submit"><i class="fa fa-file-text fa-fw"></i>Asociar Guía</button>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-lg-10">
                  <form class="form-horizontal" action="guardarDesconsolidado.php" method="post" id="des">
                    <table class="table table-bordered table-condensed" style="text-align: center">
                      <thead>
                        <tr>
                          <th># de Guías restantes por capturar</th>
                          <th>GuíaMaster</th>
                          <th>GuíaHouse</th>
                          <th>Consolidación</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr  >
                          <td></td>
                          <td></td>
                          <td><input type="text" id="guiaHouseDescon" name="guiaHouse" class="form-control" value="" required/></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>

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
  <script type="text/javascript">
  setTimeout("validaExaminar()", 10);
    function validaExaminar(){

      var link = document.getElementById('des');
      var x = document.getElementById('Consol');
      if (x) {
        if (link.style.visibility === 'hidden') {
        link.style.visibility = 'visible';
          } else {
              link.style.visibility = 'hidden';
          }
      }
    }

  </script>
</body>

</html>
