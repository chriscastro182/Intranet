<!DOCTYPE html>
<?php require 'pages/validaSesion.php'; ?>
<html lang="es">
<head>
    <?php
    require('includes/conexion.php');
    require('head.php'); ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
        require('nav.php');        ?>
        <!-- Navigation -->
        <div id="page-wrapper">
          <div class="row">
              <div class="col-lg-12">
                  <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
              </div>
          </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-plane fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">N</div>
                                    <div>Nuevo vuelo</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <form class="form-horizontal" action="Digitalizacion.php" method="post">
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="numGuiasM">Guías</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="numGuiasM" name="numGuiasM" placeholder="Número de guías en el vuelo" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="registro">Registro:</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="registro"name="registro" placeholder="Número de registro" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="vuelo">Vuelo:</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="vuelo" name="vuelo" placeholder="Número de vuelo" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="ingreso">Fecha:</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="date" class="form-control" id="ingreso"name="ingreso" required>
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-group-justified btn-success" name="button">
                                    <span class="pull-left">
                                      <i class="fa fa-plus-circle fx2" aria-hidden="true"></i> Crear nuevo vuelo
                                    </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </button>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="far fa-file fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">C</div>
                                    <div>Consultar vuelo</div>
                                </div>
                            </div>
                        </div>
                        <a href="archivoDigitalizacion.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left">Vuelos previamente digitalizados</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">B</div>
                                    <div>Búsqueda de vuelo</div>
                                </div>
                            </div>
                        </div>
                          <a href="#">
                            <a href="BusquedaDigitalizacion.php">
                              <div class="panel-footer">
                                  <i class="fa fa-plane fa-fw"></i>
                                  <span class="pull-left">Búsqueda por vuelo</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                            </a>
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



</body>

</html>
