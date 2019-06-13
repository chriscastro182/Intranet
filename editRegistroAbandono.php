<?php

require("includes/conexion.php");

if(!isset($_SESSION)) { session_start(); }

if (isset($_SESSION['Rol_idRol'])==FALSE) { header("Location:login.php"); }

if ($_GET['id']) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM intranet.registroabandono WHERE idRegistroAbandono = '$id'";
    $resultado = $mysqli->query($sql);
    if ($resultado->num_rows) {
        $obj = $resultado->fetch_object();
        var_dump($obj);
    }
} ?>

<!DOCTYPE html>
<html>
  <?php require("head.php") ?>
  <body>
    <?php
      require("includes/conexion.php");
        if($resultado->num_rows){ ?>
            <div id="wrapper">
                <?php require("nav.php"); ?>
                <div id="page-wrapper">
                
                <!-- row -->
                <div class="row">
                    <form action="actualizarRegistroAbandono.php" method="post">
                        <input name="idOficio" type="number" value="<?php echo $obj->Oficio_idOficio; ?>" hidden>
                        <input name="id" type="number" value="<?php echo $obj->idRegistroAbandono; ?>" hidden>
                        <input name="diasTotales" type="number" value="<?php echo $obj->diasTotales; ?>" hidden>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input name="expediente" class="form-control" type="text" value="<?php echo $obj->expediente; ?>"></td>
                                        <td><input name="claveUnica" class="form-control" type="text" value="<?php echo $obj->claveUnica; ?>"></td>
                                        <td><input name="ingreso" class="form-control" type="date" value="<?php echo $obj->f_ingreso; ?>"></td>
                                        <td><input name="guiaMaster" class="form-control" type="text" value="<?php echo $obj->guiaMaster; ?>"></td>
                                        <td><input name="guiaHouse" class="form-control" type="text" value="<?php echo $obj->guiaHouse; ?>"></td>
                                        <td><input name="piezas" class="form-control" type="text" value="<?php echo $obj->piezas; ?>"></td>
                                        <td><input name="peso" class="form-control" type="text" value="<?php echo $obj->peso; ?>"></td>                     
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Fecha de Salida</th>
                                        <th>Total de días</th>
                                        <th>Estatus</th>
                                        <th>Derechos</th>
                                        <th>Tipo de mercancía</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><textarea class="form-control" rows="3" name="descripcion" type="text"><?php echo $obj->descripcion; ?></textarea></td>
                                        <td><input name="salida" class="form-control" type="date" value="<?php echo $obj->f_salida; ?>"></td>
                                        <td><?php echo $obj->diasTotales; ?></td>
                                        <td><input name="estatus" class="form-control" type="text" value="<?php echo $obj->estatus; ?>"></td>
                                        <td><?php echo $obj->derechos; ?></td>
                                        <td><input name="excepcion" class="form-control" type="text" value="<?php echo $obj->excepcion; ?>"></td>                          
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success pull-right"> <i class="fas fa-pencil-alt fa-lg"></i> Actualizar </button>
                        </div>
                    </form>
                    
                </div>
                <!-- footer -->
                <footer class="footer" style="position: fixed; left: 0; bottom: 0; width: 100%; left: 0; bottom: 0; width: 100%; text-align: center;">
                    <p>Edición de registro de abandono</p>
                    </footer>
                </div>
            </div>
           
      <?php  } else { ?>
            <div class="alert alert-danger fade in alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>¡Error en la consulta!</strong> <br> Registro: <?php echo $_GET['id']; ?> no encontrado. 
                <br>
                <a href="menuAbandono.php" class="btn btn-success">Volver al menú</a>
            </div>
      <?php  } ?>
  </body>
</html>


