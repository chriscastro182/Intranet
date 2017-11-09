<?php
require 'includes/conexion.php';

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
                    <img src="images/BannerSolicitarTicket.png" class="page-header" width="100%">
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <a href="MesaDeAyuda.php">
                  <button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver a la Mesa de ayuda</button>
                </a>
              </div>
            </div>
            <br>
            <div class="row">
              <form class="form-horizontal" enctype="multipart/form-data" action="guardarReporte.php" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="dirigido" class="col-sm-1 control-label">Tipo de requerimiento:</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="TipoRequerimiento_idTipoRequerimiento" id="TipoRequerimiento_idTipoRequerimiento">
                        <?php $sqlTip = "SELECT * FROM TipoRequerimiento";
                                $resul = $mysqli->query($sqlTip);
                                  while($rows = $resul->fetch_array(MYSQLI_ASSOC)){ ?>
                                    <option value="<?php echo $rows['idTipoRequerimiento']; ?>"><?php echo $rows['TipoRequerimiento']; ?></option>
                                  <?php } ?>
                      </select>
                    </div>
                    <label for="tipoRequerimiento" class="col-sm-1 control-label">Dirigido a:</label>
                      <div class="col-sm-2">
                        <select class="form-control" name="CategoriaReporte_idCategoriaReporte" id="CategoriaReporte_idCategoriaReporte">
                          <?php $sqlCat = "SELECT * FROM CategoriaReporte";
                                  $resultado = $mysqli->query($sqlCat);
                                    while($row = $resultado->fetch_array(MYSQLI_ASSOC)){ ?>
                                      <option value="<?php echo $row['idCategoriaReporte']; ?>"><?php echo $row['nombreCategoriaReporte']; ?></option>
                                    <?php } ?>
                        </select>
                      </div>
                    <label for="archivo" class="col-sm-1 control-label">Anexar pantalla:</label>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <input type="file" class="form-control" id="archivo" name="archivo" accept="image/*">
                        </div>
                      </div>
                </div>
                <div class="row">
                  <div class="col-sm-7">
                    <div class="form-group">
                      <label for="Descripcion">Descripción de falla o problema:</label>
                      <textarea class="form-control" name="descripcion" rows="5" id="descripcion" ></textarea>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <br>
                    <br>
                    <br>
                    <input type="submit"class="btn-lg btn-success btn-block" name="botonlg" value="Crear Ticket" />
                  </div>
                </div>

              </form>
            </div>
          </div>
            <!-- /.row -->
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
                        <a href="#">
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
