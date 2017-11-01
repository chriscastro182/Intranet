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
    $id_insert++;
  }

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

                <div class="well well-md">
                  <div class="row">
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
                          <?php if ($numGuiasM<1): $hideCierre=""; $hideAsociar='hidden="hidden"'; ?>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          <?php else: $hideCierre='hidden="hidden"'; $hideAsociar=""; ?>
                            <tr>
                              <td><?php echo $numGuiasM; ?></td>
                              <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" value="" required/></td>
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
              <form class="form-horizontal" action="guardarDesconsolidado.php" method="post" id="des" >
                <div class="row">
                  <div class="col-sm-4">
                    <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">
                    <input type="text" id="Master" name="Master" class="form-control" value="" placeholder="Número de guía Master por desconsolidar:" required/>
                  </div>
                  <div class="col-sm-4">
                    <input type="hidden" name="idVuelo" value="<?php echo $idRVD; ?>">
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
  <script type="text/javascript">
  setTimeout("validaExaminar()", 10);
    function validaExaminar(){
      var indice = document.getElementById('numeroGuias');
      var link = document.getElementById('des');
      var x = document.getElementById('Consol');
      var asociar= document.getElementById('asociar');

        if (x) {
          if (link.style.visibility === 'hidden') {
          link.style.visibility = 'visible';
          asociar.style.visibility = 'hidden';
          if (indice==0) {
            link.style.visibility = 'hidden';

          }
            } else {
                link.style.visibility = 'hidden';
                asociar.style.visibility = 'visible';
            }
        }

    }

  </script>
</body>

</html>
