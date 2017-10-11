<?php
require('include/conexion.php');
$query = "SELECT * FROM registroabandono ";
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
  $titulosColumnas = array('Consecutivo', 'Fecha de ingreso', 'Guia Master', 'Guia House', 'Piezas', 'Peso', 'Descripcion', 'Oficio de Aduana', 'Fecha de salida','Dias totales', 'Estatus', 'Derechos', 'Tipo de mercancía');

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
        ->setCellValue('M3',  $titulosColumnas[12]);

        //Se agregan los datos desde MySQL

       $i = 4; //Numero de fila donde se va a comenzar a rellenar
       while ($fila = $resultado->fetch_array()) {
           $objPHPExcel->setActiveSheetIndex(0)
               ->setCellValue('A'.$i, $fila['idRegistroAbandono'])
               ->setCellValue('B'.$i, $fila['f_ingreso'])
               ->setCellValue('C'.$i, $fila['guiaMaster'])
               ->setCellValue('D'.$i, $fila['guiaHouse'])
               ->setCellValue('E'.$i, $fila['piezas'])
               ->setCellValue('F'.$i, $fila['peso'])
               ->setCellValue('G'.$i, $fila['descripcion'])
               ->setCellValue('H'.$i, $fila['oficioAduana'])
               ->setCellValue('I'.$i, $fila['f_salida'])
               ->setCellValue('J'.$i, $fila['diasTotales'])
               ->setCellValue('K'.$i, $fila['estatus'])
               ->setCellValue('L'.$i, $fila['derechos'])
               ->setCellValue('M'.$i, $fila['excepcion']);
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
   $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloReporte);
   $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
   $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:M".($i-1));
   //Aquí se asignará el ancho de el formato
   for($i = 'A'; $i <= 'M'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);

    }
    // Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Abandono');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,12);

// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportedeabandono.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
else{
    print_r('No hay resultados para mostrar');
}

 ?>
