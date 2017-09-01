
<?php


// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190,11,$header->head,0,0,'C');
$pdf->Ln(20);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(0, 10,'Table of Clients with most number of staff dated: ' . $date->minDate . ' - ' . $date->maxDate);
$pdf->Ln(10);

$pdf->Cell(80,7,'Name',1,0,'C');
$pdf->Cell(46,7,'Order date','TB',0,'C');
$pdf->MultiCell(63,7,'Number of staff',1,'C');

if($client_cns_date_detail_count == null){
		$pdf->MultiCell(189,10,'No data rendered.','LRB','C');
}
else{
	foreach($client_cns_date_detail_count as $no => $value){
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(80,7,intval($no + 1) . '. ' . $value->clientName,'LRB');
		$pdf->Cell(46,7,$value->clientDate,'B',0,'C');
		$pdf->Cell(63,7,$value->countStaff,'LRB',0,'C');
		$pdf->Ln(7);
	}
}

$pdf->Ln(7);
if($client_cns_date_sum_detail_count){
	foreach($client_cns_date_sum_detail_count as $no => $value)	
		$pdf->MultiCell(130,7,$value->clientName. ': ' . $value->countStaff,0,'R');
}

if($client_cns_date_sum_count){
	foreach($client_cns_date_sum_count as $no => $value){	
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(130,7,'Total: ' . $value->clientTotal,0,'R');
	}
}


$pdf->Output();
?>