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
                  <button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> Volver a la Mesa de ayuda</button>
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <button class="btn btn-danger btn-block" data-toggle="collapse" data-target="#demo"><i class="fa fa-question-circle-o fa-2x" aria-hidden="true"></i> ¿Cómo elegir la prioridad? <br> entre ALTA, MEDIA y BAJA?</button>
                  <div id="demo" class="collapse">
                    <div class="container ">
                      <h4><strong>Prioridad:</strong></h4>
                      <ul>
                        <li><strong>Baja:</strong> Son problemas que deben ser resueltos en un lapso no mayor a 4 horas. </li>
                        <li><strong>Media:</strong> Son problemas que deben ser resueltos en un lapso no mayor a 8 horas.</li>
                        <li><strong>Alta:</strong> Son problemas de requerimiento mayor que serán resueltos en un lapso mayor a 8 horas.</li>
                      </ul>
                    </div>
                  </div>
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
                          <select class="form-control" id="dirigido" name="dirigido">
                            <?php while($rowsRepo = $resulRepo->fetch_array(MYSQLI_ASSOC)){ ?>
                                    <option value="<?php echo $rowsRepo['idCategoriaReporte']; ?>"><?php echo $rowsRepo['nombreCategoriaReporte']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
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
                <div class="col-lg-3">
                  <label for="archivo" class="col-sm-3 control-label">Anexar pantalla:</label>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf,image/*">
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="Descripcion">Descripción de falla o problema:</label>
                    <textarea class="form-control" name="descripcion" rows="5" id="descripcion" required></textarea>
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
    <script type="text/javascript">
    setTimeout("validaExaminar()", 10);
      function validaExaminar(){
        var indice = document.getElementById('numeroGuias');
        var link = document.getElementById('des');
        var x = document.getElementById('Consol');
        var asociar= document.getElementById('asociar');

          if (x) {
            if (link.style.visibility === 'hidden') {
            link.style.visibility = 'visible';
            asociar.style.visibility = 'hidden';
            if (indice==0) {
              link.style.visibility = 'hidden';

            }
              } else {
                  link.style.visibility = 'hidden';
                  asociar.style.visibility = 'visible';
              }
          }

      }
    </script>
</body>

</html>
