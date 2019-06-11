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
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">D</div>
                                    <div>Digitalización</div>
                                </div>
                            </div>
                        </div>
                        <a href="menuDigitalizacion.php">
                            <div class="panel-footer">
                                <span class="pull-left">Digitaliza y guarda documentos</span>
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
                                    <i class="far fa-money-bill-alt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">A</div>
                                    <div>Abandono</div>
                                </div>
                            </div>
                        </div>
                        <a href="menuAbandono.php" target="_blank">
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
                                    <i class="fas fa-exchange-alt  fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">T</div>
                                    <div>Transferencias</div>
                                </div>
                            </div>
                        </div>
                        <a href="menuTransferencia.php">
                          <div class="panel-footer">
                              <span class="pull-left">Solicitar una transferencia</span>
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
            <div class="row">
                <div class="col-lg-12">
                  <h5>Noticias</h5>
                  <div class="row" style="margin: 0px auto; text-align:center;">
                    <video width="640" height="480" controls>
                      <source src="images/aniversario.mp4" type="video/mp4">
                      Remembranza a un año de .
                    </video>
                  </div>
                  <div class="row">
                    <?php  $indexReport= "SELECT * FROM post ORDER BY idPost DESC ";
                        $resul = $mysqli->query($indexReport);
                        $renglones=0;
                        $visibilidad= "hidden";
                        while($row = $resul->fetch_assoc()){ 
                            $renglones++; 
                             if ($renglones!=0):
                            $visibilidad="";
                          endif; ?>
                    <div class="col-lg-2">
                      <?php 
                      if ($row['fechaPost']!=null) {
                          $date = $row['fechaPost'];
                        $phpdate = strtotime( $date );
                        $mysqldate = date( 'd/m/Y g:i A', $phpdate );
                        echo $mysqldate;
                      }
                    ?>
                    </div>
                    <div class="col-lg-10">
                      <ul>
                            <h2 <?php $visibilidad ?>style="width: 60%; text-align: center"><?php echo $row['tituloPost']; ?></h2>
                            <h4 <?php $visibilidad ?> style="width: 60%; text-align: center"><?php echo $row['contenidoPost']; ?></h4>
                            <?php if ($row['imagenPost']!='post/'): ?>
                              <img <?php $visibilidad ?> src="<?php echo $row['imagenPost']; ?>"class="img-rounded" width="60%" alt="">
                            <?php endif;
                            if (isset($_SESSION['idUsuario'])) {
                              require('pages/queryComentario.php');
                              require('nuevoComentario.php');
                            } ?>
                      </ul>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



</body>

</html>
