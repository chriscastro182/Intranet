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
          <div class="row">
              <div class="col-lg-12">
                  <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
              </div>
          </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fas fa-file-alt fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">N</div>
                                    <div>Nuevo Oficio</div>
                                </div>
                            </div>
                        </div>
                            <div class="panel-footer">
                                <form class="form-horizontal" action="guardarOficio.php" method="post">
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="oficio">Oficio</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="oficio" name="oficio" placeholder="XXX-XX-XX-XX-XXXX-XXXX" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="fechaOficio">Fecha: </label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="date" class="form-control" id="fechaOficio" name="fechaOficio" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="fechaNotificacion">Fecha de notificación:</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="date" class="form-control" id="fechaNotificacion"name="fechaNotificacion" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="fechaNotificacion">Destino de mercancía</label>
                                    </div>
                                    <div class="col-sm-9 col-md-9">
                                       <select name="destino" class="form-control">
                                         <option value="Transferencia">Transferencia</option>
                                         <option value="Destrucción">Destrucción</option>
                                         <option value="Donación">Donación</option>
                                       </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="observacion">Observación</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <textarea type="" class="form-control" rows="4" id="observacion" name="observacion" placeholder="Máximo 180 caracteres" required></textarea>
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-group-justified btn-success" name="button">
                                    <span class="pull-left">
                                      <i class="fa fa-plus-circle fx2" aria-hidden="true"></i> Crear oficio
                                    </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </button>
                                </form>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">B</div>
                                    <div>Búsqueda de Oficio</div>
                                </div>
                            </div>
                        </div>
                          <a href="#">
                            <div class="panel-footer">
                              <form class="form-horizontal" id="formBuquedaOficio" action="busquedaOficioAbandono.php" method="POST">
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="oficio">Consecutivo:</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" form="formBuquedaOficio" class="form-control" id="idOficio" name="idOficio" placeholder="(Id) Ej. 2, 4, 9" required>
                                    </div>
                                  </div>
                                  <button class="btn btn-info btn-group-justified">
                                    <span class="pull-left">Búsqueda por Oficio</span>
                                    <span class="pull-right"><i class="fa fa-search"></i><i class="fas fa-file-alt fa-fw"></i></i></span>
                                    <div class="clearfix"></div>
                                  </button>
                                </form>       
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-sort-numeric-down fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">C</div>
                                    <div>Corregir cálculos</div>
                                </div>
                            </div>
                        </div>
                          <a href="#">
                            <div class="panel-footer">

                                <form class="form-horizontal" id="formBuquedaRecalculo" action="busquedaRecalculoAbandono.php" method="POST">
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <label for="Recalculo">Consecutivo:</label>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" form="formBuquedaRecalculo" class="form-control" id="idOficio" name="idOficio" placeholder="(Id) Ej. 2, 4, 9" required>
                                    </div>
                                  </div>
                                  <button class="btn btn-danger btn-group-justified">
                                    <span class="pull-left">Calcular con tarifa vigente</span>
                                    <span class="pull-right"><i class="fa fa-sort-numeric-down"></i><i class="fas fa-file-alt fa-fw"></i></i></span>
                                    <div class="clearfix"></div>
                                  </button>
                                </form>       
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
