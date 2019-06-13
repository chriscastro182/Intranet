<?php
  if ($_GET['id']!=null) {

    $id = $_GET['id'];

    require 'includes/conexionDigitalizacion.php';

    $sql = "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$id'";

    $vuelos=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");

    $resultado = $mysqli->query($sql);
      if ($resultado->num_rows==1) {
          $obj = $resultado->fetch_object();
          //var_dump($obj);
      }

    $rowVuelos = $vuelos->fetch_array(MYSQLI_ASSOC);

    $validaEstatus= $rowVuelos['estatusVD'];

    if ($validaEstatus==5) {
      $validaEstatus="Vuelo Cerrado";
    }else {
      $validaEstatus="Vuelo Abierto";
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
        <div id="page-wrapper">
          <div class="row">
              <div class="col-lg-12">
                  <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
              </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <a href="archivoDigitalizacion.php">
                <button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>Archivo de digitalización</button>
              </a>
            </div>
          </div>
            <div class="col-lg-12">
              <div class="well well-sm">
                <div class="row">
                  <div class="col-lg-6">
                    <h3>Registro: <?php echo $obj->registroVD; ?></h3>
                    <h4>Fecha: <?php echo $obj->fecha; ?></h4>
                    <h4>
                    <?php if ($obj->documentoVD=="PDFdigital/") {
                        echo "No cuenta con archivo PDF";
                      }else {
                          echo '<a href="'.$obj->documentoVD.'" target="_blank"><i class="fas fa-file-pdf "></i> PDF de Vuelo asociado</a>';
                      }
                      if($obj->docTrans!=null) { ?>
                            <a href="<?php echo $obj->docTrans ?>" target="_blank"><i class="fas fa-file-pdf "></i> PDF de Transferencias</a>
                      <?php } ?> 
                    </h4>
                  </div>
                  <div class="col-lg-5">
                    <h3>Vuelo: <?php echo $obj->nomVuelo; ?></h3>
                    <h4>Estatus: <?php echo $validaEstatus; ?></h4>
                    <h4>
                      <?php if($obj->docPrevio!=null) { ?>
                            <a href="<?php echo $obj->docPrevio ?>" target="_blank"><i class="fas fa-file-pdf "></i> PDF de Previos</a>
                      <?php } ?>  

                      <?php if($obj->docSalidas!=null) { ?>
                            <a href="<?php echo $obj->docSalidas ?>" target="_blank"><i class="fas fa-file-pdf "></i> PDF de Salidas</a>
                      <?php } ?>  

                      
                    </h4>
                  </div>
                  <div class="col-lg-1">
                    <?php echo '<a href="editarDigitalizacion.php?id='.$obj->idVueloDigitalizacion.'"><i class="fas fa-edit fa-2x"></i></a>'; ?>
                    <br>
                    <br>
                    <a href="#" data-href="eliminarRegistroVuelo.php?id=<?php echo $obj->idVueloDigitalizacion; ?>
                      " data-toggle="modal" data-target="#confirm-deleteV">
                        <i class="fas fa-trash-alt fa-2x"></i>
                    </a>
                    <br>
                    <br>
                    <?php
                      if ($rowVuelos['estatusVD']!=5) {
                        echo '<a href="Digitalizacion.php?idRVD='.$obj->idVueloDigitalizacion.'"><i class="fas fa-plus fa-2x"></i></a>';
                      }
                     ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <?php if($obj->docPrevio==null) { ?>
                      <form id="previoForm" action="adjuntarPrevio.php" method="post" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="idVuelo" value="<?php echo $obj->idVueloDigitalizacion; ?>">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="" for="previo">Previos</label>
                            <input type="file" form="previoForm" name="previo" id="previo" accept="application/pdf" required>
                          </div>  
                          <button class="btn btn-warning" type="submit">Adjuntar Previo</button>
                        </div>
                      </form>
              <?php } ?>    

              <?php if($obj->docSalidas==null) { ?>
                <form action="adjuntarSalida.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idVuelo" value="<?php echo $obj->idVueloDigitalizacion; ?>">
                  <div class="col-md-4">
                    <div class="form-group">
                          <label class="" for="">Salidas</label>
                          <input type="file" name="salida" id="salida"  accept="application/pdf" required>
                    </div>  
                    <button class="btn btn-success" type="submit">Adjuntar Salida</button>
                  </div>
                </form>
              <?php } ?>   

              <?php if($obj->docTrans==null) { ?>
                <form action="adjuntarTrans.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="idVuelo" value="<?php echo $obj->idVueloDigitalizacion; ?>">
                  <div class="col-md-4">
                    <div class="form-group">
                          <label class="" for="">Transferencias</label>
                          <input type="file" name="trans" id="trans"  accept="application/pdf" required>
                    </div>  
                    <button class="btn btn-primary" type="submit">Adjuntar Transferencias</button>
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
