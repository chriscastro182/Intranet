<?php
require 'includes/conexion.php';
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])!=2 || isset($_SESSION['Rol_idRol'])!=1) {
  header("Location:login.php");
}
$sqlC= "SELECT * FROM   condiciondecarga";
$resul = $mysqli->query($sqlC);

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
            <div class="row">
              <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
                <img src="images/IMMlogo.png" class="page-header" width="50%">
              </div>
              <div class="col-lg-5 col-sm-5 col-md-5 col-xs-5">
                <br>
                <br>
                <h3>Nueva transferencia de carga entre almacenes:</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7 col-md-7 col-xs-7">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Captura de datos</h3>
                  </div>
                  <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" action="guardarTransferencia.php" method="post" autocomplete="off">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group"> <!-- Guía master -->
                        		<label class="control-label requiredField" for="master">Gía master<span class="asteriskField">*</span></label>
                        		<input class="form-control" id="master" name="master" type="number"/>
                        	</div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group"> <!-- Guía house -->
                        		<label class="control-label" for="house">Guía House</label>
                        		<input class="form-control" id="house" name="house" type="number"/>
                        	</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Guía directa -->
                        		<label class="control-label" for="directa">Guía directa: </label>
                        		<input class="form-control" id="directa" name="directa" type="number"/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Costo de transferencia -->
                        		<label class="control-label requiredField " for="costo">Costo de transferencia</label>
                        		<input class="form-control " id="costo" name="costo" type="text"/>
                        	</div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-xs-2">
                          <div class="form-group"> <!-- Peso -->
                        		<label class="control-label" for="subject">Peso: </label>
                        		<input class="form-control" id="peso" name="peso" type="number"/>
                        	</div>
                        </div>
                        <div class="col-sm-2 col-md-2 col-xs-2">
                          <div class="form-group"> <!-- Piezas -->
                        		<label class="control-label" for="Piezas">Piezas: </label>
                        		<input class="form-control" id="Piezas" name="Piezas" type="number"/>
                        	</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Piezas -->
                        		<label class="control-label" for="fEntrada">Fecha de entrada: </label>
                        		<input class="form-control" id="fEntrada" name="fEntrada" type="date"/>
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
                          <div class="form-group"> <!-- Registro -->
                        		<label class="control-label " for="Registro">Registro:</label>
                            <input class="form-control" id="Registro" placeholder="0001" name="Registro" type="text"/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5 col-md-5 col-xs-5">
                          <div class="form-group"> <!-- Contenido -->
                        		<label class="col-sm-5 col-md-5 col-xs-5 control-label " for="Contenido">Contenido:</label>
                            <input class="form-control" id="Contenido" placeholder="Por ejemplo: Consol" name="Contenido" type="text"/>
                        	</div>
                        </div>
                        <div class="col-sm-7 col-md-7 col-xs-7">
                          <div class="form-group"> <!-- Consignatario -->
                        		<label class="col-sm-4 col-md-4 col-xs-4 control-label " for="Consignatario">Consignatario: </label>
                            <input class="form-control" id="Consignatario" placeholder="Nombre del consignatario" name="Consignatario" type="text"/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-7">
                          <div class="form-group"> <!-- La mercancía se transfiere a -->
                            <label class=" control-label" for="transfiere">La mercancía se transfiere a solicitud escrita de: </label>
                            <!-- <div class="col-sm-8 col-md-8 col-xs-8">

                            </div> -->
                            <input class="form-control" id="transfiere" placeholder="Por ejemplo: SCHENKER" name="transfiere" type="text"/>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group"> <!-- Responsable del almacén que entrega: -->
                            <label class=" control-label" for="responsable">Responsable del almacén que entrega: </label>
                            <!-- <div class="col-sm-8 col-md-8 col-xs-8">
                            </div> -->
                            <input class="form-control" id="responsable" placeholder="Por ejemplo: Juan Pérez" name="responsable" type="text"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="correo">Correo electrónico de solicitud de transferencia: </label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Escriba el correo electrónico">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="archivo" class="control-label">Anexar foto de gafete:</label>
                            <div class="col-sm-10">
                              <input type="file" class=" form-control" id="archivo" name="archivo" accept="application/pdf,image/*">
                            </div>
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
                      <div class="row">
                        <div class="col-sm-5 col-md-5 col-xs-5">
                          <div class="form-group"> <!-- pesoBascula -->
                        		<label class="control-label " for="pesoBascula">Peso báscula almacén:</label>
                            <input class="form-control" id="pesoBascula" placeholder="0.00 KG" name="pesoBascula" type="text"/>
                          </div>
                        </div>
                        <div class="col-sm-7 col-md-7 col-xs-7">
                          <div class="form-group"> <!-- Ubicación -->
                        		<label class="col-sm-4 col-md-4 col-xs-4 control-label " for="Ubicacion">Ubicación: </label>
                            <input class="form-control" id="Ubicacion" placeholder="Posición en el almacén (RACK)" name="Ubicacion" type="text"/>
                        	</div>
                        </div>
                      </div>
                    	<div class="form-group"> <!-- Observaciones -->
                    		<label class="control-label " for="Observaciones">Observaciones</label>
                    		<textarea class="form-control" cols="40" id="Observaciones" name="Observaciones" rows="2"></textarea>
                    	</div>

                    	<div class="form-group">
                    		<button class="btn btn-primary " name="submit" type="submit">Solicitar transferencia</button>
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
</body>
</html>
