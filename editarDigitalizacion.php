<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';

$id= $_GET['id'];
$registrosVD= "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$id'";
$regisVD = $mysqli->query($registrosVD);
$rowVD = $regisVD->fetch_array(MYSQLI_ASSOC);

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
                    <img src="images/BannerDigitalizacion.png" class="page-header" width="100%">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php
            if ($regisVD) {
              $vuelo=$rowVD['nomVuelo'];
              $registro=$rowVD['registroVD'];
              $ingreso=$rowVD['fecha']; ?>

                <div class="well well-md col-lg-10">
                  <div class="row">
                    <form class="form-horizontal" action="modificarRegistroVuelo.php" method="post">
                      <div class="col-lg-6">
                        <h3>Vuelo <input type="text" name="vuelo" value="<?php echo $vuelo; ?>"></h3>
                        <h4>Registro número: <input type="text" name="registro" value="<?php echo $registro; ?>"></h4>
                      </div>
                      <div class="col-lg-5">
                        <?php $mysqltime = date ("d-m-Y", strtotime($ingreso)); ?>
                        <input type="hidden" name="id" value="<?php echo $rowVD['idVueloDigitalizacion']; ?>">
                        <h3>Fecha: <small><?php echo $mysqltime; ?></small> <input type="date" name="fecha" >  </h3>
                      </div>
                      <div class="col-lg-1">
                        <button type="submit" class="btn btn-success" name="button"> <i class="fas fa-check"></i> </button>
                      </div>
                    </form>
                </div>
              </div>
          <?php  } ?>

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>

					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-danger btn-ok">Borrar</a>
					</div>
				</div>
			</div>
		</div>

    <script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>
  <script type="text/javascript">
  setTimeout("validaExaminar()", 5);
    function validaExaminar(){
      var indice = document.getElementById('numeroGuias');
      var link = document.getElementById('des');
      var x = document.getElementById('Consol');
      var asociar= document.getElementById('asociar');
      if (indice==0) {
        link.style.visibility = 'hidden';
        asociar.style.visibility = 'visible';
      }
        if (x) {
          if (link.style.visibility === 'hidden') {
          link.style.visibility = 'visible';
          asociar.style.visibility = 'hidden';
            } else {
                link.style.visibility = 'hidden';
                asociar.style.visibility = 'visible';
            }
        }
    }
  </script>
</body>

</html>
