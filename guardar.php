<?php
require("includes/conexion.php");

$ingreso="";
$salida="";

$expediente = $_POST['expediente'];
$claveUnica = $_POST['claveUnica'];
$ingreso = isset($_POST['ingreso']) ? $_POST['ingreso'] : '';
$guiaMaster = $_POST['guiaMaster'];
$guiaHouse = $_POST['guiaHouse'];
$piezas = $_POST['piezas'];
$peso = isset($_POST['peso']) ? $_POST['peso'] : '';
$descripcion = $_POST['descripcion'];
$salida = isset($_POST['salida']) ? $_POST['salida'] : '';
$diasTotales = isset($_POST['diasTotales']) ? $_POST['diasTotales'] : '';
$estatus = $_POST['estatus'];
$derechos = 0;
$excepcion = isset($_POST['excepcion']) ? $_POST['excepcion'] : '';
$idOficio = $_POST['idOficio'];
function diffDias(){
  $fUno=strtotime($ingreso=isset($_POST['ingreso']) ? $_POST['ingreso'] : '');
  $fDos=strtotime($salida=isset($_POST['salida']) ? $_POST['salida'] : '');
  return ceil(abs($fDos - $fUno) / 86400);
}
  $diasTotales=diffDias(); //función que calcula la diferencia en días entre
  $pesoC=0;              // Fecha de ingreso y Fecha de salida, asignándola a $diasTotales

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
  $derechos=$derechos1+$derechos2+$derechos3;
  if($excepcion=="Efectos Personales"){
    $pesoC=$peso/100;
    $tarifaEf=18.60*$pesoC;
    $derechos=$tarifaEf*$diasTotales;
  }else {
    $pesoC=$peso/500;

    if($excepcion=="Especial"){
      $tarifaEs=$tarifa*2; // $tarifaEs representa al doble aplicado en mercancía Especial
                          //NO CONFUNDIR con $tarifaef que aplica para mercancía de Efectos Personales.
      $derechos=$tarifaEs*$diasTotales;
    } else{
        $derechos=$tarifa*$diasTotales;
    }
  }
$sql = "INSERT INTO registroabandono (expediente, claveUnica, f_ingreso, guiaMaster, guiaHouse, piezas, peso, descripcion,f_salida, diasTotales, estatus, derechos, excepcion, Oficio_idOficio)
                        VALUES ('$expediente', '$claveUnica','$ingreso','$guiaMaster','$guiaHouse','$piezas','$peso','$descripcion','$salida','$diasTotales','$estatus','$derechos','$excepcion','$idOficio')";

$resultado = $mysqli->query($sql);

?>

<html lang="es">
<?php require("head.php") ?>
<body>
  <div class="container">
    <div class="row">
      <div class="row" style="text-align:center">
        <?php if($resultado) {?>
          <script type="text/javascript">MensajeExito()</script>
          <div id="snackbar">Registro Guardado Exitosamente</div>
          <?php header( 'Location: oficio.php?id='.$idOficio.'' );
        } else { ?>
            <h3>ERROR AL GUARDAR</h3>
          <?php } ?>

        <a href="abandono.php" class="btn btn-primary">Regresar</a>

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
