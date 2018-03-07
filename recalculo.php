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
            while ($fila = $resultadoRegistro->fetch_array()) {
              $id=$fila['idRegistroAbandono'];
              $fUno=strtotime($fila['f_ingreso']);
              $fDos=strtotime($fila['f_salida']);
              $diasTotales=ceil(abs($fDos - $fUno) / 86400);  //función que calcula la diferencia en días entre
              $peso=$fila['peso'];
              $excepcion=$fila['excepcion'];
                $pesoC=0;              // Fecha de ingreso y Fecha de salida, asignándola a $diasTotales
                $pesoC=$peso/500;
                settype($pesoC, "integer"); // aquí está el multiplicador de la tarifa (por cada quinientos kilos)

                if ($pesoC<1) {
                  $pesoC=1; //validación para que se multiplique por uno en dado caso de que sea menor a 1
                }

              //  $diasTemp=$diasTotales-60; // La resta de los 60 días que causan abandono
                $derechos3=0;
                $derechos2=0;
                $derechos1=0;
                $cont1=0;
                $cont2=0;
                $cont3=0;
                for ($i=1; $i <=$diasTemp; $i++) {  //$i es igual a números naturales

                  if ($i <=15) { // primera condición (cláusula a)
                    $derechos1+=11.46*$pesoC;
                  }

                  if ($i>15 && $i <=45) { // condición de (cláusula b)
                    $derechos2+=22.34*$pesoC;
                  }

                  if ($i>45) { //Condición última de días
                    $derechos3+=36.20*$pesoC;
                  }

                }

                $derechos=$derechos1+$derechos2+$derechos3; // Cálculo final de todas las variables

                if($excepcion=="Efectos Personales"){
                  $pesoC=$peso/100;
                  settype($pesoC, "integer");
                  if ($pesoC<1) {
                    $pesoC=1;
                  }
                  $tarifaEf=18.60*$peso; // aquí está el multiplicador de la tarifa (por cada cien kilos)
                  $derechos=$tarifaEf*$diasTotales;
                }
                if($excepcion=="Especial"){
                  $derechos=$derechos*2; // $tarifaEs representa al doble aplicado en mercancía Especial
                }
              $derechos=$derechos1+$derechos2+$derechos3;
              $sqlUp = "UPDATE registroabandono SET derechos=$derechos WHERE idRegistroAbandono = $id";
              $resultadoUp = $mysqli->query($sqlUp);

              if ($resultadoUp) { ?>
                <div class="alert alert-success fade in alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Registros actualizados!</strong> .
                </div>
        <?php      } else {
          echo '<div class="alert alert-danger fade in alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Valio verga la pata del Mameitor!</strong> No se pudieron actualizar a la nueva tarifa.
                </div>';
        }
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
                        <th>Tipo de mercancía</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php while($rowRegistro = $resultadoRegistro->fetch_array(MYSQLI_ASSOC)) {   ?>
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
