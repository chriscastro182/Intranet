<?php
require 'includes/conexion.php';
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


$sql = "SELECT * FROM archivodigital WHERE guiaMaster = $guiaMaster";
$resultado = $mysqli->query($sql);
$fechaArchivoDigital = "";
$registroArchivoDigital = "";
$vueloArchivoDigital = "";
$guiaMaster = "";
$guiaHouse = "";

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
            <!-- /.row -->
            <div class="row">
              <div class="col-sm-10">

                <form  class="form-horizontal" enctype="multipart/form-data" method="POST" action="digitalizar.php">
                    <!-- Aquí van los campos -->
                      <table class="table table-bordered table-condensed" style="text-align: center">
                        <thead>
                          <tr>
                            <th># de Guías</th>
                            <th>Fecha de <br> Ingreso</th>
                            <th>Registro</th>
                            <th>Vuelo</th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                            <th>Consolidación</th>
                            <th>Archivo</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if ($resultado) {
                            while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td></td>
                               <td><?php echo $row['fechaArchivoDigital']; ?></td>
                               <td><?php echo $row['registroArchivoDigital']; ?></td>
                               <td><?php echo $row['vueloArchivoDigital']; ?></td>
                               <td><?php echo $row['guiaMaster']; ?></td>
                               <td><?php echo $row['guiaHouse']; ?></td>
                            </tr>
                        <?php
                              $fechaArchivoDigital = $row['fechaArchivoDigital'];
                              $registroArchivoDigital = $row['registroArchivoDigital'];
                              $vueloArchivoDigital = $row['vueloArchivoDigital'];
                              $guiaMaster = $row['guiaMaster'];
                              $guiaHouse = $row['guiaHouse'];
                            }
                          } ?>

                            <tr>
                              <td><input type="number" id="numeroGuias" name="numeroGuias" class="form-control" value="<?php echo $numeroGuias; ?>" autocomplete="off"></td>
                               <td><input type="date" id="ingreso" name="ingreso" class="form-control" value="<?php echo $fechaArchivoDigital; ?>" required/></td>
                               <td><input type="text" id="registro" name="registro" class="form-control" value="<?php echo $registroArchivoDigital; ?>" /></td>
                               <td><input type="text" id="Vuelo" name="Vuelo" class="form-control" value="<?php echo $vueloArchivoDigital; ?>" /></td>
                               <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" value="<?php echo $guiaMaster; ?>" required/></td>
                               <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="<?php echo $guiaHouse; ?>" required/></td>
                               <td>
                                 <div class="form-group">
                                    <select class="form-control" id="Consol" onchange="validaExaminar()">
                                      <option value="0">Consolidado</option>
                                      <option value="1">Desconsolidad</option>
                                    </select>
                                  </div>
                               </td>
                               <td><input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf"></td>
                            </tr>
                        </tbody>
                      </table>
                </div>
                <div class="col-sm-2">
                  <br>
                  <button class="btn btn-lg btn-success btn-block " id="asociar" type="submit"><i class="fa fa-file-text fa-fw"></i>Asociar Guía</button>
                  <button class="btn btn-lg btn-primary btn-block " id="cerrar" type="submit"><i class="fa fa-file-text fa-fw"></i>Cerrar Vuelo</button>
                </div>
              </form>
            </div>
            <!-- Tablas que contienten datos -->
            <div class="row" style="text-align: center">
              <h3>Documentos Digitalizados</h3>
            </div>
            <div class="row">
            
              <div class="col-sm-10">
                    <table class="table table-striped table-condensed" style="text-align: center">
                      <thead>
                        <tr>
                          <th>Fecha de <br> Ingreso</th>
                          <th>Registro</th>
                          <th>Vuelo</th>
                          <th>GuíaMaster</th>
                          <th>GuíaHouse</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
              <div class="col-sm-2">
                <br>
                <a href="#" class="btn btn-lg btn-info btn-block" type="button" name="button"> <i class="fa fa-search fa-fw"></i> Búsqueda</a>
              </div>
            </div>
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
