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
            <div class="container-fluid">
              <?php require('slide.php'); ?>
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
                        <a href="Digitalizacion.php?numeroGuias=$numeroGuias">
                            <div class="panel-footer">
                                <input class="form-control" type="text" name="numGuiasM" value="" placeholder="Número de guías">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <span class="pull-left">Crear nuevo vuelo </span>                                
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
                                    <div class="huge">C</div>
                                    <div>Consultar vuelo</div>
                                </div>
                            </div>
                        </div>
                        <a href="#" target="_blank">
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
                            <div class="panel-footer">
                                <i class="fa fa-plane fa-fw"></i>
                                <span class="pull-left">Búsqueda por vuelo</span>
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
