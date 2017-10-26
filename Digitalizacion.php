<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';

$numGuiasM = isset($_POST['numGuiasM']) ? $_POST['numGuiasM'] : '';
$registro= isset($_POST['registro']) ? $_POST['registro'] : '';
$vuelo= isset($_POST['vuelo']) ? $_POST['vuelo'] : '';
$ingreso= isset($_POST['ingreso']) ? $_POST['ingreso'] : '';

$indexGuia = $numGuiasM;

$indexVuelo= "SELECT * FROM vuelodigitalizacion";
$id_insert=0;
$resul = $mysqli->query($indexVuelo);
while($row = $resul->fetch_assoc()){
  $id_insert++;
}

$sql = "INSERT INTO vuelodigitalizacion (idVueloDigitalizacion, fecha, registroVD, numGuias, documentoVD, estatusVD, nomVuelo)
                  VALUES ('$id_insert', '$ingreso', '$registro', '$numGuiasM', 'PDFdigital/', '1','$vuelo')";
$resultado = $mysqli->query($sql);
// Aquí se hace el insert y creará la cantidad de tablas en base a la cantidad de guías


$mostrar="";
$mostrarDigitalizar="hidden";
if (!isset($_GET['guiaMaster'])) {
  $_GET['guiaMaster']=0;
  $_GET['numeroGuias']=0;
  $_GET['Consol']=0;
  $mostrar="hidden";
}
$numeroGuias = $_GET['numeroGuias'];
$guiaMaster = $_GET['guiaMaster'];
$Consol = $_GET['Consol'];
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])==FALSE) {
  header("Location:login.php");
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
            <?php if ($resultado): ?>
              <div class="row">
                <div class="well well-sm">
                  <h3>Vuelo <?php echo $vuelo; ?> abierto</h3>
                  <h4>Registro número: <?php echo $registro; ?></h4>
                </div>
              </div>
            <?php endif; ?>
            <!-- /.row -->
            <div class="row">
              <div class="col-sm-10">
                <form  class="form-horizontal" enctype="multipart/form-data" method="POST" action="digitalizar.php">
                    <!-- Aquí van los campos -->
                      <table class="table table-bordered table-condensed" style="text-align: center">
                        <thead>
                          <tr>
                            <th># de Guías por capturar</th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                            <th>Consolidación</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($resul) {
                            while($row = $resul->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td></td>
                               <td><?php echo $row['guiaMaster']; ?></td>
                               <td><?php echo $row['guiaHouse']; ?></td>
                            </tr>
                        <?php
                            $guiaMaster = $row['guiaMaster'];
                            }
                          } ?>

                            <tr>
                              <td><input type="number" id="numeroGuias" name="numeroGuias" class="form-control" value="<?php echo $numGuiasM; ?>" autocomplete="off"></td>
                              <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" value="<?php echo $guiaMaster; ?>" required/></td>
                               <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="" required/></td>
                               <td>
                                 <div class="form-group">
                                    <select class="form-control" id="Consol" onchange="validaExaminar()">
                                      <option value="0">Consolidado</option>
                                      <option value="1">Desconsolidad</option>
                                    </select>
                                  </div>
                               </td>
                            </tr>
                        </tbody>
                      </table>
                </div>
                <div class="col-sm-2">
                  <br>
                  <input hidden type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf">
                  <input type="hidden" name="idVuelo" value=""><?php echo $id_insert; ?>
                  <button class="btn btn-lg btn-success btn-block " id="asociar" type="submit"><i class="fa fa-file-text fa-fw"></i>Asociar Guía</button>
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
    function validaExaminar(){
      var btnCerrar = document.getElementById('cerrar');
      var btnAsociar = document.getElementById('asociar');
      var link = document.getElementById('archivo');
      var x = document.getElementById('Consol');
      if (x) {
        if (link.style.visibility === 'hidden') {
        link.style.visibility = 'visible';
        btnCerrar.style.visibility = 'visible';
        btnAsociar.style.visibility= 'hidden';
          } else {
              link.style.visibility = 'hidden';
              btnCerrar.style.visibility = 'hidden';
              btnAsociar.style.visibility= 'visible';
          }
      }
    }

  </script>
</body>

</html>
