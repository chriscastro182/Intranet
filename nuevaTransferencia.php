<?php
require 'includes/conexion.php';
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])!=2 || isset($_SESSION['Rol_idRol'])!=1) {
  header("Location:login.php");
}
$sqlC= "SELECT * FROM condiciondecarga";
$resul = $mysqli->query($sqlC);
$min= date_create()->format('Y-m-d');
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
          <div class="container">
            <div class="row page-header col-sm-8 col-md-8 col-xs-8">
                <div class="col-sm-3 col-md-3 col-xs-3">
                  <img src="images/IMMlogo.png"  width="100%">
                </div>
                <div class="col-sm-9 col-md-9 col-xs-9">
                  <h3>Nueva transferencia de carga entre almacenes</h3>
                </div>
            </div>
            <div class="row col-sm-4 col-md-4 col-xs-4">
              <div id="exito" class="alert alert-success fade in">
                <strong>Guía o guías válidas</strong> Al menos un campo ha sido llenado.
              </div>
              <div id="err" class="alert alert-danger fade in">
                <strong>¡Alerta!</strong> Debes llenar por lo menos colocar una guía.
              </div>
            </div>
            <div class="row">

              <div class="col-sm-8 col-md-8 col-xs-8">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Captura de datos</h3>
                  </div>
                  <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="return validaTres()" action="guardarTransferencia.php" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group"> <!-- Guía master -->
                        		<label class="control-label requiredField" for="master">Guía master<span class="asteriskField">*</span></label>
                        		<input class="form-control" id="master" name="master" type="text"/>
                        	</div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group"> <!-- Guía house -->
                        		<label class="control-label" for="house">Guía House</label>
                        		<input class="form-control" id="house" name="house" type="text"/>
                        	</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Guía directa -->
                        		<label class="control-label" for="directa">Guía directa: </label>
                        		<input class="form-control" id="directa" name="directa" type="text"/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Costo de transferencia -->
                        		<label class="control-label requiredField " for="costo">Costo de transferencia</label>
                        		<input class="form-control " id="costo" name="costo" type="text" required/>
                        	</div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-xs-2">
                          <div class="form-group"> <!-- Peso -->
                        		<label class="control-label" for="subject">Peso: </label>
                        		<input class="form-control" id="peso" name="peso" type="text" required/>
                        	</div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-xs-2">
                          <div class="form-group"> <!-- Piezas -->
                        		<label class="control-label" for="Piezas">Piezas: </label>
                        		<input class="form-control" id="Piezas" name="Piezas" type="number" required/>
                        	</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Fecha de entrada -->
                        		<label class="control-label" for="fEntrada">Fecha de entrada: </label>
                        		<input class="form-control" id="fEntrada" name="fEntrada" type="date" min="<?php echo $min; ?>" required/>
                        	</div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="row">
                        <div class="col-sm-6 col-md-6 col-xs-6">
                          <div class="form-group"> <!-- Condiciones -->
                        		<label class="control-label" for="condiciones">Condiciones en que se recibe la mercancía:</label>
                            <div class="col-md-11 col-sm-11 col-lg-11">
                              <select class="form-control " id="condiciones" name="condiciones">
                                <?php while($rowsCond = $resul->fetch_array(MYSQLI_ASSOC)){
                                  echo '<option value="'.$rowsCond['idCondicion'].'">'.$rowsCond['condicion'].'</option>';
                                } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-6">
                          <!-- aquí iría el registro -->
                          <!-- <div class="form-group">
                        		<label class="control-label " for="Registro">Registro:</label>
                            <input class="form-control" id="Registro" placeholder="0001" name="Registro" type="text" required/>
                        	</div> -->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-md-6 col-xs-6">
                          <div class="form-group"> <!-- Contenido -->
                        		<label class="col-sm-5 col-md-5 col-xs-5 control-label " for="Contenido">Contenido:</label>
                            <input class="form-control" id="Contenido" placeholder="Por ejemplo: Consol" name="Contenido" type="text" required/>
                        	</div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-6">
                          <div class="form-group"> <!-- Consignatario -->
                        		<label class="col-sm-4 col-md-4 col-xs-4 control-label " for="Consignatario">Consignatario: </label>
                            <input class="form-control" id="Consignatario" placeholder="Nombre del consignatario" name="Consignatario" type="text" required/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group"> <!-- La mercancía se transfiere a -->
                            <label class=" control-label" for="transfiere">La mercancía se transfiere a solicitud escrita de: </label>
                            <input class="form-control" id="transfiere" placeholder="Por ejemplo: SCHENKER" name="transfiere" type="text" required/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group"> <!-- Responsable del almacén que entrega: -->
                            <label class=" control-label" for="responsable">Responsable del almacén que entrega: </label>
                            <input class="form-control" id="responsable" placeholder="Por ejemplo: Juan Pérez" name="responsable" type="text" required/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="correo">Correo electrónico de quien solicita transferencia: </label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Escriba el correo electrónico" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="archivo" class="control-label">Anexar foto de gafete:</label>
                            <div class="col-sm-10">
                              <input type="file" class=" form-control" id="archivo" name="archivo" accept="application/pdf,image/*" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- pesoBascula -->
                        		<label class="control-label " for="pesoBascula">Peso báscula almacén:</label>
                            <input class="form-control" id="pesoBascula" placeholder="0.00 KG" name="pesoBascula" type="text" required/>
                          </div>
                        </div>
                        <div class="col-sm-5 col-md-5 col-xs-5">
                          <div class="form-group"> <!-- Ubicación -->
                        		<label class="col-sm-4 col-md-4 col-xs-4 control-label " for="Ubicacion">Ubicación: </label>
                            <input class="form-control" id="Ubicacion" placeholder="Posición en el almacén (RACK)" name="Ubicacion" type="text" required/>
                        	</div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label " for="averia"> Avería: </label>
                            <label class="radio-inline">
                                <input type="radio" name="averia" value="1">Si
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="averia" value="0">No
                              </label>
                          </div>
                        </div>
                      </div>
                    	<div class="form-group"> <!-- Observaciones -->
                    		<label class="control-label " for="Observaciones">Observaciones</label>
                    		<textarea class="form-control" cols="40" id="Observaciones" name="Observaciones" rows="3"></textarea>
                    	</div>

                    	<div class="form-group">
                        <input class="btn btn-primary " type="submit" name="submit" value="Solicitar transferencia">
                    	</div>
                  </form>

                  </div>
                  <div class="panel-footer">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
  <script type="text/javascript">
  setTimeout("ocultar()", 5);
    function ocultar() {
      var exito = document.getElementById("exito");
      var err = document.getElementById("err");
      exito.style.visibility = 'hidden';
      err.style.visibility = 'hidden';
    }
    function mostrarExito() {
      exito.style.visibility = 'visible';
    }
    function mostrarErr() {
      err.style.visibility = 'visible';
    }
    function validaTres() {
      ocultar();
      var master = document.getElementById("master").value;
      var house = document.getElementById("house").value;
      var directa = document.getElementById("directa").value;

      if (master!="" || house!="" || directa!="") {
        mostrarExito();
      }else {
        mostrarErr();
        alert("Debes llenar por lo menos un campo de guía");
        return false;
      }

    }
  </script>
</body>
</html>
