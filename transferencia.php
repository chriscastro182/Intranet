<?php
require 'includes/conexion.php';

if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])!=2 || isset($_SESSION['Rol_idRol'])!=1) {
  header("Location:login.php");
}
$guias = isset($_POST['guias']) ? $_POST['guias'] : '';
$registro = isset($_POST['registro']) ? $_POST['registro'] : 0;
$registro = $_GET['id'];
if ($registro!=0) {
  $sqlTrans="SELECT * FROM transferencias where idTransferencia = $registro";
}else {
  $sqlTrans="SELECT * FROM transferencias where guiaMaster = $guias ";
}

$resulTrans = $mysqli->query($sqlTrans);
$rowTrans = $resulTrans->fetch_assoc();
 $rowTrans['idTransferencia'];

$sqlC= "SELECT * FROM condiciondecarga";
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
        <?php //require('nav.php'); ?>
        <!-- Navigation -->
        <div  id="page-wrapper">
            <div class="row ">
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
                    <img src="images/IMMlogo.png" class="page-header" width="50%">
                </div>
                <div class="col-lg-6">
                  <br>
                    <h3>Transferencia de carga entre almacenes fiscalizados</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <div class="container">
            <div class="panel panel-default col-md-11 col-sm-11">
              <div class="panel-heading">
                <h3 class="panel-title">Transferencias</h3>
              </div>
              <div class="panel-body">
                <div class="row ">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                      <h4>Fecha: <u><?php echo  $rowTrans['fecha']; ?></u></h4>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                      <h4>Hora: <u>18:01:54</u></h4>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                      <h4>Folio: <u><?php echo  $rowTrans['idTransferencia']; ?></u></h4>
                    </div>
                  </div>
                  <br>
                <div class="row">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Guía master: <u><?php echo  $rowTrans['guiaMaster']; ?></u></label>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Guía house: <u><?php echo  $rowTrans['guiaHouse']; ?></u></label>
                        </div>
                      </div>
                      <!-- <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Registro: <u></u></label>
                        </div>
                      </div> -->
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="titulo">Fecha de entrada: <u><?php echo  $rowTrans['fechaentrada']; ?></u></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="titulo">Consignatario:  <u><?php echo  $rowTrans['consignatario']; ?></u></label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="titulo">Contenido:  <u><?php echo  $rowTrans['contenido']; ?></u></label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="titulo">Piezas:  <u><?php echo  $rowTrans['piezas']; ?></u></label>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label for="titulo">Peso:  <u><?php echo  $rowTrans['peso']; ?></u></label>
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
                            <label for=""><u><?php echo  $rowTrans['setransfiere']; ?></u></label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="panel panel-default col-sm-4">
                        <div class="panel-heading">
                          <h3 class="panel-title">Condiciones en que se recibe la carga:</h3>
                        </div>
                        <div class="panel-body">

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Estado</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                while($rowsCond = $resul->fetch_array(MYSQLI_ASSOC)){
                                  $cond=$rowTrans['fk_condiciondecarga'];
                                  $condiciones=$rowsCond['idCondicion'];
                                  $tick="";
                                  if ($cond==$condiciones) {
                                    echo ' <tr>
                                      <td><i class="fa fa-check fa-2x" aria-hidden="true"></i></td>';
                                  }else {
                                    echo "<tr>
                                      <td></td>";
                                  } ?>
                                  <td><?php echo $rowsCond['condicion']; ?></td>
                                </tr>
                                <?php   } ?>
                              </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <br>
                        <br>
                        <br>
                        <?php $ave=$rowTrans['averia'];
                         if ($ave): ?>
                          <h2>Con parte de avería: <u>SI</u></h2>
                        <?php else: ?>
                          <h2>Con parte de avería: <u>NO</u></h2>
                        <?php endif; ?>
                      </div>
                      <div class="col-sm-4">
                        <img src="<?php echo $rowTrans['gafete']; ?>"  width="80%">
                      </div>
                      <br>
                      <br>
                      <h3>Observaciones: <u><?php echo  $rowTrans['observaciones']; ?></u></h3>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <label for="">Peso báscula de almacen: <u> <?php echo $rowTrans['pesobascula']; ?> Kg.</u></label>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <label for="">Ubicación en el almacén: <u> Rack <?php echo $rowTrans['ubicacion']; ?> </u></label>
                  </div>
                </div>
              <div class="panel-footer">
                <div class="row">
                  <h4>Aceptamos realizar la transferencia de esta mercancía de acuerdo al artículo 15 fracción VI
                    de la ley aduanera, misma que será resguardada hasta su despacho aduanal en nuestras instalaciones</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <label for="">Almacén que entrega</label>
                  <br>
                  <br>
                  <br>
                  <h4><?php echo $rowTrans['almacenqueentrega']; ?></h4>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <label for="">Autorizado por: </label>
                  <br>
                  <br>
                  <br>
                  <h4>Firma</h4>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                  <label for="">Almacén que entrega</label>
                  <br>
                  <br>
                  <br>
                  <h4>Nombre y firma autorizada</h4>
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
