<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';

$resul=FALSE;
$resultado=FALSE;
$regisVD= FALSE;
$regis= FALSE;
$hideCierre= "";

if (isset($_GET['numHouse'])) {
  $RegistroVD_idRegistroVD=$_GET['idDescon'];
  $indiceGuiaH=$_GET['numHouse'];
  $idRVD=$_GET['idRVD'];
  // echo '$RegistroVD_idRegistroVD: '.$RegistroVD_idRegistroVD;
  // echo 'indiceGuiaH: '.$indiceGuiaH;
  // echo 'idRVD'.$idRVD;
  }else {
    $guiaHouse  = isset($_POST['guiaHouse']) ? $_POST['guiaHouse'] : '';
    $indiceGuiaH = isset($_POST['numHouse']) ? $_POST['numHouse'] : 0;
    $idRVD = isset($_POST['idVuelo']) ? $_POST['idVuelo'] : '';
    $RegistroVD_idRegistroVD = isset($_POST['idDescon']) ? $_POST['idDescon'] : '';
    $idDesconsol=$numDesconsol=0;
    $indexDesconsol= "SELECT * FROM registrodescon";
    $resul = $mysqli->query($indexDesconsol);
    while($row = $resul->fetch_assoc()){
      $idDesconsol++;
    }
    $registros= "SELECT * FROM registrodescon WHERE RegistroVD_idRegistroVD = '$RegistroVD_idRegistroVD'";
    $regis = $mysqli->query($registros);
    while($rowNumDes= $regis->fetch_assoc()){
      $numDesconsol++;
    }
  $sql = "INSERT INTO registrodescon(idRegistroDescon, guiaHouse, numDesconsol, RegistroVD_idRegistroVD)
                  VALUES ('$idDesconsol', '$guiaHouse', '$numDesconsol', '$RegistroVD_idRegistroVD')";
  $resultado = $mysqli->query($sql);
  }
  $registrosVD= "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$idRVD'";
  $regisVD = $mysqli->query($registrosVD);
  $rowVD = $regisVD->fetch_array(MYSQLI_ASSOC);

  $registrosCon= "SELECT * FROM registrovd WHERE idRegistroVD = '$RegistroVD_idRegistroVD'";
  $regisCon = $mysqli->query($registrosCon);
  $rowCon = $regisCon->fetch_array(MYSQLI_ASSOC);
  $Master=$rowCon['guiaMaster'];

  $registros= "SELECT * FROM registrodescon WHERE RegistroVD_idRegistroVD = '$RegistroVD_idRegistroVD'";
  //echo $registros;
  $regis = $mysqli->query($registros);
  $indexTabla= $indiceGuiaH;
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

                <div class="well well-md">
                  <div class="row">
                  <div class="col-lg-6">
                    <h3>Vuelo <?php echo $vuelo; ?> abierto</h3>
                    <h4>Registro número: <?php echo $registro; ?></h4>
                    <h2>Guía <?php echo $Master; ?> desconsolidada</h2>
                  </div>
                  <div class="col-lg-6">
                    <?php $mysqltime = date ("d-m-Y", strtotime($ingreso)); ?>
                    <h3>Fecha: <?php echo $mysqltime; ?></h3>
                  </div>
                </div>
              </div>
          <?php  } ?>
            <!-- /.row -->
            <div class="row">
              <div class="col-sm-8">
                <form  class="form-horizontal" method="POST" action="DigitalizacionDesconsol.php">
                    <!-- Aquí van los campos -->
                      <table class="table table-bordered table-condensed" style="text-align: center">
                        <thead>
                          <tr>
                            <th># de Guías restantes por capturar</th>
                            <th>Guía Master</th>
                            <th>Guía House</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php if ($regis) {
                          $hideCierre='hidden="hidden"';
                          while ($rowRD = $regis->fetch_array(MYSQLI_ASSOC))  {
                            ?>
                            <tr>
                              <td><?php echo $indexTabla; ?></td>
                              <td><?php echo $Master; ?></td>
                              <td><?php echo $rowRD['guiaHouse']; ?></td>
                              <?php $indexTabla--; } ?>
                              <tr>
                                <td><?php echo $indexTabla; ?></td>
                                <td><?php echo $Master; ?></td>
                                <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="" required/></td>
                              </tr>
                            </tr>
                          <?php if ($indexTabla==0) { $hideCierre =""; ?>
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                  <?php  } ?>
                          <?php  } else{ $hideCierre='hidden="hidden"'; ?>
                                      <tr>
                                        <td><?php echo $indexTabla; ?></td>
                                        <td><?php echo $Master; ?></td>
                                        <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" value="" required/></td>
                                      </tr>
                                  <?php  }?>
                        </tbody>
                      </table>
                  </div>
                  <div class="col-sm-4">
                    <br>
                    <input type="hidden" id="numHouse" name="numHouse" class="form-control" value="<?php echo $indiceGuiaH; ?>">
                    <input type="hidden" id="idVuelo" name="idVuelo" value="<?php echo $idRVD; ?>">
                    <input type="hidden" id="idDescon" name="idDescon" value="<?php echo $RegistroVD_idRegistroVD; ?>">
                    <div class="row" >
                      <button class="btn btn-lg btn-success btn-block " id="asociar" type="submit"><i class="fa fa-file-text fa-fw"></i>Asociar Guía Desconsolidada</button>
                    </div>
                  </div>
              </form>
            </div>
              <?php $URLcierre= 'Digitalizacion.php?idRVD='.$idRVD; ?>
              <div class="col-sm-4">
                <a href="<?php echo $URLcierre; ?>" <?php echo $hideCierre; ?>>
                  <button class="btn btn-lg btn-primary btn-block" type="button" name="cierreDesconsolidacion">Cerrar guía desconsolidada</button>
                </a>
              </div>
            <!-- Tablas que contienten datos -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>
