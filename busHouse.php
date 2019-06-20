<?php
require 'includes/conexion.php';
require 'includes/conexionDigitalizacion.php';
require 'pages/validaSesion.php';
$guia = $_POST['guiaHouse'];
$guia= '%'.$guia.'%';
  $registro= "SELECT * FROM RegistroDescon WHERE guiaHouse LIKE '$guia'";
  $registroQery = $mysqli->query($registro);
  $return='
    <div class="row">
      <div class="col-sm-12">
          <table class="table table-bordered table-condensed" style="text-align: center">
            <thead>
              <tr>
                <th>Registro</th>
                <th>Vuelo</th>
                <th>Fecha</th>
                <th>GuíaMaster</th>
                <th>GuíaHouse</th>
                <th>FILE <i class="fa fa-plane" aria-hidden="true"></i></th>
                <th><i class="fa fa-paperclip" aria-hidden="true"></i> previos, salidas y averías</th>
                <th>Ver archivos</th>
              </tr>
            </thead>
            <tbody>';
  while($rowRegistroH = $registroQery->fetch_array(MYSQLI_ASSOC)){
    $idM=$rowRegistroH['RegistroVD_idRegistroVD'];

    $registroM= "SELECT * FROM RegistroVD WHERE idRegistroVD = '$idM'";
    $regisM = $mysqli->query($registroM);
    $rowM = $regisM->fetch_array(MYSQLI_ASSOC);

    $idRVD=$rowM['VueloDigitalizacion_idVueloDigitalizacion'];

    $registrosVD= "SELECT * FROM vuelodigitalizacion WHERE idVueloDigitalizacion = '$idRVD'";
    $regisVD = $mysqli->query($registrosVD);
    $rowVD = $regisVD->fetch_array(MYSQLI_ASSOC);

    $return.=' <tr>
                  <td>'.$rowVD['registroVD'].'</td>
                  <td>'.$rowVD['nomVuelo'].'</td>
                  <td>'.$rowVD['fecha'].'</td>
                  <td>'.$rowM['guiaMaster'].'</td>
                  <td>'.$rowRegistroH['guiaHouse'].'</td>
                 <td>
                   <a target="_blank" href="'.$rowVD['documentoVD'].'">
                       <i class="fas fa-file-pdf"></i>
                   </a>
                 </td>';
                 if ($rowRegistroH['docPrevio']==null || $rowRegistroH['docSalida']==null) {                   
                   $return.='<td>
                              <a href="adjuntarArchivosHouseDigitalizacion.php?id='.$rowRegistroH['idRegistroDescon'].'">
                                  <i class="fa fa-paperclip" aria-hidden="true"></i>
                              </a>
                            </td>
                            <td>
                              <a href="adjuntarArchivosHouseDigitalizacion.php?id='.$rowRegistroH['idRegistroDescon'].'">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                              </a>
                            </td>';
                 } else {
                   $return.='<td></td>
                            <td>
                              <a href="adjuntarArchivosHouseDigitalizacion.php?id='.$rowRegistroH['idRegistroDescon'].'">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                              </a>
                            </td>';
                 }
    $return.='</tr>';

    }
    $return.='</tbody>
          </table>
        </div>
      </div>';
echo $return;
?>
