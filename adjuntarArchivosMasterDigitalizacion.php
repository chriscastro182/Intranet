<?php
  if ($_GET['id']!=null) {

    $id = $_GET['id'];

    require 'includes/conexionDigitalizacion.php';

    $sql = "SELECT * FROM `digitalizacion`.`registrovd` WHERE `idRegistroVD` = '$id'";
    

    $guiaMaster=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
    //var_dump($guiaMaster);
      if ($guiaMaster->num_rows==1) {
          $obj = $guiaMaster->fetch_object();
          //var_dump($obj);

          $sql = "SELECT * FROM `digitalizacion`.`vuelodigitalizacion` WHERE `idVueloDigitalizacion` = '$obj->VueloDigitalizacion_idVueloDigitalizacion'";
          $vuelo=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
          //var_dump($sql);
          if ($vuelo->num_rows==1) {
              $vueloObj = $vuelo->fetch_object();
              //var_dump($vueloObj);              
          }
      }

  }else {
    header('Location: archivoDigitalizacion.php');
  }

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require('includes/conexion.php');
    require('head.php');
     ?>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require('nav.php');  ?>
        <!-- Navigation -->
        <div id="page-wrapper" >
          <div class="row" >
            <div class="col-lg-12" >
                <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
            </div>
            <div class="col-lg-4" >
              <a href="BusquedaDigitalizacion.php">
                <button type="button" class="btn btn-info btn-block" name="button"><i class="fa fa-arrow-left " aria-hidden="true"></i>Archivo de digitalización</button>
              </a>
            </div>
          </div>
            <div class="col-lg-12">
              <div class="well well-sm">
                <div class="row">
                  <div class="col-lg-6">
                    <h3>Registro: <?php echo $vueloObj->registroVD; ?></h3>
                    <h4>Fecha: <?php echo $vueloObj->fecha; ?></h4>
                    <h4>
                    <?php if ($vueloObj->documentoVD=="PDFdigital/") {
                        echo "No cuenta con archivo PDF";
                      }else {
                          echo '<a class="btn btn-primary" href="'.$vueloObj->documentoVD.'" target="_blank"><i class="fas fa-file-pdf "></i> <span class="label label-primary">PDF de Vuelo asociado </sapn></a>';
                      }
                      if($vueloObj->docTrans!=null) { ?>
                            <a href="<?php echo $vueloObj->docTrans ?>" target="_blank"><i class="fas fa-file-pdf "></i> PDF de Transferencias</a>
                      <?php } ?> 
                    </h4>
                  </div>
                  <div class="col-lg-5">
                    <h3>Vuelo: <?php echo $vueloObj->nomVuelo; ?></h3>
                    <h4>Guia Master: <?php echo $obj->guiaMaster; ?> </h4>
                    <h4>
                      <?php if($obj->docPrevio!=null) { ?>
                            <a class="btn btn-warning" href="<?php echo $obj->docPrevio ?>" target="_blank"><i class="fas fa-file-pdf "></i> <span class="label label-warning"> PDF de Previo</span></a>
                      <?php } ?>  

                      <?php if($obj->docSalida!=null) { ?>
                            <a class="btn btn-success" href="<?php echo $obj->docSalida ?>" target="_blank"><i class="fas fa-file-pdf "></i> <span class="label label-success"> PDF de Salida </span></a>
                      <?php } ?>  

                      <?php if($obj->docAveria!=null) { ?>
                            <a class="btn btn-danger" href="<?php echo $obj->docAveria ?>" target="_blank"><i class="fas fa-file-pdf "></i> <span class="label label-danger">PDF de Avería</span></a>
                      <?php } ?>  
                    </h4>
                  </div>
                  <div class="col-lg-1">
                    <?php echo '<a href="editarDigitalizacion.php?id='.$vueloObj->idVueloDigitalizacion.'"><i class="fas fa-edit fa-2x"></i></a>'; ?>
                    <br>
                    <br>
                    <a href="#" data-href="eliminarRegistroVuelo.php?id=<?php echo $vueloObj->idVueloDigitalizacion; ?>
                      " data-toggle="modal" data-target="#confirm-deleteV">
                        <i class="fas fa-trash-alt fa-2x"></i>
                    </a>
                    <br>
                    <br>
                    <?php
                      if ($vueloObj->estatusVD!=5) {
                        echo '<a href="Digitalizacion.php?idRVD='.$vueloObj->idVueloDigitalizacion.'"><i class="fas fa-plus fa-2x"></i></a>';
                      }
                     ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <?php if($obj->docPrevio==null) { ?>
                <form id="previoForm" action="adjuntarPrevioMaster.php" method="post" enctype="multipart/form-data" autocomplete="off">
                      <input type="hidden" name="idMaster" value="<?php echo $obj->idRegistroVD; ?>">
                  <div class="col-md-4">
                    <div class="form-group">
                      <h4><label class="label label-warning" for="previo">Previos</label></h4>
                      <input type="file" form="previoForm" name="previo" id="previo" accept="application/pdf" required>
                    </div>  
                    <button class="btn btn-warning" type="submit">Adjuntar Previo</button>
                  </div>
                </form>
              <?php } ?>    

              <?php if($obj->docSalida==null) { ?>
                <form action="adjuntarSalidaMaster.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idMaster" value="<?php echo $obj->idRegistroVD; ?>">
                  <div class="col-md-4">
                    <div class="form-group">
                          <h4><label class="label label-success" for="">Salidas</label></h4>
                          <input type="file" name="salida" id="salida"  accept="application/pdf" required>
                    </div>  
                    <button class="btn btn-success" type="submit">Adjuntar Salida</button>
                  </div>
                </form>
              <?php } ?>   

              <?php if($obj->docAveria==null) { ?>
                <form action="adjuntarAveriaMaster.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idMaster" value="<?php echo $obj->idRegistroVD; ?>">
                  <div class="col-md-4">
                    <div class="form-group">
                          <h4><label class="label label-danger" for="">Avería</label></h4>
                          <input type="file" name="averia" id="averia"  accept="application/pdf" required>
                    </div>  
                    <button class="btn btn-danger" type="submit">Adjuntar Avería</button>
                  </div>
                </form>
              <?php } ?>   
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>    

    <div class="modal fade" id="confirm-deleteV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
          </div>

          <div class="modal-body">
            ¿Desea eliminar este registro de vuelo?
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger btn-ok">Borrar</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      $('#confirm-deleteV').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
    </script>

</body>
</html>
