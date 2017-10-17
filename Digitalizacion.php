<?php
require 'includes/conexion.php';
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])==FALSE) {
  header("Location:login.php");
}?>
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
                            <th>Fecha de <br> Ingreso</th>
                            <th>Registro</th>
                            <th>Vuelo</th>
                            <th>GuíaMaster</th>
                            <th>GuíaHouse</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td><input type="date" id="ingreso" name="ingreso" class="form-control" required/></td>
                               <td><input type="text" id="registro" name="registro" class="form-control"/></td>
                               <td><input type="text" id="Vuelo" name="Vuelo" class="form-control"/></td>
                               <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" required/></td>
                               <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" required/></td>
                            </tr>
                        </tbody>
                      </table>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="archivo" class="col-sm-1 control-label">Archivo:</label>
                    <input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf">
                  </div>
                  <button class="btn btn-lg btn-success btn-block "  type="submit"><i class="fa fa-file-text fa-fw"></i>Digitalizar</button>
                </div>
              </form>
            </div>
            <!-- Tablas que contienten datos -->
            <div class="row" style="text-align: center">
              <h3>Documentos Digitalizados</h3>
            </div>
            <div class="row">
              <?php
               ?>
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
                          <?php $sql = "SELECT * FROM archivodigital";
                          $resultado = $mysqli->query($sql);
                          while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                          <tr>
                             <td><?php echo $row['fechaArchivoDigital']; ?></td>
                             <td><?php echo $row['fechaArchivoDigital']; ?></td>
                             <td><?php echo $row['vueloArchivoDigital']; ?></td>
                             <td><?php echo $row['guiaMaster']; ?></td>
                             <td><?php echo $row['guiaHouse']; ?></td>
                          </tr>
                        <?php } ?>
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
</body>

</html>
