<form class="form-horizontal" action="" method="post">
  <input type="date" name="ingreso" value="">
  <input type="date" name="salida" value="">

  <button type="submit" name="button">calcula</button>
</form>

<?php
if (isset($_POST['button'])) {
  diffDias();
}
function diffDias(){
  $fUno=strtotime(isset($_POST['ingreso']) ? $_POST['ingreso'] : '');
  $fDos=strtotime(isset($_POST['salida']) ? $_POST['salida'] : '');
  $dif=$fDos-$fUno;
  $dias = floor($dif / (60 * 60 * 24));
  echo 'Entrada: '.+$fUno;
  echo '<br> Salida: '.+$fDos;
  echo '<br>'.+$dias;
} ?>
