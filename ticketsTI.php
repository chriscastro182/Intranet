<?php
require 'includes/conexion.php';
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])!=1) {
  header("Location:login.php");
}
$idUsuario=$_SESSION['idUsuario'];
$sql= "SELECT idSolucionador FROM solucionador WHERE Usuario_idUsuario ='$idUsuario'";
$resul = $mysqli->query($sql);
$rowSolucionador = $resul->fetch_array(MYSQLI_ASSOC);
$idSolucionador= $rowSolucionador['idSolucionador']; // Consulta para obtener el id del solicitante, sólo el número que servirá en la siguiente consulta

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
                    <img src="images/BannerTicketsTI.png" class="page-header" width="100%">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-ticket fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                      <?php
                                      if ($idSolucionador==1) {
                                        $sql= "SELECT * FROM reporte WHERE estatus = 1";
                                      }else {
                                        $sql= "SELECT * FROM reporte WHERE Solucionador_idSolucionador ='$idSolucionador' AND estatus = 1";
                                      }

                                      $resulTicketA = $mysqli->query($sql);
                                      $numTotal=0;
                                      while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) {
                                          $numTotal++;
                                      } ?>
                                    <div class="huge"><?php echo $numTotal;?></div>
                                    <div>Tickets Abiertos</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                              <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th>No. Ticket</th>
                                        <th>Descripción</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <tr>
                                          <?php $resulTicketA = $mysqli->query($sql);
                                          while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) { $idTicket=$ticketsA['idReporte'];?>
                                          <td><?php echo $idTicket;?></td>
                                          <td><p type="button" data-toggle="modal" data-target="#<?php echo $idTicket;?>"><?php echo $ticketsA['descripcion']; ?></p></td>
                                          <td>
                                            <?php require 'pages/modalTicket.php'; ?>
                                            <span class="pull-left"></span>
                                            <span class="pull-right">

                                              <i class="fa fa-arrow-circle-right"></i>
                                            </span>
                                            <div class="clearfix"></div>
                                          </td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                            </div>
                          </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                      <?php
                                      if ($idSolucionador==1) {
                                        $sql= "SELECT * FROM reporte WHERE estatus = 3";
                                      }else {
                                        $sql= "SELECT * FROM reporte WHERE Solucionador_idSolucionador ='$idSolucionador' AND estatus = 3";
                                      }

                                      $resulTicketA = $mysqli->query($sql);
                                      $numTotal=0;
                                      while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) {
                                          $numTotal++;
                                      } ?>
                                    <div class="huge"><?php echo $numTotal;?></div>
                                    <div>Ticket en Proceso</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                              <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th>No. Ticket</th>
                                        <th>Descripción</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <tr>
                                          <?php $resulTicketA = $mysqli->query($sql);
                                          while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) { $idTicket=$ticketsA['idReporte'];?>
                                          <td><?php echo $idTicket;?></td>
                                          <td><p type="button" data-toggle="modal" data-target="#<?php echo $idTicket;?>"><?php echo $ticketsA['descripcion']; ?></p></td>
                                          <td>
                                            <?php require 'pages/modalTicket.php'; ?>
                                            <span class="pull-left"></span>
                                            <span class="pull-right">

                                              <i class="fa fa-arrow-circle-right"></i>
                                            </span>
                                            <div class="clearfix"></div>
                                          </td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                            </div>
                          </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                      <?php
                                      if ($idSolucionador==1) {
                                        $sql= "SELECT * FROM reporte WHERE estatus = 5";
                                      }else {
                                        $sql= "SELECT * FROM reporte WHERE Solucionador_idSolucionador ='$idSolucionador' AND estatus = 5";
                                      }

                                      $resulTicketA = $mysqli->query($sql);
                                      $numTotal=0;
                                      while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) {
                                          $numTotal++;
                                      } ?>
                                    <div class="huge"><?php echo $numTotal;?></div>
                                    <div>Tickets Cerrados</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                              <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th>No. Ticket</th>
                                        <th>Descripción</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <tr>
                                          <?php $resulTicketA = $mysqli->query($sql);
                                          while ($ticketsA = $resulTicketA->fetch_array(MYSQLI_ASSOC)) { $idTicket=$ticketsA['idReporte'];?>
                                          <td><?php echo $idTicket;?></td>
                                          <td><p type="button" data-toggle="modal" data-target="#<?php echo $idTicket;?>"><?php echo $ticketsA['descripcion']; ?></p></td>
                                          <td>
                                            <?php require 'pages/modalTicket.php'; ?>
                                            <span class="pull-left"></span>
                                            <span class="pull-right">

                                              <i class="fa fa-arrow-circle-right"></i>
                                            </span>
                                            <div class="clearfix"></div>
                                          </td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                            </div>
                          </a>
                    </div>
                </div>
              <!-- Acaban las 3 columnas -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>

</body>

</html>
