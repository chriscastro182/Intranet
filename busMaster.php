<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';
$guia = $_POST['guiaMaster'];
$guia= '%'.$guia.'%';
  $registro= "SELECT * FROM RegistroVD WHERE guiaMaster LIKE '$guia'";
  $registroQery = $mysqli->query($registro);
  $return='
    <div class="row">
      <div class="col-sm-10">
          <table class="table table-bordered table-condensed" style="text-align: center">
            <thead>
              <tr>
                <th>Registro</th>
                <th>Vuelo</th>
                <th>Fecha</th>
                <th>GuíaMaster</th>
                <th>GuíaHouse</th>
                <th>Vuelo</th>
                <th>PDF</th>
              </tr>
            </thead>
            <tbody>';
  while($rowRegistroM = $registroQery->fetch_array(MYSQLI_ASSOC)){
    $idRVD=$rowRegistroM['VueloDigitalizacion_idVueloDigitalizacion'];
    $registrosVD= "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$idRVD'";
    $regisVD = $mysqli->query($registrosVD);
    $rowVD = $regisVD->fetch_array(MYSQLI_ASSOC);

    $return.=' <tr>
                  <td>'.$rowVD['registroVD'].'</td>
                  <td>'.$rowVD['nomVuelo'].'</td>
                  <td>'.$rowVD['fecha'].'</td>
                  <td>'.$rowRegistroM['guiaMaster'].'</td>
                  <td>'.$rowRegistroM['guiaHouse'].'</td>
                 <td></td>
                 <td>
                   <a target="_blank" href="'.$rowVD['documentoVD'].'">
                       <i class="fas fa-file-pdf"></i>
                   </a>
                 </td>
               </tr>';

    }
    $return.='</tbody>
          </table>
        </div>
      </div>';
echo $return;
?>
