<?php
require 'includes/conexion.php';
$hide= "hidden";
$hideTI= "";
if(!isset($_SESSION)){
        session_start();
        if ($_SESSION['Rol_idRol']==1) {
          $hide= "";
          $hideTI= "hidden";
        }
    }
if (isset($_SESSION['Rol_idRol'])==FALSE) {
  header("Location:login.php");
}
require 'pages\querySolicitante.php';
if ($rowSolicitante['idSolicitante']==NULL) {

}
$sql= "SELECT * FROM reporte WHERE estatus = 1";
$resulTicketA = $mysqli->query($sql);
$numTotal=0;
while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) {
    $numTotal++;
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
                    <img src="images/BannerMesaDeAyuda.png" class="page-header" width="100%">

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ticket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Nuevo</div>
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
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green" <?php echo $hideTI; ?>>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Estado</div>
                                    <div>Estado del los tickets</div>
                                </div>
                            </div>
                        </div>
                        <a href="estadoTickets.php">
                            <div class="panel-footer">
                                <span class="pull-left">Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-danger" <?php echo $hide; ?>>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cogs fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $numTotal; ?></div>
                                    <div>Total de tickets por atender</div>
                                </div>
                            </div>
                        </div>
                        <a href="ticketsTI.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver tickets</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
        </div>

        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>
