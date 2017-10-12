<!DOCTYPE html>
<html lang="es">

<head>
    <?php require('head.php') ?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        require('nav.php');        ?>
        <!-- Navigation -->
        <div id="page-wrapper">
          <?php require('slide.php'); ?>
            <div class="row">
                <div class="col-lg-12">
                  <h5>Noticias</h5>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-birthday-cake fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">C</div>
                                    <div>Cumpleaños!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Fechas de cumpleaños</span>
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
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">A</div>
                                    <div>Abandono</div>
                                </div>
                            </div>
                        </div>
                        <a href="abandono.php" target="_blank">
                            <div class="panel-footer">
                                <span class="pull-left">Realizar un cálculo</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cloud fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">R</div>
                                    <div>Redes sociales</div>
                                </div>
                            </div>
                        </div>
                        <a href="https://www.facebook.com/InterpuertoMMx/" target="_blank">
                            <div class="panel-footer">
                                <i class="fa fa-facebook-official fa-fw"></i>
                                <span class="pull-left">Facebook</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                          <a href="https://twitter.com/interpuerto" target="_blank">
                            <div class="panel-footer">
                                <i class="fa fa-twitter fa-fw"></i>
                                <span class="pull-left">Twitter</span>
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
                                    <i class="fa fa-life-ring fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">M</div>
                                    <div>Mesa de ayuda</div>
                                </div>
                            </div>
                        </div>
                        <a href="MesaDeAyuda.php">
                            <div class="panel-footer">
                                <span class="pull-left">Abrir Mesa de Ayuda</span>
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
