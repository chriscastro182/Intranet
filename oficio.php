<?php
require("includes/conexion.php");
$mostrar="";
if (!isset($_GET['id'])) {
  $mostrar="hidden";
}

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
        }
          ?>
      <div id="wrapper">
        <?php require("nav.php"); ?>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
                <img src="images/BannerAbandono.png" class="page-header" width="100%">
            </div>

          </div>
          <div class="row" <?php echo $mostrar; ?>>
            <div class="col-sm-12 col-md-12 col-lg-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Incrementativo</th>
                        <th>Oficio</th>
                        <th>Fecha</th>
                        <th>Fecha de <br> notificación</th>
                        <th>Observación</th>
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
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
          <!-- row -->
          <div class="row">

            <div class="col-sm-6" >
              <button class="btn btn-lg btn-info btn-block" data-toggle="collapse" data-target="#demo">¿Qué entra dentro del concepto de Mercancía Especial?</button>
                <div id="demo" class="collapse">
                  <div class="container">
                    <h4>Mercancías Especiales:</h4>
                    <ul>
                      <li>a) Las contenidas en cajas, contenedores, cartones, rejas y otros empaques y envases, cuyo volumen
                        sea de más de 5 metros cúbicos.</li>
                      <li>b) Las que deban guardarse en cajas fuertes o bajo custodia especial.</li>
                      <li>c) Las explosivas, inflamables, contaminantes, radioactivas y corrosivas</li>
                      <li>d) Las que por su naturaleza deban conservarse en refrigeración, en cuartos estériles o
                          en condiciones especiales dentro de los recintos fiscales.</li>
                      <li>e) Los animales vivos.</li>
                    </ul>
                  </div>
                </div>
            </div>
          </div>
          <!-- row -->
          <div class="row">
              <form  class="form-horizontal" method="POST" action="guardar.php">
                <!-- Aquí van los campos -->
                <table class="table table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th>Expediente</th>
                          <th>Clave única</th>
                          <th>Fecha de <br> Ingreso</th>
                          <th>GuíaMaster</th>
                          <th>GuíaHouse</th>
                          <th>Piezas</th>
                          <th>Peso</th>
                          <th>Descripcion</th>
                          <th>Fecha de <br> Salida</th>
                          <th>Estatus</th>
                          <th>Tipo de mercancía</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                             <td><input type="text" id="expediente" name="expediente" class="form-control" required/></td>
                             <td><input type="text" id="claveUnica" name="claveUnica" class="form-control" required/></td>
                             <td><input type="date" id="ingreso" name="ingreso" class="form-control" required/></td>
                             <td><input type="text" id="guiaMaster" name="guiaMaster" class="form-control" required/></td>
                             <td><input type="text" id="guiaHouse" name="guiaHouse" class="form-control" required/></td>
                             <td><input type="number" id="piezas" name="piezas"class="form-control" min="1" required/></td>
                             <td><input type="number" name="peso" class="form-control" id="peso" min="1" max="100000" required></td>
                             <td><input type="text" id="descripcion" name="descripcion" class="form-control"/></td>
                             <td><input type="date" id="salida" name="salida"  class="form-control" required/></td>
                             <td>
                               <select class="form-control" id="estatus" name="estatus">
                                  <option value="Inactivo">Inactivo</option>
                                  <option value="Activo">Activo</option>
                    						</select>
                              <td>
                                <select class="form-control" id="excepcion" name="excepcion" >
                                   <option value="Normal">Normal</option>
                                   <option value="Especial">Especial</option>
                                   <option value="Efectos Personales">Efectos Personales</option>
                                </select>
                              </td>
                          </tr>
                      </tbody>
                    </table>
          </div>
          <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
            <input type="hidden" name="idOficio" value="<?php echo $idOficio; ?>">
            <button class="btn  btn-primary btn-lg" type="submit"><i class="far fa-save "></i>  Calcular y guardar</button>
          </div>
            </form>
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
                  <?php while($rowRegistro = $resultadoRegistro->fetch_array(MYSQLI_ASSOC)) { ?>
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
                  <a href="informeExcel.php?oficio=<?php echo $idOficio; ?>" class="btn btn-success btn-block" type="button" name="excel"><i class="far fa-file-excel fa-2x"></i> Descargar informe en EXCEL</a>
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
