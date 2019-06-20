<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';
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
            <div class="row">
              <div class="col-md-4 col-sm-4">
                <div class="form-group">
                  <label for="">Elegir tipo de guía</label>
                  <select id="selectorGuia" class="form-control" name="">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="0">Master</option>
                    <option value="1">House</option>
                  </select>
                </div>
              </div>
              <div id="guiaMasterDiv" class="col-md-4 col-sm-4">
                <div class="form-group">
                  <label for="">Búsqueda por guía Master</label>
                  <input type="text" class="form-control" id="guiaMaster" name="guiaMaster" placeholder="">
                  <p class="help-block">Teclea la guía master.</p>
                </div>
              </div>
              <div id="guiaHouseDiv" class="col-md-4 col-sm-4">
                <div class="form-group">
                  <label for="">Búsqueda por guía House</label>
                  <input type="text" class="form-control" id="guiaHouse" name="guiaHouse" placeholder="">
                  <p class="help-block">Teclea la house.</p>
                </div>
              </div>
            </div>

            <!-- /.row -->
            <div id="response">

            </div>
            <!-- Tablas que contienten datos -->
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
  <script src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function(){
      //alert("documento listo");
      $('#guiaMasterDiv').css('display','none');
      $('#guiaHouseDiv').css('display','none');
    });
    $('#selectorGuia').on('change', function() {
      var value = $(this).val();
      if (value==1) {    // House
        $('#guiaMasterDiv').css('display','none');
        $('#guiaHouseDiv').css('display','block');
      }
      if(value==0) {         //Master
        $('#guiaMasterDiv').css('display','block');
        $('#guiaHouseDiv').css('display','none');
      }
    });
    $("#guiaMaster").keyup(function(event){
      let guiaMaster = $('#guiaMaster').val();
        if (guiaMaster.length >4) {
          $.ajax({
            url: 'busMaster.php',
            datatType : 'json',
            type: 'POST',
            data: {
                'guiaMaster' : guiaMaster,
            },

            success:function(response) {
                console.log(response);
                $('#response').html(response);
            },
            error:function(response){
              console.log('error: '+response);
              $('#response').html('');
            }
          });
        }
      });
    $("#guiaHouse").keyup(function(event){
      let guiaHouse = $('#guiaHouse').val();
        if (guiaHouse.length >3) {
          $.ajax({
            url: 'busHouse.php',
            datatType : 'json',
            type: 'POST',
            data: {
                'guiaHouse' : guiaHouse,
            },

            success:function(response) {
                console.log(response);
                $('#response').html(response);
            },
            error:function(response){
              console.log('error: '+response);
              $('#response').html('');
            }
          });
        }
      });
  </script>
</body>

</html>
