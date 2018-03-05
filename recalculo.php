<?php
require("includes/conexion.php");

$valor = $_GET['id'];
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])==FALSE) {
  header("Location:login.php");
}?>
<!DOCTYPE html>
<html>
  <?php require("head.php") ?>
  <body>
    <?php
      require("includes/conexion.php");
        if(!empty($valor)){
            $sql = "SELECT * FROM Oficio WHERE idOficio = '$valor'";
            $resultado = $mysqli->query($sql);

            $sqlRegistro = "SELECT * FROM registroabandono WHERE Oficio_idOficio = '$valor'";
            $resultadoRegistro = $mysqli->query($sqlRegistro);

            $row_cnt = mysqli_num_rows($resultadoRegistro);
            if ($row_cnt) {
              $mostrar="";
            }else {
              $mostrar="hidden";
            }
        }
          ?>
      <div id="wrapper">
        <?php require("nav.php"); ?>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Incrementativo</th>
                        <th>Oficio</th>
                        <th>Fecha</th>
                        <th>Fecha de <br> notificación</th>
                        <th>Observación</th>
                        <th>Destino</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                        <tr> <?php $idOficio=$row['idOficio']; ?>
                        <td><?php echo $idOficio ?></td>
                          <td><?php echo $row['oficio']; ?></td>
                          <td><?php echo $row['fechaoficio']; ?></td>
                          <td><?php echo $row['fechaNotificacion']; ?></td>
                          <td><?php echo $row['observacion']; ?></td>
                          <td><?php echo $row['destino']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
          <!-- row -->
          <div class="row" <?php echo $mostrar; ?>>
            <div class="col-sm-12 col-md-12 col-lg-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Expediente</th>
                        <th>Clave única</th>
                        <th>Fecha de Ingreso</th>
                        <th>Guía Master</th>
                        <th>Guía <br>House</th>
                        <th>Piezas</th>
                        <th>Peso</th>
                        <th>Descripcion</th>
                        <th>Fecha de Salida</th>
                        <th>Total de días</th>
                        <th>Estatus</th>
                        <th>Derechos</th>
                        <th>Derechos correcto</th>
                        <th>Tipo de mercancía</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php while($rowRegistro = $resultadoRegistro->fetch_array(MYSQLI_ASSOC)) {
                      $fUno=strtotime($rowRegistro['f_ingreso']);
                      $fDos=strtotime($rowRegistro['f_salida']);
                      $diasTotales=ceil(abs($fDos - $fUno) / 86400);  //función que calcula la diferencia en días entre

                      $derechos3=0;
                      $derechos2=0;
                      $derechos1=0;
                      $diasTemp=$diasTotales-60;
                      if ($diasTemp>45) {
                        $diasTemp-=45;
                        $tarifa= 36.20;
                        $derechos3=$tarifa*$diasTemp;
                      }
                      if ($diasTemp>15 && $diasTemp <=45) {
                        $diasTemp-=30;
                        $tarifa= 22.34;
                        $derechos2=$tarifa*$diasTemp;
                      }
                      if ($diasTemp>0 && $diasTemp <=15) {
                        $diasTemp-=15;
                        $tarifa= 11.46;
                        $derechos1=$tarifa*$diasTemp;
                      }

                    ?>
                        <tr>
                          <td><?php echo $rowRegistro['expediente']; ?></td>
                          <td><?php echo $rowRegistro['claveUnica']; ?></td>
                          <td><?php echo $rowRegistro['f_ingreso']; ?></td>
                          <td><?php echo $rowRegistro['guiaMaster']; ?></td>
                          <td><?php echo $rowRegistro['guiaHouse']; ?></td>
                          <td><?php echo $rowRegistro['piezas']; ?></td>
                          <td><?php echo $rowRegistro['peso']; ?></td>
                          <td><?php echo $rowRegistro['descripcion']; ?></td>
                          <td><?php echo $rowRegistro['f_salida']; ?></td>
                          <td><?php echo $rowRegistro['diasTotales']; ?></td>
                          <td><?php echo $rowRegistro['estatus']; ?></td>
                          <td><?php echo $rowRegistro['derechos']; ?></td>
                          <td style="background-color:#FFCC00;"><?php echo $derechos1+$derechos2+$derechos3; ?></td>
                          <td><?php echo $rowRegistro['excepcion']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>

              </div>
          </div>
          <!-- footer -->
          <footer>
              <p>Cálculo de abandono</p>
            </footer>
        </div>
      </div>
  </body>
</html>
