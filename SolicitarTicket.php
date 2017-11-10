<?php
require 'includes/conexion.php';
$sqlRepo="SELECT * FROM categoriareporte ORDER BY categoriareporte.idCategoriaReporte ASC ";
$resulRepo = $mysqli->query($sqlRepo);

$sqlSist="SELECT * FROM sistemaproceso ORDER BY sistemaproceso.idSistemaProceso ASC ";
$resulSist = $mysqli->query($sqlSist);
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
          <!-- Todo el form nuevo -->
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <a href="MesaDeAyuda.php">
                  <button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver a la Mesa de ayuda</button>
                </a>
              </div>
            </div>
            <br>
            <form class="form-horizontal" enctype="multipart/form-data" action="guardarReporte.php" method="post" autocomplete="off">
              <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="prioridad" class="col-sm-3 control-label">Prioridad: </label>
                        <div class="col-sm-9">
                          <select class="form-control" name="prioridad">
                            <option value="Baja">Baja</option>
                            <option value="Media">Media</option>
                            <option value="Alta">Alta</option>
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="dirigido" class="col-sm-3 control-label">Dirigido: </label>
                        <div class="col-sm-9">
                          <select class="form-control" name="dirigido">
                            <?php while($rowsRepo = $resulRepo->fetch_array(MYSQLI_ASSOC)){ ?>
                                    <option value="<?php echo $rowsRepo['idCategoriaReporte']; ?>"><?php echo $rowsRepo['nombreCategoriaReporte']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="sistema" class="col-sm-3 control-label">Sistema: </label>
                        <div class="col-sm-9">
                          <select class="form-control" name="sistema">
                            <?php while($rowsSist = $resulSist->fetch_array(MYSQLI_ASSOC)){ ?>
                                    <option value="<?php echo $rowsSist['idSistemaProceso']; ?>"><?php echo $rowsSist['nombreSistemaPro']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="area" class="col-sm-3 control-label">Area Solicitante: </label>
                      <div class="col-sm-9">
                        <div class="well well-sm">
                          <?php $area=$_SESSION['Area_idArea'];
                                  $sqlArea="SELECT * FROM area WHERE idArea = '$area'";
                                  $resulArea = $mysqli->query($sqlArea);
                                  $rowsArea = $resulArea->fetch_array(MYSQLI_ASSOC); ?>
                          <input type="hidden" name="area" value="<?php echo $rowsArea['idArea']; ?>">
                          <h4><?php echo $rowsArea['nombreArea']; ?></h4>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="dirigido" class="col-sm-3 control-label">Solicita: </label>
                      <div class="col-sm-9">
                        <div class="well well-sm"> <?php $nomCompleto = $_SESSION['u_nombre'].' '.$_SESSION['apellidos']; ?>
                          <h4><?php echo $nomCompleto; ?></h4>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <label for="archivo" class="col-sm-3 control-label">Anexar pantalla:</label>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="file" class="form-control" id="archivo" name="archivo" accept="image/*">
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
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
          <!-- fin del form nuevo -->

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>
