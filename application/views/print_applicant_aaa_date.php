
<?php


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190,11,$header->head,0,0,'C');
$pdf->Ln(20);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0, 10,'Table of Area with most applicants dated: ' . $date->minDate . ' - ' . $date->maxDate);
$pdf->Ln(10);

$pdf->Cell(94.5,7,'Name',1,0,'C');
$pdf->MultiCell(94.5,7,'Location',1,'C');

if($applicant_aaa_date_detail_count == null){
		$pdf->MultiCell(189,10,'No data rendered.','LRB','C');
}
else{
	foreach($applicant_aaa_date_detail_count as $no => $value){
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(94.5,7,intval($no + 1) . '. ' . $value->appName,'LRB');
		$pdf->Cell(94.5,7,$value->appLoc,'BR',0,'C');
		$pdf->Ln(7);
	}
}

$pdf->Ln(7);
if($applicant_aaa_date_sum_detail_count){
	foreach($applicant_aaa_date_sum_detail_count as $no => $value)	
		$pdf->MultiCell(130,7,$value->appLoc. ': ' . $value->countApp,0,'R');
}

if($applicant_aaa_date_sum_count){
	foreach($applicant_aaa_date_sum_count as $no => $value){	
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(130,7,'Total: ' . $value->appTotal,0,'R');
	}
}


$pdf->Output();
?>