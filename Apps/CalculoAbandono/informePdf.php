<?php
	include 'plantilla.php';
	require 'include/conexion.php';

	$query = "SELECT * FROM registroabandono ";
	$resultado = $mysqli->query($query);

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(60,6,utf8_decode('Fecha de Ingreso'),1,0,'C',1);
	$pdf->Cell(50,6,utf8_decode('Guía Master'),1,0,'C',1);
	$pdf->Cell(60,6,utf8_decode('GuíaHouse'),1,1,'C',1);

	$pdf->SetFont('Arial','',10);

	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(60,6,utf8_decode($row['f_ingreso']),1,0,'C');
		$pdf->Cell(50,6,$row['guiaMaster'],1,0,'C');
		$pdf->Cell(60,6,utf8_decode($row['guiaHouse']),1,1,'C');
	}
	$pdf->Output();
?>
