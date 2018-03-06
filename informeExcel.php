<?php
require('includes/conexion.php');
if (!isset($_GET['oficio'])) {
  $_GET['oficio']=0;
}
$valor = $_GET['oficio'];

$query="SELECT * FROM Oficio WHERE idOficio = $valor";
$resOficio = $mysqli->query($query);

$query = "SELECT * FROM registroabandono WHERE Oficio_idOficio = $valor ";
$resultado = $mysqli->query($query);

if ($resultado->num_rows >0) {
  date_default_timezone_set('America/Mexico_City');
  if (PHP_SAPI == 'cli')
    die('Este archivo solo se puede ver desde un navegador web');
    /** Se agrega la libreria PHPExcel */
 require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

// Se crea el objeto PHPExcel
 $objPHPExcel = new PHPExcel();
 // Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("Interpuerto Multimodal de México") // Nombre del autor
    ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
    ->setTitle("Reporte de cálculo de abandono") // Titulo
    ->setSubject("Reporte en Excel") //Asunto
    ->setDescription("Reporte de mercancía en abandono") //Descripción
    ->setKeywords("Reporte Abandono") //Etiquetas
    ->setCategory("Reporte excel"); //Categorias

  $tituloReporte = "Reporte de mercancía en abandono";
  $titulosColumnas = array('Oficio', 'Observación', 'Destino', 'Fecha de notificación', 'Fecha de ingreso', 'Fecha de salida', 'Expediente', 'Clave única', 'Guia Master', 'Guia House', 'Piezas', 'Peso', 'Descripcion', 'Dias totales', 'Estatus', 'Tipo de mercancía', 'Derechos',  'Derechos correcto ');

  // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
  $objPHPExcel->setActiveSheetIndex(0)
      ->mergeCells('A1:D1');
      // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1',$tituloReporte) // Titulo del reporte
        ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
        ->setCellValue('B3',  $titulosColumnas[1])
        ->setCellValue('C3',  $titulosColumnas[2])
        ->setCellValue('D3',  $titulosColumnas[3])
        ->setCellValue('E3',  $titulosColumnas[4])  //Titulo de las columnas
        ->setCellValue('F3',  $titulosColumnas[5])
        ->setCellValue('G3',  $titulosColumnas[6])
        ->setCellValue('H3',  $titulosColumnas[7])
        ->setCellValue('I3',  $titulosColumnas[8])
        ->setCellValue('J3',  $titulosColumnas[9])  //Titulo de las columnas
        ->setCellValue('K3',  $titulosColumnas[10])
        ->setCellValue('L3',  $titulosColumnas[11])
        ->setCellValue('M3',  $titulosColumnas[12])
        ->setCellValue('N3',  $titulosColumnas[13])  //Titulo de las columnas
        ->setCellValue('O3',  $titulosColumnas[14])
        ->setCellValue('P3',  $titulosColumnas[15])
        ->setCellValue('Q3',  $titulosColumnas[16])
        ->setCellValue('R3',  $titulosColumnas[17]);

        //Se agregan los datos desde MySQL
        $oficio = $resOficio->fetch_assoc();
//$oficio = $resOficio->fetch_array();
       $i = 4; //Numero de fila donde se va a comenzar a rellenar
       $totalDerechos=0;
       while ($fila = $resultado->fetch_array()) {
         $fUno=strtotime($oficio['f_ingreso']);
         $fDos=strtotime($oficio['f_salida']);
         $diasTotales=ceil(abs($fDos - $fUno) / 86400);  //función que calcula la diferencia en días entre

         $derechos3=0;
         $derechos2=0;
         $derechos1=0;
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
         $DERECHOS=$derechos1+$derechos2+$derechos3;
         $totalDerechos+=$fila['derechos'];
           $objPHPExcel->setActiveSheetIndex(0)
               ->setCellValue('A'.$i, $oficio['oficio'])
               ->setCellValue('B'.$i, $oficio['observacion'])
               ->setCellValue('C'.$i, $oficio['destino'])
               ->setCellValue('D'.$i, $oficio['fechaNotificacion'])
               ->setCellValue('E'.$i, $fila['f_ingreso'])
               ->setCellValue('F'.$i, $fila['f_salida'])
               ->setCellValue('G'.$i, $fila['expediente'])
               ->setCellValue('H'.$i, $fila['claveUnica'])
               ->setCellValue('I'.$i, $fila['guiaMaster'])
               ->setCellValue('J'.$i, $fila['guiaHouse'])
               ->setCellValue('K'.$i, $fila['piezas'])
               ->setCellValue('L'.$i, $fila['peso'])
               ->setCellValue('M'.$i, $fila['descripcion'])
               ->setCellValue('N'.$i, $fila['diasTotales'])
               ->setCellValue('O'.$i, $fila['estatus'])
               ->setCellValue('Q'.$i, $fila['excepcion'])
               ->setCellValue('P'.$i, $fila['derechos'])
               ->setCellValue('R'.$i, $DERECHOS);
           $i++;

       }
       $estiloTituloReporte = array(
       'font' => array(
           'name'      => 'Verdana',
           'bold'      => true,
           'italic'    => false,
           'strike'    => false,
           'size' =>16,
           'color'     => array(
               'rgb' => 'FFFFFF'
           )
       ),
       'fill' => array(
         'type'  => PHPExcel_Style_Fill::FILL_SOLID,
         'color' => array(
               'argb' => 'FF220835')
     ),
       'borders' => array(
           'allborders' => array(
               'style' => PHPExcel_Style_Border::BORDER_NONE
           )
       ),
       'alignment' => array(
           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
           'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
           'rotation' => 0,
           'wrap' => TRUE
       )
   );

   $estiloTituloColumnas = array(
       'font' => array(
           'name'  => 'Arial',
           'bold'  => true,
           'color' => array(
               'rgb' => 'FFFFFF'
           )
       ),
       'fill' => array(
           'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
     'rotation'   => 90,
           'startcolor' => array(
               'rgb' => '00008B'
           ),
           'endcolor' => array(
               'argb' => 'FF431a5d'
           )
       ),
       'borders' => array(
           'top' => array(
               'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
               'color' => array(
                   'rgb' => '143860'
               )
           ),
           'bottom' => array(
               'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
               'color' => array(
                   'rgb' => '143860'
               )
           )
       ),
       'alignment' =>  array(
           'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
           'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
           'wrap'      => TRUE
       )
   );

   $estiloInformacion = new PHPExcel_Style();
   $estiloInformacion->applyFromArray( array(
       'font' => array(
           'name'  => 'Arial',
           'color' => array(
               'rgb' => '000000'
           )
       ),
       'fill' => array(
     'type'  => PHPExcel_Style_Fill::FILL_SOLID,
     'color' => array(
               'rgb' => 'ADD8E6')
     ),
       'borders' => array(
           'left' => array(
               'style' => PHPExcel_Style_Border::BORDER_THIN ,
         'color' => array(
                 'rgb' => '8B0000'
               )
           )
       )
   ));
   $objPHPExcel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($estiloTituloReporte);
   $objPHPExcel->getActiveSheet()->getStyle('A3:R3')->applyFromArray($estiloTituloColumnas);
   $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:R".($i-1));
   //Aquí se asignará el ancho de el formato
   for($i = 'A'; $i <= 'R'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);

    }
    // Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Abandono');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportedeabandono'.$valor.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
else{
    print_r('No hay resultados para mostrar');
}

 ?>
