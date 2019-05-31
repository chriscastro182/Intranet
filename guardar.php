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
  $pesoC=$peso/500;
  settype($pesoC, "integer"); // aquí está el multiplicador de la tarifa (por cada quinientos kilos)

  if ($pesoC<1) {
    $pesoC=1; //validación para que se multiplique por uno en dado caso de que sea menor a 1
  }

  $diasTemp=$diasTotales; // La resta de los 60 días que causan abandono restar 60 si es local
  $derechos3=0;
  $derechos2=0;
  $derechos1=0;
  $cont1=0;
  $cont2=0;
  $cont3=0;
  for ($i=1; $i <=$diasTemp; $i++) {  //$i es igual a números naturales

    if ($i <=15) { // primera condición (cláusula a)
      $derechos1+=12.80*$pesoC;
      $cont1++;
      echo $i." Inciso a)".$derechos1." d: ".$cont1." <BR>";
    }

    if ($i>15 && $i <=45) { // condición de (cláusula b)
      $derechos2+=24.94*$pesoC;
      $cont2++;
      echo $i." Inciso b)".$derechos2." d: ".$cont2." <BR>";
    }

    if ($i>45) { //Condición última de días
      $derechos3+=40.42*$pesoC;
      $cont3++;
      echo $i." Inciso c)".$derechos3." d: ".$cont3." <BR>";
    }

  }

  $derechos=$derechos1+$derechos2+$derechos3; // Cálculo final de todas las variables

  if($excepcion=="Efectos Personales"){
    $pesoC=$peso/100;
    settype($pesoC, "integer");
    if ($pesoC<1) {
      $pesoC=1;
    }
    $tarifaEf=20.76*$peso; // aquí está el multiplicador de la tarifa (por cada cien kilos)
    $derechos=$tarifaEf*$diasTotales;
  }
  if($excepcion=="Especial"){
    $derechos=$derechos*2; // $tarifaEs representa al doble aplicado en mercancía Especial
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
        } else { echo "Multiplicador: ".$pesoC." Días totales en almacen: ".$diasTemp." Inciso a)".$derechos1."  Inciso b)".$derechos2." Inciso c)".$derechos3." Suma:".$derechos; ?>
            <h3>ERROR AL GUARDAR</h3>
          <?php } ?>
        <a href="oficio.php?id=<?php echo $idOficio ?>" class="btn btn-primary">Regresar</a>
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
