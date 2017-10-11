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
                <form  class="form-horizontal" method="POST" action="digitalizar.php.php">
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
                               <td><input type="text" id="descripcion" name="descripcion" class="form-control"/></td>
                               <td><input type="text" id="descripcion" name="descripcion" class="form-control"/></td>
                               <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" required/></td>
                               <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" required/></td>
                            </tr>
                        </tbody>
                      </table>
                </div>
                <div class="col-sm-2">
                  <br>
                  <button class="btn btn-lg btn-success btn-block "  type="submit"><i class="fa fa-file-text fa-fw"></i>Digitalizar</button>
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
                          <tr>
                             <td><input type="date" id="ingreso" name="ingreso" class="form-control" required/></td>
                             <td><input type="text" id="descripcion" name="descripcion" class="form-control"/></td>
                             <td><input type="text" id="descripcion" name="descripcion" class="form-control"/></td>
                             <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" required/></td>
                             <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" required/></td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
              <div class="col-sm-2">
                <br>
                <a href="generarInformes.php" class="btn btn-lg btn-info btn-block" type="button" name="button"> <i class="fa fa-search fa-fw"></i> Búsqueda</a>
              </div>
            </div>

            <!-- <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ticket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">01</div>
                                    <div>Ticket</div>
                                </div>
                            </div>
                        </div>
                        <a href="SolicitarTicket.php">
                            <div class="panel-footer">
                                <span class="pull-left">Solicita un ticket</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">02</div>
                                    <div>Estado del los tickets</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</body>

</html>
