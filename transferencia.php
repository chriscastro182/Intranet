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
            <div class="row">
                <div class="col-lg-3">
                    <img src="images/IMMlogo.png" class="page-header" width="100%">
                </div>
                <div class="col-lg-6">
                  <br>
                    <h2>Transferencia de carga entre almacenes fiscalizados</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <div class="container">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Transferencias</h3>
              </div>
              <div class="panel-body">
                <div class="row ">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                      <h4>Fecha: <u>08-12-2017</u></h4>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                      <h4>Hora: <u>18:01:54</u></h4>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                      <h4>Folio: <u>0001</u></h4>
                    </div>
                  </div>
                  <br>
                <div class="row">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Guía master: <u>89456132</u></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Guía house: <u>746523189</u></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Registro: <u>0001</u></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Fecha de entrada: <u>08-12-2017</u></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="titulo">Consignatario:  <u>SCHENKER</u></label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="titulo">Contenido:  <u>CONSOL</u></label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="titulo">Piezas:  <u>54</u></label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="titulo">Peso:  <u>1432.40 KG</u></label>
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <div class="col-sm-6">
                            <label for="transfiere">La mercancía se transfiere a solicitud escrita de:  </label>
                          </div>
                          <div class="col-sm-6">
                            <label for=""><u>SCHENKER.40 KG</u></label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="">Condiciones en que se recibe la carga:</label>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Estado</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            while($rowsCond = $resul->fetch_array(MYSQLI_ASSOC)){ ?>
                            <tr>
                              <td><h3> </h3></td>
                              <td><?php echo $rowsCond['condicion']; ?></td>
                            </tr>
                            <?php   } ?>
                          </tbody>
                        </table>
                        <br>
                        <br>
                        <h3>Observaciones: <u>Ninguna</u></h3>
                      </div>
                      <div class="col-sm-4">
                        <br>
                        <br>
                        <br>
                        <h2>Con parte de avería: <u>NO</u></h2>
                      </div>
                      <div class="col-sm-4">
                        <img src="images/gafeteaduana.jpeg" class="page-header" width="80%">
                      </div>


                    </div>
                  </div>
                <div class="row">
              </div>
              <div class="panel-footer">

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
