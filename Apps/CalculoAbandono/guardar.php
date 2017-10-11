<?php
require("include/conexion.php");


$ingreso="";
$salida="";

$ingreso = isset($_POST['ingreso']) ? $_POST['ingreso'] : '';
$guiaMaster = $_POST['guiaMaster'];
$guiaHouse = $_POST['guiaHouse'];
$piezas = $_POST['piezas'];
$peso = isset($_POST['peso']) ? $_POST['peso'] : '';
$descripcion = $_POST['descripcion'];
$oficioAduana = $_POST['oficioAduana'];
$salida = isset($_POST['salida']) ? $_POST['salida'] : '';
$diasTotales = isset($_POST['diasTotales']) ? $_POST['diasTotales'] : '';
$estatus = $_POST['estatus'];
$derechos = 0;
$excepcion = isset($_POST['excepcion']) ? $_POST['excepcion'] : '';

function diffDias(){
  $fUno=strtotime($ingreso=isset($_POST['ingreso']) ? $_POST['ingreso'] : '');
  $fDos=strtotime($salida=isset($_POST['salida']) ? $_POST['salida'] : '');
  return ceil(abs($fDos - $fUno) / 86400);
}
  $diasTotales=diffDias(); //función vacía que calcula la diferencia en días entre
  $pesoC=0;              // Fecha de ingreso y Fecha de salida, asignándola a $diasTotales
  if($excepcion=="Efectos Personales"){
    $pesoC=$peso/100;
    $tarifaEf=18.60*$pesoC;
    $derechos=$tarifaEf*$diasTotales;
  }else {
    $pesoC=$peso/500;
    // Función vacía que le da valor a la variable $tarifa
    $tarifa=calcTarifa();
    $tarifa=$pesoC*$tarifa;
    if($excepcion=="Especial"){
      $tarifaEs=$tarifa*2; // $tarifaEs representa al doble aplicado en mercancía Especial
                          //NO CONFUNDIR con $tarifaef que aplica para mercancía de Efectos Personales.
      $derechos=$tarifaEs*$diasTotales;
    } else{
        $derechos=$tarifa*$diasTotales;
    }
  }
function calcTarifa(){
  $diasTotales=diffDias();
  $tarifa=0;
  if ($diasTotales<=15) {
    return 11.46;
  }
  elseif ($diasTotales>15 && $diasTotales <=45) {
    return 22.34;
  }
  elseif ($diasTotales>45) {
    return 36.20;
  }
}
$sql = "INSERT INTO registroabandono (f_ingreso, guiaMaster, guiaHouse, piezas, peso, descripcion, oficioAduana, f_salida, diasTotales, estatus, derechos, excepcion)
                        VALUES ('$ingreso','$guiaMaster','$guiaHouse','$piezas','$peso','$descripcion','$oficioAduana','$salida','$diasTotales','$estatus','$derechos','$excepcion')";

$resultado = $mysqli->query($sql);
?>

<html lang="es">
<?php require("head.php") ?>
<body>
  <div class="container">
    <div class="row">
      <div class="row" style="text-align:center">

        <?php if($resultado) {
          echo '<script type="text/javascript">MensajeExito()</script>';
          ?>
          <div id="snackbar">Registro Guardado Exitosamente</div>
          <?php
          header( 'Location: index.php' ); } else { ?>
          <h3>ERROR AL GUARDAR</h3>
        <?php } ?>

        <a href="index.php" class="btn btn-primary">Regresar</a>

      </div>
    </div>
  </div>



  <script>
  function MensajeExito() {
      var x = document.getElementById("snackbar")
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }
  </script>
</body>
</html>
