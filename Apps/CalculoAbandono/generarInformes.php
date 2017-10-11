<!DOCTYPE html>
<html>
  <?php require("head.php") ?>
  <body>
    <?php
      require("include/conexion.php");
        require("nav.php");
        $where = "";

        if(!empty($_POST)){
          $valor = $_POST['campo'];
          if(!empty($valor)){
            $where = "where idRegistroAbandono = $valor;";
          }
        }
        $sql = "SELECT * FROM registroabandono $where";

        $resultado = $mysqli->query($sql);
          ?>
        <div class="container-fluid">
         <div class="row">
           <img src="image/ban.jpg" class="img-responsive">
          </div>
       </div>
      <div class="row">
        <div class="col-sm-6">
            <div class="container" >
              <h1>Generar informes</h1>

            </div>
        </div>
        <div class="col-sm-6" style="text-align:right">
          <div class="well well-lg" >
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
              <b>Consecutivo: </b><input type="number" id="campo" name="campo" />
              <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
            </form>
          </div>
        </div>
      </div>

    <div class="container">

          <!-- Aquí van los campos de la base de datos -->
          <div class="container">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Fecha de Ingreso</th>
                  <th>Guía Master</th>
                  <th>Guía House</th>
                  <th>Piezas</th>
                  <th>Peso</th>
                  <th>Descripcion</th>
                  <th>Oficio de Aduana</th>
                  <th>Fecha de Salida</th>
                  <th>Total de días</th>
                  <th>Estatus</th>
                  <th>Derechos</th>
                  <th>Tipo de mercancía</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                  <tr>
                     <td><?php echo $row['f_ingreso']; ?></td>
                     <td><?php echo $row['guiaMaster']; ?></td>
                     <td><?php echo $row['guiaHouse']; ?></td>
                     <td><?php echo $row['piezas']; ?></td>
                     <td><?php echo $row['peso']; ?></td>
                     <td><?php echo $row['descripcion']; ?></td>
                     <td><?php echo $row['oficioAduana']; ?></td>
                     <td><?php echo $row['f_salida']; ?></td>
                     <td><?php echo $row['diasTotales']; ?></td>
                     <td><?php echo $row['estatus']; ?></td>
                     <td><?php echo $row['derechos']; ?></td>
                     <td><?php echo $row['excepcion']; ?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
            <a href="informePdf.php" class="btn btn-lg btn-danger" type="button" name="pdfbtn">Generar informe en PDF</a>
            <a href="informeExcel.php" class="btn btn-lg btn-success" type="button" name="excel">Descargar informe en EXCEL</a>
          </div>
    </div>
  </body>
</html>
