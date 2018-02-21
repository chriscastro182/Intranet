<?php
require '../../includes/conexion.php';

// $registro = isset($_GET['id']) ? $_GET['id'] : 0;
// if (!$registro) {
//   $registro = isset($_POST['registro']) ? $_POST['registro'] : 0;
// }
// $guias = isset($_POST['guias']) ? $_POST['guias'] : '';
//
//
// if ($registro!=0) {
//   $sqlTrans="SELECT * FROM transferencias where idTransferencia = $registro";
// }else {
//   $sqlTrans="SELECT * FROM transferencias where guiaMaster = $guias ";
// }
$sqlTrans="SELECT * FROM transferencias where idTransferencia = 5";

$resulTrans = $mysqli->query($sqlTrans);
$rowTrans = $resulTrans->fetch_assoc();
 $rowTrans['idTransferencia'];
$valor=$rowTrans['valorMercancia'];
$master=$rowTrans['guiaMaster'];
$house=$rowTrans['guiaHouse'];
$piezas=$rowTrans['piezas'];
$peso=$rowTrans['peso'];
$contenido=$rowTrans['contenido'];
$Consignatario=$rowTrans['consignatario'];

 $objEntrada=new DateTime($rowTrans['fechaentrada']);
 $fechaEntrada = date_format($objEntrada, 'd-m-Y');

 $fecha = new DateTime($rowTrans['fecha']);
$hora = date_format($fecha, 'H:i:s');


$sqlC= "SELECT * FROM condiciondecarga";
$resul = $mysqli->query($sqlC);
//============================================================+
// Nombre del archivo   : transferenciaPDF.php
// Iniciado       : 2017-12-19
// última actualización : 2017-12-19
//
// Description : Archivo PDF para solicitar
//               transferencias entre almacenes
//
// Author: Christian Castro Ríos
//
// (c) Copyright:
//               Interpuerto Multimodal de México
//               braniff.com
//               christian.castro@interpuerto.com
//============================================================+


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Christian Castro Ríos');
$pdf->SetTitle('Interpuerto Multimodal de México');
$pdf->SetSubject('solicitud de transferencia');
$pdf->SetKeywords('IMM, PDF, transferencia, recinto, fiscal');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Almacén 262       Forma AA', PDF_HEADER_STRING, array(0,40,150), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$fechaTransferencia = date_format($fecha, 'd-m-Y');
// Set some content to print

$html = <<<EOD

<p><small><strong>Fecha: </strong>$fechaTransferencia <DIR><strong>Hora: </strong>$hora  </DIR>  <strong >Valor de la mercancía:</strong> $ $valor</small></p>
<p><small><i>SE SOLICITA POR EL PRESENTE DOCUMENTO, ENTREGAR A NUESTRO PERSONAL AUTORIZADO LA CARGA RELACIONADA A  CONTINUACIÓN, YA QUE SERÁ TRANSFERIDA A NUESTRO ALMACÉN FISCALIZADO </i> </small></p>

EOD;
$tbl = <<<EOD
<small> <table border="0" cellpadding="2" cellspacing="2" align="center">

 <tr nobr="true" style="color: white;">
  <th colspan="3" style="background-color:#002896" >Datos de la guía</th>
 </tr>
 <tr nobr="true">
  <td><strong>Encargado: </strong>$master<br/ ></td>
 </tr>
 <tr nobr="true">
  <td><strong>Guía Master:</strong>$master<br/ ></td>
  <td><strong>Guía House: </strong>$house</td>
  <td><strong>Guía directa: </strong>$directa</td>
 </tr>
 <tr nobr="true">
 <td><strong>Fecha de llegada: </strong>$piezas</td>
	<td><strong>Peso: </strong>$peso kg</td>
  <td><strong>Piezas: </strong>$piezas</td>
 </tr>
</table> </small>
EOD;
// Table with rowspans and THEAD
$tabl = <<<EOD
<table border="0" cellpadding="2" cellspacing="2" align="center">
<thead>
 <tr style="background-color:#002896;color:#FFFFFF;">
  <td width="200" align="center"> <b>Fecha</b></td>
  <td width="200" align="center"><b>Hora</b></td>
	<td width="230" align="center"><b>Valor de la mercancía</b></td>
 </tr>
</thead>
 <tr>
  <td width="210" rowspan="3">$fechaTransferencia<br /></td>
  <td width="210">$hora<br /></td>
  <td align="center" width="210"> $ $valor<br /></td>
 </tr>
 <tr>
  <td width="210" align="center" rowspan="3">2.</td>
  <td width="210" rowspan="3">XXXX<br />XXXX</td>
  <td width="210">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="210">XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="210">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="80" rowspan="2" >RRRRRR<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="30" align="center">3.</td>
  <td width="140">XXXX1<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="30" align="center">4.</td>
  <td width="140">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
</table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->writeHTML($tabl, true, false, false, false, '');
// ---------------------------------------------------------
ob_end_clean();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
