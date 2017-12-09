<!DOCTYPE html>
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
          <!-- <div class="row">
              <div class="col-lg-12">
                  <img src="images/BannerDigitalizacio.png" class="page-header" width="100%">
              </div>
          </div> -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exchange fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Nueva</div>
                                    <div>Transferencia</div>
                                </div>
                            </div>
                        </div>
                          <a href="nuevaTransferencia.php">
                            <div class="panel-footer">
                              <span class="pull-left">Registrar transferencia</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                            </div>
                          </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-pdf-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Consultar</div>
                                    <div>Transferencia</div>
                                </div>
                            </div>
                        </div>
                        <a href="transferencia.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left">Transferencias previamente hechas</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
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
