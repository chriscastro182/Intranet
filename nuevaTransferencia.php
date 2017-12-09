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
              <div class="col-lg-3">
                <img src="images/IMMlogo.png" class="page-header" width="100%">
              </div>
              <div class="col-lg-9">
                <br>
                <br>
                <h1>Nueva transferencia de carga entre almacenes:</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7 col-md-7 col-xs-7">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Captura de datos</h3>
                  </div>
                  <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" action="#" method="post" autocomplete="off">
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
                        <div class="col-sm-4">
                          <div class="form-group"> <!-- Guía house -->
                        		<label class="control-label requiredField " for="costo">Costo de transferencia<span class="asteriskField">*</span></label>
                        		<input class="form-control " id="costo" name="house" type="number"/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4 col-md-4 col-xs-4">
                          <div class="form-group"> <!-- Peso -->
                        		<label class="control-label" for="subject">Peso: </label>
                        		<input class="form-control" id="peso" name="peso" type="number"/>
                        	</div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-xs-4">
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
                        		<label class="control-label " for="message">Condiciones en que se recibe la mercancía:</label>
                            <div class="col-md-10 col-sm-10 col-lg-10">
                              <select class="form-control col-sm-6 col-md-6 col-xs-6" id="sel1">
                                <?php while($rowsCond = $resul->fetch_array(MYSQLI_ASSOC)){
                                  echo '<option>'.$rowsCond['condicion'].'</option>';
                                } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-6">
                          <div class="form-group">
                            <label for="archivo" class="control-label">Anexar foto de gafete:</label>
                            <div class="col-sm-10">
                              <input type="file" class=" form-control" id="archivo" name="archivo" accept="application/pdf,image/*">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5 col-md-5 col-xs-5">
                          <div class="form-group"> <!-- Contenido -->
                        		<label class="col-sm-5 col-md-5 col-xs-5 control-label " for="Contenido">Contenido:</label>
                            <!-- <div class="col-sm-7 col-md-7 col-xs-7">

                            </div> -->
                            <input class="form-control" id="Contenido" placeholder="Por ejemplo: Consol" name="Contenido" type="text"/>
                        	</div>
                        </div>
                        <div class="col-sm-7 col-md-7 col-xs-7">
                          <div class="form-group"> <!-- Consignatario -->
                        		<label class="col-sm-4 col-md-4 col-xs-4 control-label " for="Consignatario">Consignatario: </label>
                            <!-- <div class="col-sm-8 col-md-8 col-xs-8">

                            </div> -->
                            <input class="form-control" id="Consignatario" placeholder="Nombre del consignatario" name="Consignatario" type="text"/>
                        	</div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-10">
                          <div class="form-group"> <!-- La mercancía se transfiere a -->
                            <label class=" control-label" for="transfiere">La mercancía se transfiere a solicitud escrita de: </label>
                            <!-- <div class="col-sm-8 col-md-8 col-xs-8">

                            </div> -->
                            <input class="form-control" id="transfiere" placeholder="Por ejemplo: SCHENKER" name="transfiere" type="text"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="correo">Correo electrónico: </label>
                            <input type="email" class="form-control" id="" placeholder="Escriba el correo electrónico">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="col-md-6 control-label " for="transfiere"> Avería: </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Si
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="optradio">No
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
                        		<label class="col-sm-4 col-md-4 col-xs-4 control-label " for="Ubicación">Ubicación: </label>
                            <input class="form-control" id="Ubicación" placeholder="Posición en el almacén (RACK)" name="Ubicación" type="text"/>
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
